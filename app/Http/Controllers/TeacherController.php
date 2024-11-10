<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Campus;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Subject;
use Illuminate\Support\Facades\Log;
use App\Models\SchoolClass;
use App\Models\TeacherSectionSubject;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{

    public function index()
    {
        try {
            $user = auth()->user();

            // If the user has the Owner role, they can see all data
            if ($user->hasRole('Owner')) {
                $teachers = Teacher::all(); // Load all teachers for the Owner role
            } elseif ($user->hasRole('Principal')) {
                // Show only teachers in the principal's campus
                $teachers = Teacher::where('campus_id', $user->campus_id)->get();
            } else {
                // Admins or other roles can also see all teachers
                $teachers = Teacher::all();
            }

            return view('teachers.index', compact('teachers'));
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            // Redirect back with an error message if unauthorized
            return redirect()->route('user.index')->with('error', 'Unauthorized access attempt.');
        }
    }
    public function create()
    {
        $campuses = Campus::all();
        $subjects = Subject::all();
        $sections = Section::all();
        $classes = SchoolClass::all(); // Fetch all classes


        return view('teachers.create', compact('campuses', 'subjects', 'sections', 'classes'));
    }
    public function getSectionsByClass(Request $request)
    {
        $classId = $request->input('class_id');
        $sections = Section::where('class_id', $classId)->get();
        return response()->json(['sections' => $sections]);
    }

    public function store(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'date_of_birth' => 'required|date',
                'gender' => 'required|string|in:male,female,other',
                'phone_number' => 'required|string|max:15',
                'email' => 'required|email|unique:teachers,email',
                'address' => 'required|string|max:255',
                'employee_id' => 'required|string|unique:teachers,employee_id',
                'hire_date' => 'required|date',
                'qualification' => 'required|string|max:255',
                'experience' => 'required|string|max:255',
                'campus_id' => 'required|exists:campuses,id',
                'subject_ids' => 'required|array',
                'subject_ids.*' => 'exists:subjects,id',
                'class_ids' => 'required|array|size:' . count($request->subject_ids),
                'class_ids.*' => 'exists:classes,id',
                'section_ids' => 'required|array|size:' . count($request->subject_ids),
                'section_ids.*' => 'exists:sections,id',
            ]);

            // Create the new teacher
            $teacher = Teacher::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'address' => $request->address,
                'employee_id' => $request->employee_id,
                'hire_date' => $request->hire_date,
                'qualification' => $request->qualification,
                'experience' => $request->experience,
                'campus_id' => $request->campus_id,
            ]);

            // Attach subjects, classes, and sections to the teacher
            foreach ($request->subject_ids as $key => $subjectId) {
                $classId = $request->class_ids[$key];
                $sectionId = $request->section_ids[$key];

                $teacher->subjects()->attach($subjectId, [
                    'class_id' => $classId,
                    'section_id' => $sectionId,
                ]);
            }

            // Redirect to the index page with a success message
            return redirect()->route('teacher.index')->with('success', 'Teacher created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            // Handle other exceptions
            return redirect()->back()
                ->with('error', 'An error occurred while processing the request.')
                ->withInput();
        }
    }


    public function edit($id)
    {
        $teacher = Teacher::with(['teacherSectionSubjects'])->findOrFail($id);
        // dd($teacher);
        $campuses = Campus::all();
        $subjects = Subject::all();
        $sections = Section::all();
        $classes = SchoolClass::all();

        return view('teachers.edit', compact('teacher', 'campuses', 'subjects', 'sections', 'classes'));
    }


    public function update(Request $request, $id)
    {
        // return $request;

        // return $request;
        try {
            // Validate the request
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'date_of_birth' => 'required|date',
                'gender' => 'required|string|in:male,female,other',
                'phone_number' => 'required|string|max:15',
                'email' => 'required|email|unique:teachers,email,' . $id,
                'address' => 'required|string|max:255',
                'employee_id' => 'required|string|unique:teachers,employee_id,' . $id,
                'hire_date' => 'required|date',
                'qualification' => 'required|string|max:255',
                'experience' => 'required|string|max:255',
                'campus_id' => 'required|exists:campuses,id',

            ]);

            // Debug to ensure correct data structure
            // dd($request->all());

            // Update teacher's basic data
            $teacher = Teacher::findOrFail($id);
            $teacher->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'address' => $request->address,
                'employee_id' => $request->employee_id,
                'hire_date' => $request->hire_date,
                'qualification' => $request->qualification,
                'experience' => $request->experience,
                'campus_id' => $request->campus_id,
            ]);
            // Handle deletions if any
            if ($request->has('deleted_ids')) {
                DB::table('teacher_section_subject')->whereIn('id', $request->deleted_ids)->delete();
            }

            // return $request;
            foreach ($request->class_ids as $key => $classId) {
                $sectionId = $request->section_ids[$key] ?? null;
                $subjectId = $request->subject_ids[$key] ?? null; // Directly access the subject ID
                $assignmentId = $request->assignment_ids[$key] ?? null; // Directly access the assignment ID

                if (empty($subjectId)) {
                    continue; // Skip if the subject ID is missing
                }

                if (empty($assignmentId)) {
                    // Insert a new record if $assignmentId is null
                    Log::info("Inserting new record for class_id: {$classId}, section_id: {$sectionId}, subject_id: {$subjectId}");
                    DB::table('teacher_section_subject')->insert([
                        'teacher_id' => $id,
                        'class_id' => $classId,
                        'section_id' => $sectionId,
                        'subject_id' => $subjectId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                } else {
                    // Update the record with the given ID if $assignmentId is not null
                    Log::info("Updating record with ID: {$assignmentId} for class_id: {$classId}, section_id: {$sectionId}, subject_id: {$subjectId}");
                    DB::table('teacher_section_subject')
                        ->where('id', (int) $assignmentId) // Cast to integer for safety
                        ->update([
                            'teacher_id' => $id,
                            'class_id' => $classId,
                            'section_id' => $sectionId,
                            'subject_id' => $subjectId,
                            'updated_at' => now(),
                        ]);
                }
            }

            return redirect()->route('teacher.index')->with('success', 'Teacher updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            // Catch general exceptions and log for debugging
            Log::error($e->getMessage());
            return redirect()->back()
                ->with('error', 'An unexpected error occurred. Please try again.')
                ->withInput();
        }
    }

    public function show(Teacher $teacher)
    {
        // Pass the selected teacher to the 'show' view
        return view('teachers.show', compact('teacher'));
    }

    // Remove the specified teacher from storage
    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return redirect()->route('teacher.index')->with('success', 'Teacher deleted successfully!');
    }
}
