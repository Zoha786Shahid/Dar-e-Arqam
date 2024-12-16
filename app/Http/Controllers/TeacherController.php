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
    private function validateTeacher(Request $request, $isUpdate = false, $teacherId = null)
    {
        return $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|in:male,female,other',
            'phone_number' => 'required|string|max:15',
            'email' => $isUpdate
                ? 'required|email|unique:teachers,email,' . $teacherId
                : 'required|email|unique:teachers,email',
            'address' => 'required|string|max:255',
            'employee_id' => $isUpdate
                ? 'required|string|unique:teachers,employee_id,' . $teacherId
                : 'required|string|unique:teachers,employee_id',
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
    }

    private function attachTeacherDetails(Request $request, Teacher $teacher)
    {
        foreach ($request->subject_ids as $key => $subjectId) {
            $classId = $request->class_ids[$key];
            $sectionId = $request->section_ids[$key];

            $teacher->subjects()->attach($subjectId, [
                'class_id' => $classId,
                'section_id' => $sectionId,
            ]);
        }
    }

    public function index()
    {
        $user = auth()->user();
        $teachers = $user->hasRole('Owner') || !$user->hasRole('Principal')
            ? Teacher::all()
            : Teacher::where('campus_id', $user->campus_id)->get();

        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        $campuses = Campus::all();
        $subjects = Subject::all();
        $sections = Section::all();
        $classes = SchoolClass::all();
        return view('teachers.create', compact('campuses', 'subjects', 'sections', 'classes'));
    }

    public function store(Request $request)
    {
        try {
            $this->validateTeacher($request);
            $teacher = Teacher::create($request->only([
                'first_name',
                'last_name',
                'date_of_birth',
                'gender',
                'phone_number',
                'email',
                'address',
                'employee_id',
                'hire_date',
                'qualification',
                'experience',
                'campus_id'
            ]));

            $this->attachTeacherDetails($request, $teacher);

            return redirect()->route('teacher.index')->with('success', 'Teacher created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred.')->withInput();
        }
    }

    public function edit($id)
    {
        $teacher = Teacher::with(['teacherSectionSubjects'])->findOrFail($id);
        $campuses = Campus::all();
        $subjects = Subject::all();
        $sections = Section::all();
        $classes = SchoolClass::all();
        return view('teachers.edit', compact('teacher', 'campuses', 'subjects', 'sections', 'classes'));
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validateTeacher($request, true, $id);
            $teacher = Teacher::findOrFail($id);

            $teacher->update($request->only([
                'first_name',
                'last_name',
                'date_of_birth',
                'gender',
                'phone_number',
                'email',
                'address',
                'employee_id',
                'hire_date',
                'qualification',
                'experience',
                'campus_id'
            ]));

            if ($request->has('deleted_ids')) {
                DB::table('teacher_section_subject')->whereIn('id', $request->deleted_ids)->delete();
            }

            foreach ($request->class_ids as $key => $classId) {
                $sectionId = $request->section_ids[$key] ?? null;
                $subjectId = $request->subject_ids[$key] ?? null;
                $assignmentId = $request->assignment_ids[$key] ?? null;

                if (!$subjectId) continue;

                if (!$assignmentId) {
                    DB::table('teacher_section_subject')->insert([
                        'teacher_id' => $id,
                        'class_id' => $classId,
                        'section_id' => $sectionId,
                        'subject_id' => $subjectId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                } else {
                    DB::table('teacher_section_subject')->where('id', (int)$assignmentId)->update([
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
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An unexpected error occurred.')->withInput();
        }
    }

    public function show(Teacher $teacher)
    {
        return view('teachers.show', compact('teacher'));
    }

    public function destroy($id)
    {
        Teacher::findOrFail($id)->delete();
        return redirect()->route('teacher.index')->with('success', 'Teacher deleted successfully!');
    }

    public function getSectionsByClass(Request $request)
    {
        $sections = Section::where('class_id', $request->input('class_id'))->get();
        return response()->json(['sections' => $sections]);
    }

    public function getTeachersByCampus($campusId)
    {
        $teachers = Teacher::where('campus_id', $campusId)->get();
        return response()->json($teachers);
    }
    public function getClassesByTeacher($teacherId)
    {
        $classes = SchoolClass::whereHas('sections', function ($query) use ($teacherId) {
            $query->whereHas('teacherSectionSubjects', function ($q) use ($teacherId) {
                $q->where('teacher_id', $teacherId);
            });
        })->get(['id', 'name']);
    
        return response()->json($classes);
    }
    
    

}
