<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Campus;
use App\Models\Section;
use App\Models\Subject;
use App\Models\SchoolClass;
use App\Models\SeniorEvaluationReport;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class SeniorEvaluationReportController extends Controller
{
    private function validateEvaluation(Request $request)
    {
        return $request->validate([
            'teacher_id' => 'required|integer',
            'campus_id' => 'required|integer',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
            'observer_name' => 'nullable|string|max:255',
            'observer_guidance' => 'nullable|string',
            'teacher_views' => 'nullable|string',
            'entrance_welcome_marks' => 'required|integer|min:0|max:10',
            'appearance_dress_code_marks' => 'required|integer|min:0|max:10',
            'seating_cleanliness_marks' => 'required|integer|min:0|max:10',
            'writing_board_prep_marks' => 'required|integer|min:0|max:10',
            'writing_board_use_marks' => 'required|integer|min:0|max:10',
            'syllabus_division_marks' => 'required|integer|min:0|max:10',
            'assessment_start_marks' => 'required|integer|min:0|max:10',
            'pk_testing_marks' => 'required|integer|min:0|max:10',
            'av_activities_marks' => 'required|integer|min:0|max:10',
            'teaching_methods_marks' => 'required|integer|min:0|max:10',
            'subject_command_marks' => 'required|integer|min:0|max:10',
            'student_clarity_marks' => 'required|integer|min:0|max:10',
            'student_involvement_marks' => 'required|integer|min:0|max:10',
            'individual_attention_marks' => 'required|integer|min:0|max:10',
            'copy_work_marks' => 'required|integer|min:0|max:10',
            'moral_training_marks' => 'required|integer|min:0|max:10',
            'reading_marking_objective_marks' => 'required|integer|min:0|max:10',
            'lecture_planning_marks' => 'required|integer|min:0|max:10',
            'time_management_marks' => 'required|integer|min:0|max:10',
            'spoken_english_marks' => 'required|integer|min:0|max:10',
            'evaluation_marks' => 'required|integer|min:0|max:10',
            'home_task_checking_marks' => 'required|integer|min:0|max:10',
            'class_discipline_marks' => 'required|integer|min:0|max:10',
            'total_marks' => 'required|integer|min:0',
        ]);
    }

    private function getCampusesAndTeachers()
    {
        return [
            'teachers' => Teacher::all(),
            'campuses' => Campus::all(),
        ];
    }

    public function index()
    {
        $reports = SeniorEvaluationReport::with('teacher', 'campus')->get();
        return view('seniorEvaluation.index', compact('reports'));
    }

    public function create()
    {
        $data = $this->getCampusesAndTeachers();
        return view('seniorEvaluation.create', $data);
    }

    public function store(Request $request)
    {
        try {
            $validated = $this->validateEvaluation($request);
            SeniorEvaluationReport::create($validated);

            return redirect()->route('seniorevaluation.index')->with('success', 'Evaluation report created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while saving the evaluation report.')->withInput();
        }
    }

    // public function edit($id)
    // {
    //     $evaluation = SeniorEvaluationReport::findOrFail($id);
    //     $data = array_merge(['evaluation' => $evaluation], $this->getCampusesAndTeachers());

    //     return view('seniorEvaluation.edit', $data);
    // }
    public function edit($id)
    {
        $evaluation = SeniorEvaluationReport::findOrFail($id);
    
        // Fetch teachers based on selected campus
        $teachers = Teacher::where('campus_id', $evaluation->campus_id)->get();
    
        // Fetch classes taught by the selected teacher
        $classes = SchoolClass::whereHas('sections.teacherSectionSubjects', function ($query) use ($evaluation) {
            $query->where('teacher_id', $evaluation->teacher_id);
        })->get();
    
        // Fetch sections for the selected class
        $sections = Section::where('class_id', $evaluation->class_id)->get();
    
        // Fetch subjects for the selected section
        $subjects = Subject::whereHas('teacherSectionSubjects', function ($query) use ($evaluation) {
            $query->where('section_id', $evaluation->section_id);
        })->get();
    
        $data = array_merge([
            'evaluation' => $evaluation,
            'teachers' => $teachers,
            'classes' => $classes,
            'sections' => $sections,
            'subjects' => $subjects,
        ], $this->getCampusesAndTeachers());
    
        return view('seniorEvaluation.edit', $data);
    }
    
    public function update(Request $request, $id)
    {
        try {
            $evaluation = SeniorEvaluationReport::findOrFail($id);
            $validated = $this->validateEvaluation($request);
            $evaluation->update($validated);

            return redirect()->route('seniorevaluation.index')->with('success', 'Evaluation updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while updating the evaluation.')->withInput();
        }
    }

    public function destroy($id)
    {
        $evaluation = SeniorEvaluationReport::findOrFail($id);
        $evaluation->delete();

        return redirect()->route('seniorevaluation.index')->with('success', 'Evaluation deleted successfully!');
    }

    public function showEvaluationForm($id)
    {
        $evaluation = SeniorEvaluationReport::findOrFail($id);
        return view('seniorEvaluation.evaluation_pdf', compact('evaluation'));
    }

    public function downloadEvaluationPDF($id)
    {
        $evaluation = SeniorEvaluationReport::with('campus')->findOrFail($id);
        $evaluation->checklist = [
            ['criteria' => 'Appearance/Dress code', 'total_marks' => 3, 'obtained_marks' => 2, 'remarks' => 'Good'],
            // Additional checklist items
        ];

        $pdf = Pdf::loadView('seniorEvaluation.evaluation_pdf', compact('evaluation'));
        return $pdf->download('evaluation_' . $evaluation->id . '.pdf');
    }
}
