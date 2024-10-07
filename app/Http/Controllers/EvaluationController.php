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

    public function showEvaluationForm($id)
{
    // Fetch evaluation data
    $evaluation = Evaluation::find($id);

    // Pass the evaluation data to the view
    return view('evaluation.evaluation_pdf', compact('evaluation'));
}

    public function downloadPDF($id)
    {
        $evaluation = EvaluationForm::with('campus')->findOrFail($id);
        $evaluation->checklist = [
            [
                'criteria' => 'Appearance/Dress code',
                'total_marks' => 3,
                'obtained_marks' => 2,
                'remarks' => 'Good'
            ],
            // Additional checklist items
        ];
        $pdf = Pdf::loadView('evaluation.evaluation_pdf', compact('evaluation'));
    
        return $pdf->download('evaluation_'.$evaluation->id.'.pdf');
    }

       // Display a listing of the evaluation forms
       public function index()
       {
           // Fetch all evaluation forms with their associated campuses
           $evaluations = EvaluationForm::with('campus')->get();
           return view('evaluation.index', compact('evaluations'));
       }
       
    // Show the form for creating a new evaluation
    public function create()
    {
        // Fetch campuses from the database
        $campuses = Campus::all(); // Assuming you have a Campus model
 
        // Pass campuses to the view
        return view('evaluation.create', compact('campuses'));
    }

     // Store a newly created evaluation in storage
public function store(Request $request)
{
    try {
    //    dd($request->all());
        // Validate the request
        $validated = $request->validate([
            'teacher_name' => 'required',
            'qualification' => 'required',
            'joining_date' => 'required',
            'class_section' => 'required',
            'subject' => 'required',
            'topic' => 'nullable', // Assuming topic can be optional
            'campus_id' => 'required',
            'total_students' => 'required',
            'date' => 'required',
            'appearance_dress_code' => 'required',
            'lesson_plan' => 'required',
            'assessment' => 'nullable', // Assuming assessment can be optional
            'observer_name' => 'required',
            'observer_signature' => 'required',
            // 'standard_of_lesson_plan' => 'required',
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
            'class_participation' => 'required',
            'call_on_board' => 'required',
            'knowledge_gain' => 'required',
            'skill_gain_spoken' => 'required',
            'skill_gain_written' => 'required',
            'personality_trait_confidence' => 'required',
            'response_of_previous_knowledge' => 'required',
            'total_marks' => 'required',
            // 'percentage' => 'required|numeric|min:0|max:100',
            'percentage' => 'required',
            'observer_guidance' => 'nullable',
            'teacher_views' => 'nullable',
            'teacher_signature' => 'required',
            
        ]);
      
        // Create the new evaluation and store it in the database
        EvaluationForm::create($validated);

        // Redirect with success message
        return redirect()->route('evaluation.index')->with('success', 'Evaluation created successfully.');

    } catch (\Illuminate\Validation\ValidationException $e) {
       
        // Handle validation errors
        return redirect()->back()
            ->withErrors($e->errors()) // Pass validation errors to the view
            ->withInput(); // Retain input values

    } catch (\Exception $e) {
       
        // Handle any other exceptions
        return redirect()->back()->withErrors(['error' => 'An error occurred while saving the evaluation.'])->withInput();
    }
}


    // Show the form for editing the specified evaluation
    public function edit($id)
    {
        // Find the evaluation by ID
        $evaluation = EvaluationForm::findOrFail($id);
        $campuses = Campus::all(); // Fetch campuses again
        return view('evaluation.edit', compact('evaluation', 'campuses'));
    }

    // Update the specified evaluation in storage
    public function update(Request $request, $id)
    {
        try {
            // Fetch the existing evaluation record by ID
            $evaluation = EvaluationForm::findOrFail($id);
    
            // Validate the request
            $validated = $request->validate([
                'teacher_name' => 'required',
                'qualification' => 'required',
                'joining_date' => 'required|date',
                'class_section' => 'required',
                'subject' => 'required',
                'topic' => 'nullable', // Assuming topic can be optional
                'campus_id' => 'required',
                'total_students' => 'required|integer',
                'date' => 'required|date',
                'appearance_dress_code' => 'required|integer',
                'lesson_plan' => 'required|integer',
                'assessment' => 'nullable|integer', // Assuming assessment can be optional
                'observer_name' => 'required',
                'observer_signature' => 'required',
                'standard_of_lesson_plan' => 'required|integer',
                'introduction_pk_testing' => 'required|string', // Adjust type if necessary
                'islamization' => 'required|integer',
                'gesture_tone_body_language' => 'required|integer',
                'communication_skill' => 'required|integer',
                'strategies_activities' => 'required|integer',
                'discipline_class_control' => 'required|integer',
                'tools_av_aids' => 'required|integer',
                'tools_illustrative_material' => 'required|integer',
                'tools_writing_board' => 'required|integer',
                'real_life_integration' => 'required|integer',
                'competency_command_on_subject' => 'required|integer',
                'time_management' => 'required|integer',
                'evaluation_conclusion' => 'required|string', // Adjust type if necessary
                'diary_hw_checking' => 'required|integer',
                'class_participation' => 'required|integer',
                'call_on_board' => 'required|integer',
                'knowledge_gain' => 'required|integer',
                'skill_gain_spoken' => 'required|integer',
                'skill_gain_written' => 'required|integer',
                'personality_trait_confidence' => 'required|integer',
                'response_of_previous_knowledge' => 'required|integer',
                'total_marks' => 'required|integer',
                'percentage' => 'required|numeric|min:0|max:100', // Adjust as needed
                'observer_guidance' => 'nullable|string',
                'teacher_views' => 'nullable|string',
                'teacher_signature' => 'required|string',
            ]);
    
            // Update the evaluation record with validated data
            $evaluation->update($validated);
    
            // Redirect with success message
            return redirect()->route('evaluation.index')->with('success', 'Evaluation updated successfully.');
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return redirect()->back()
                ->withErrors($e->errors()) // Pass validation errors to the view
                ->withInput(); // Retain input values
    
        } catch (\Exception $e) {
            // Handle any other exceptions
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the evaluation.'])->withInput();
        }
    }
    

    // Remove the specified evaluation from storage
    public function destroy($id)
    {
        // Find the evaluation by ID
        $evaluation = EvaluationForm::findOrFail($id);
        $evaluation->delete();

        return redirect()->route('teacher.evaluation.index')->with('success', 'Evaluation deleted successfully!');
    }
};