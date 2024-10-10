<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Campus;
use App\Models\SeniorEvaluationReport;
use Illuminate\Support\Facades\Log; 
use Barryvdh\DomPDF\Facade\Pdf;
class SeniorEvaluationReportController extends Controller
{


    public function showEvaluationForm($id)
{
    // Fetch evaluation data
    $evaluation = SeniorEvaluationReport::find($id);

    // Pass the evaluation data to the view
    return view('seniorEvaluation.evaluation_pdf', compact('evaluation'));
}

    public function downloadEvaluationPDF($id)
    {
        $evaluation = SeniorEvaluationReport::with('campus')->findOrFail($id);
        $evaluation->checklist = [
            [
                'criteria' => 'Appearance/Dress code',
                'total_marks' => 3,
                'obtained_marks' => 2,
                'remarks' => 'Good'
            ],
            // Additional checklist items
        ];
        $pdf = Pdf::loadView('seniorEvaluation.evaluation_pdf', compact('evaluation'));
    
        return $pdf->download('evaluation_'.$evaluation->id.'.pdf');
    }


    // Display a list of reports
    public function index()
    {
        // Fetch all reports with related teacher and campus data
        $reports = SeniorEvaluationReport::with('teacher', 'campus')->get();
        return view('seniorEvaluation.index', compact('reports'));
    }

    // Show the form for creating a new report
    public function create()
    {
        // Fetch teachers and campuses from the database
        $teachers = Teacher::all();
        $campuses = Campus::all();
        return view('seniorEvaluation.create', compact('teachers', 'campuses'));
    }

    // Store a newly created report in storage
    public function store(Request $request)
    {
        // dd($request->all());
        // Validate input data
        $request->validate([
            'teacher_id' => 'required',
            'campus_id' => 'required',
            'observer_name' => 'nullable',
            'observer_guidance' => 'nullable',
            'teacher_views' => 'nullable',
            'entrance_welcome_marks' => 'required',

            'appearance_dress_code_marks' => 'required',

            'seating_cleanliness_marks' => 'required',

            'writing_board_prep_marks' => 'required',

            'writing_board_use_marks' => 'required',

            'syllabus_division_marks' => 'required',

            'assessment_start_marks' => 'required',

            'pk_testing_marks' => 'required',

            'av_activities_marks' => 'required',

            'teaching_methods_marks' => 'required',

            'subject_command_marks' => 'required',

            'student_clarity_marks' => 'required',

            'student_involvement_marks' => 'required',

            'individual_attention_marks' => 'required',

            'copy_work_marks' => 'required',

            'moral_training_marks' => 'required',

            'reading_marking_objective_marks' => 'required',

            'lecture_planning_marks' => 'required',

            'time_management_marks' => 'required',


            'spoken_english_marks' => 'required',

            'evaluation_marks' => 'required',

            'home_task_checking_marks' => 'required',

            'class_discipline_marks' => 'required',
            'total_marks' => 'required',


        ]);

        // Create and save the new report
        SeniorEvaluationReport::create($request->all());

        return redirect()->route('seniorevaluation.index')
            ->with('success', 'Evaluation report created successfully.');
    }

    // Show a specific report
    public function show(SeniorEvaluationReport $seniorEvaluationReport)
    {
        return view('seniorEvaluation.show', compact('seniorEvaluationReport'));
    }

    // Show the form for editing the specified report


    public function edit($id)
    {
        // Find the evaluation by ID
        $evaluation = SeniorEvaluationReport::findOrFail($id);

        // Fetch campuses and teachers again
        $campuses = Campus::all();
        $teachers = Teacher::all(); // Fetch all teachers to populate the dropdown

        // Pass the evaluation, campuses, and teachers to the view
        return view('seniorEvaluation.edit', compact('evaluation', 'campuses', 'teachers'));
    }

    // Update the specified report in storage
   // Make sure you have this at the top of the controller file



public function update(Request $request, $id)
{
    try {
        // Log the incoming request data
        Log::info($request->all());

        // Validate the incoming request data
        $validated = $request->validate([
            'teacher_id' => 'required|integer',
            'campus_id' => 'required|integer',
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

        // Fetch the existing evaluation record
        $evaluation = SeniorEvaluationReport::findOrFail($id);

        // Try updating the evaluation record
        $updated = $evaluation->update($validated);

        // Log the result of the update attempt
        Log::info('Update Status: ' . ($updated ? 'Success' : 'Failed'));

        // Redirect with success message  return redirect()->route('seniorevaluation.index')
        return redirect()->route('seniorevaluation.index')->with('success', 'Evaluation updated successfully.');

    } catch (\Illuminate\Validation\ValidationException $e) {
        // Log validation errors
        Log::error('Validation Errors: ' . json_encode($e->errors()));

        // Redirect back with validation errors and input data
        return redirect()->back()->withErrors($e->errors())->withInput();

    } catch (\Exception $e) {
        // Log any other exceptions
        Log::error('Exception: ' . $e->getMessage());

        // Redirect back with a generic error message
        return redirect()->back()->withErrors(['error' => 'An error occurred while updating the evaluation.'])->withInput();
    }
}

    

    // Remove the specified report from storage
    public function destroy(SeniorEvaluationReport $seniorEvaluationReport)
    {
        $seniorEvaluationReport->delete();

        return redirect()->route('seniorEvaluation.index')
            ->with('success', 'Evaluation report deleted successfully.');
    }
}
