<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Campus;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Subject;
use Illuminate\Support\Facades\Log;
use App\Models\SchoolClass;
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
                'section_ids' => 'required|array',
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
    
            // Attach subjects and sections with class_id to the teacher in the pivot table
            foreach ($request->section_ids as $sectionId) {
                // Retrieve the class_id associated with this section
                $section = Section::findOrFail($sectionId);
                $classId = $section->class_id;
    
                // Attach each subject with this section and class
                foreach ($request->subject_ids as $subjectId) {
                    $teacher->subjects()->attach($subjectId, [
                        'section_id' => $sectionId,
                        'class_id' => $classId
                    ]);
                }
            }
    
            // Redirect to the index page with a success message
            return redirect()->route('teacher.index')->with('success', 'Teacher created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        }
    }
    
    // Show the form for editing the specified teacher
    // Controller - Edit Method
    // public function edit($id)
    // {
    //     $teacher = Teacher::with(['subjects', 'sections'])->findOrFail($id);
    //     $campuses = Campus::all();
    //     $subjects = Subject::all();
    //     $sections = Section::all();
    //     $classes = SchoolClass::all();

    //     return view('teachers.edit', compact('teacher', 'campuses', 'subjects', 'sections', 'classes'));
    // }
    public function edit($id)
    {
        $teacher = Teacher::with(['subjects', 'sections', 'class'])->findOrFail($id);
        $campuses = Campus::all();
        $subjects = Subject::all();
        $sections = Section::all();
        $classes = SchoolClass::all();
    
        // Get the class_id from the first related section, if it exists
        $classId = optional($teacher->sections->first())->class_id;
    
        return view('teachers.edit', compact('teacher', 'campuses', 'subjects', 'sections', 'classes', 'classId'));
    }
    
    public function update(Request $request, $id)
    {
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
                'subject_ids' => 'required|array',
                'subject_ids.*' => 'exists:subjects,id',
                'section_ids' => 'required|array',
                'section_ids.*' => 'exists:sections,id',
            ]);
    
            // Find the existing teacher
            $teacher = Teacher::findOrFail($id);
    
            // Update the teacher data
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
    
            // Prepare the pivot data for syncing with class_id included
            $pivotData = [];
            foreach ($request->section_ids as $sectionId) {
                $section = Section::findOrFail($sectionId); // Get the section with its class_id
                $classId = $section->class_id; // Get class_id related to this section
    
                foreach ($request->subject_ids as $subjectId) {
                    $pivotData[] = [
                        'teacher_id' => $teacher->id,
                        'class_id' => $classId,
                        'section_id' => $sectionId,
                        'subject_id' => $subjectId,
                    ];
                }
            }
    
            // Delete existing records for this teacher in the pivot table to avoid duplication
            DB::table('teacher_section_subject')->where('teacher_id', $teacher->id)->delete();
    
            // Insert the updated data into the pivot table
            DB::table('teacher_section_subject')->insert($pivotData);
    
            // Redirect with success message
            return redirect()->route('teacher.index')->with('success', 'Teacher updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        }
    }
    

    
    // public function update(Request $request, $id)
    // {
    //     try {
    //         // Validate the request
    //         $request->validate([
    //             'first_name' => 'required|string|max:255',
    //             'last_name' => 'required|string|max:255',
    //             'date_of_birth' => 'required|date',
    //             'gender' => 'required|string|in:male,female,other',
    //             'phone_number' => 'required|string|max:15',
    //             'email' => 'required|email|unique:teachers,email,' . $id, // Ignore current teacher's email
    //             'address' => 'required|string|max:255',
    //             'employee_id' => 'required|string|unique:teachers,employee_id,' . $id, // Ignore current teacher's employee_id
    //             'hire_date' => 'required|date',
    //             // 'subjects' => 'required|string|max:255',
    //             'qualification' => 'required|string|max:255',
    //             'experience' => 'required|string|max:255',
    //             'campus_id' => 'required|exists:campuses,id',
    //             'subject_ids' => 'required|array',
    //             'subject_ids.*' => 'exists:subjects,id',
    //             'section_ids' => 'required|array',
    //             'section_ids.*' => 'exists:sections,id',
    //         ]);

    //         // Find the existing teacher
    //         $teacher = Teacher::findOrFail($id);

    //         // Update the teacher
    //         $teacher->update([
    //             'first_name' => $request->first_name,
    //             'last_name' => $request->last_name,
    //             'date_of_birth' => $request->date_of_birth,
    //             'gender' => $request->gender,
    //             'phone_number' => $request->phone_number,
    //             'email' => $request->email,
    //             'address' => $request->address,
    //             'employee_id' => $request->employee_id,
    //             'hire_date' => $request->hire_date,
    //             // 'subjects' => $request->subjects,
    //             'qualification' => $request->qualification,
    //             'experience' => $request->experience,
    //             'campus_id' => $request->campus_id,
    //         ]);

    //         // Update the subjects and sections in the pivot table
    //         $pivotData = [];
    //         foreach ($request->subject_ids as $subjectId) {
    //             foreach ($request->section_ids as $sectionId) {
    //                 $pivotData[$subjectId] = ['section_id' => $sectionId];
    //             }
    //         }
    //         $teacher->subjects()->sync($pivotData);

    //         // Redirect to the index page with a success message
    //         return redirect()->route('teacher.index')->with('success', 'Teacher updated successfully.');
    //     } catch (\Illuminate\Validation\ValidationException $e) {
    //         // Handle validation errors
    //         return redirect()->back()
    //             ->withErrors($e->errors()) // Pass validation errors to the view
    //             ->withInput(); // Retain input values
    //     }
    // }

    public function show(Teacher $teacher)
    {
        // Pass the selected teacher to the 'show' view
        return view('teachers.show', compact('teacher'));
    }

    // Remove the specified teacher from storage
    public function destroy($id)
    {
        // Find the teacher by ID
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return redirect()->route('teacher.index')->with('success', 'Teacher deleted successfully!');
    }
}
