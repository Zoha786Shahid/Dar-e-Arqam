<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Campus;
use App\Models\EvaluationForm;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class EvaluationController extends Controller
{
    private function validateEvaluation(Request $request)
    {
        return $request->validate([
            'teacher_id' => 'required',
            'campus_id' => 'required',
            'total_students' => 'required',
            'appearance_dress_code' => 'required',
            'lesson_plan' => 'required',
            'observer_name' => 'required',
            'observer_signature' => 'required',
            'standard_of_lesson_plan' => 'required|integer',
            'introduction_pk_testing' => 'required',
            'islamization' => 'required',
            'gesture_tone_body_language' => 'required',
            'communication_skill' => 'required',
            'strategies_activities' => 'required',
            'discipline_class_control' => 'required',
            'tools_av_aids' => 'required',
            'tools_illustrative_material' => 'required',
            'tools_writing_board' => 'required',
            'real_life_integration' => 'required',
            'competency_command_on_subject' => 'required',
            'time_management' => 'required',
            'evaluation_conclusion' => 'required',
            'diary_hw_checking' => 'required',
            'call_on_board' => 'required',
            'knowledge_gain' => 'required',
            'skill_gain_spoken' => 'required',
            'skill_gain_written' => 'required',
            'personality_trait_confidence' => 'required',
            'response_of_previous_knowledge' => 'required',
            'total_marks' => 'required',
            'percentage' => 'required',
            'observer_guidance' => 'nullable',
            'teacher_views' => 'nullable',
        ]);
    }

    private function getCampusesAndTeachers()
    {
        return [
            'campuses' => Campus::all(),
            'teachers' => Teacher::all(),
        ];
    }

    public function index()
    {
        $evaluations = EvaluationForm::with(['campus', 'teacher'])->get();
        return view('evaluation.index', compact('evaluations'));
    }

    public function create()
    {
        $data = $this->getCampusesAndTeachers();
        return view('evaluation.create', $data);
    }

    public function store(Request $request)
    {
        try {
            $validated = $this->validateEvaluation($request);
            EvaluationForm::create($validated);

            return redirect()->route('evaluation.index')->with('success', 'Evaluation created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while saving the evaluation.')->withInput();
        }
    }

    public function edit($id)
    {
        $evaluation = EvaluationForm::findOrFail($id);
        $data = array_merge(['evaluation' => $evaluation], $this->getCampusesAndTeachers());

        return view('evaluation.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            $evaluation = EvaluationForm::findOrFail($id);
            $validated = $this->validateEvaluation($request);
            $evaluation->update($validated);

            return redirect()->route('evaluation.index')->with('success', 'Evaluation updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while updating the evaluation.')->withInput();
        }
    }

    public function destroy($id)
    {
        $evaluation = EvaluationForm::findOrFail($id);
        $evaluation->delete();

        return redirect()->route('evaluation.index')->with('success', 'Evaluation deleted successfully!');
    }

    public function getTeachers($campusId)
    {
        $teachers = Teacher::where('campus_id', $campusId)->get(['id', 'first_name', 'last_name'])->map(function ($teacher) {
            return [
                'id' => $teacher->id,
                'name' => $teacher->first_name . ' ' . $teacher->last_name,
            ];
        });

        return response()->json($teachers);
    }

    public function showEvaluationForm($id)
    {
        $evaluation = EvaluationForm::findOrFail($id);
        return view('evaluation.evaluation_pdf', compact('evaluation'));
    }

    public function downloadPDF($id)
    {
        $evaluation = EvaluationForm::with('campus')->findOrFail($id);
        $evaluation->checklist = [
            ['criteria' => 'Appearance/Dress code', 'total_marks' => 3, 'obtained_marks' => 2, 'remarks' => 'Good'],
            // Add more checklist items as needed
        ];

        $pdf = Pdf::loadView('evaluation.evaluation_pdf', compact('evaluation'));
        return $pdf->download('evaluation_' . $evaluation->id . '.pdf');
    }
}
