<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReportCard;
use App\Models\Teacher;
use App\Models\Campus;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Mpdf\Mpdf;


class ReportCardController extends Controller
{

    public function showEvaluationForm($id)
    {
        // Fetch evaluation data
        $evaluation = ReportCard::findOrFail($id);

        // Pass the evaluation data to the view
        return view('seniorEvaluation.evaluation_pdf', compact('evaluation'));
    }



    public function downloadReportCard($id)
    {
        $evaluation = ReportCard::with('campus')->findOrFail($id);

        $mpdf = new Mpdf([
            'default_font' => 'Jameel Noori Nastaleeq',
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P',
            'default_font_size' => 12,
        ]);

        $html = view('report.evaluation_pdf', compact('evaluation'))->render();
        $mpdf->WriteHTML($html);
        return $mpdf->Output('evaluation_' . $evaluation->id . '.pdf', 'D');
    }

    // Display a listing of the report cards
    public function index()
    {

        $reports = ReportCard::with('teacher', 'campus')->get();
        return view('report.index', compact('reports'));
    }

    // Show the form for creating a new report card
    public function create()
    {

        // Fetch teachers and campuses from the database
        $teachers = Teacher::all();
        $campuses = Campus::all();
        return view('report.create', compact('teachers', 'campuses'));
    }
    // Store a newly created report card in storage
    public function store(Request $request)
    {
        // Validate the form inputs
        $validatedData = $request->validate([
            'teacher_id' => 'required',
            'campus_id' => 'required',
            'entrance_welcome' => 'required',
            'appearance_dress' => 'required',
            'teaching_style' => 'required',
            'safety_cleanliness' => 'required',
            'discipline' => 'required',
            'class_board' => 'required',
            'teaching_plan' => 'required',
            'student_preparation' => 'required',
            'conversation_standard' => 'required',
            'hifz_during_teaching' => 'required',
            'hifz_fluency' => 'required',
            'recitation' => 'required',
            'moral_training' => 'required',
            'intellectual_moral_training' => 'required',
            'physical_strength_health' => 'required',
            'time_management' => 'required',
            'student_performance' => 'required',
            'diary' => 'required',
            'total_marks' => 'required|integer|min:0',
        ]);


        ReportCard::create($validatedData);

        // Redirect with success message
        return redirect()->route('report.index')->with('success', 'Report card created successfully');
    }


    // Display the specified report card
    public function show(ReportCard $report)
    {
        return view('report.show', compact('report'));
    }

    // Show the form for editing the specified report card

    public function edit($id)
    {
        // Find the evaluation by ID
        $evaluation = ReportCard::findOrFail($id);

        // Fetch campuses and teachers again
        $campuses = Campus::all();
        $teachers = Teacher::all(); // Fetch all teachers to populate the dropdown

        // Pass the evaluation, campuses, and teachers to the view
        return view('report.edit', compact('evaluation', 'campuses', 'teachers'));
    }


    // Update the specified report card in storage
    public function update(Request $request, $id)
    {
        try {
            // Log the incoming request data


            // Validate the incoming request data
            $validated = $request->validate([
                'teacher_id' => 'required',
                'campus_id' => 'required',
                'entrance_welcome' => 'required',
                'appearance_dress' => 'required',
                'teaching_style' => 'required',
                'safety_cleanliness' => 'required',
                'discipline' => 'required',
                'class_board' => 'required',
                'teaching_plan' => 'required',
                'student_preparation' => 'required',
                'conversation_standard' => 'required',
                'hifz_during_teaching' => 'required',
                'hifz_fluency' => 'required',
                'recitation' => 'required',
                'moral_training' => 'required',
                'intellectual_moral_training' => 'required',
                'physical_strength_health' => 'required',
                'time_management' => 'required',
                'student_performance' => 'required',
                'diary' => 'required',
                'total_marks' => 'required',
            ]);

            // Fetch the existing evaluation record
            $evaluation = ReportCard::findOrFail($id);

            // Try updating the evaluation record
            $updated = $evaluation->update($validated);

            // Log the result of the update attempt
            // Log::info('Update Status: ' . ($updated ? 'Success' : 'Failed'));

            // Redirect with success message
            return redirect()->route('report.index')->with('success', 'Evaluation updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log validation errors
            // Log::error('Validation Errors: ' . json_encode($e->errors()));

            // Redirect back with validation errors and input data
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Log any other exceptions
            // Log::error('Exception: ' . $e->getMessage());

            // Redirect back with a generic error message
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the evaluation.'])->withInput();
        }
    }

    // Remove the specified report card from storage
    public function destroy(ReportCard $report)
    {
        $report->delete();
        return redirect()->route('report.index')->with('success', 'Report card deleted successfully');
    }
}
