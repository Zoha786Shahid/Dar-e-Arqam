<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReportCard;
use App\Models\Teacher;
use App\Models\Campus;
use App\Models\Section;
use App\Models\Subject;
use App\Models\SchoolClass;
use Barryvdh\DomPDF\Facade\Pdf;
use Mpdf\Mpdf;

class ReportCardController extends Controller
{
    private function validateReportCard(Request $request)
    {
        return $request->validate([
            'teacher_id' => 'required',
            'campus_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
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
    }

    private function getCampusesAndTeachers()
    {
        return [
            'teachers' => Teacher::all(),
            'campuses' => Campus::all(),
        ];
    }

 
    // public function index()
    // {
    //     $user = auth()->user();
    
    //     // Filter reports based on the user's role
    //     $reports = $user->hasRole('Principal')
    //         ? ReportCard::with('teacher', 'campus')->where('campus_id', $user->campus_id)->get()
    //         : ReportCard::with('teacher', 'campus')->get();
    
    //     return view('report.index', compact('reports'));
    // }
    public function index(Request $request)
{
    $user = auth()->user();
    $search = $request->input('search'); // Get the search query

    // Base query
    $query = ReportCard::with(['teacher', 'campus']);

    // Filter reports based on the user's role
    if ($user->hasRole('Principal')) {
        $query->where('campus_id', $user->campus_id);
    }

    // Apply search filter for teacher name
    if ($search) {
        $query->whereHas('teacher', function ($q) use ($search) {
            $q->where('first_name', 'LIKE', "%$search%")
              ->orWhere('last_name', 'LIKE', "%$search%")
              ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%$search%"]);
        });
    }

    $reports = $query->get();

    return view('report.index', compact('reports', 'search'));
}

    
    // public function create()
    // {
    //     $data = $this->getCampusesAndTeachers();
    //     return view('report.create', $data);
    // }
    public function create()
    {
        $user = auth()->user();
    
        // Fetch campuses based on the role
        $campuses = $user->hasRole('Principal')
            ? Campus::where('id', $user->campus_id)->get()
            : Campus::all();
    
        $data = array_merge($this->getCampusesAndTeachers(), compact('campuses', 'user'));
    
        return view('report.create', $data);
    }
    
    public function store(Request $request)
    {
        try {
            $validatedData = $this->validateReportCard($request);
            ReportCard::create($validatedData);

            return redirect()->route('report.index')->with('success', 'Report card created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the report card.')->withInput();
        }
    }

    
    // public function edit($id)
    // {
    //     $evaluation = ReportCard::findOrFail($id);
    
    //     // Fetch teachers based on selected campus
    //     $teachers = Teacher::where('campus_id', $evaluation->campus_id)->get();
    
    //     // Fetch classes taught by the selected teacher
    //     $classes = SchoolClass::whereHas('sections.teacherSectionSubjects', function ($query) use ($evaluation) {
    //         $query->where('teacher_id', $evaluation->teacher_id);
    //     })->get();
    
    //     // Fetch sections for the selected class
    //     $sections = Section::where('class_id', $evaluation->class_id)->get();
    
    //     // Fetch subjects for the selected section
    //     $subjects = Subject::whereHas('teacherSectionSubjects', function ($query) use ($evaluation) {
    //         $query->where('section_id', $evaluation->section_id);
    //     })->get();
    
    //     $data = array_merge([
    //         'evaluation' => $evaluation,
    //         'teachers' => $teachers,
    //         'classes' => $classes,
    //         'sections' => $sections,
    //         'subjects' => $subjects,
    //     ], $this->getCampusesAndTeachers());
    
    //     return view('report.edit', $data);
    // }
    public function edit($id)
{
    $user = auth()->user();
    $evaluation = ReportCard::findOrFail($id);

    // Fetch campuses based on the role
    $campuses = $user->hasRole('Principal')
        ? Campus::where('id', $user->campus_id)->get()
        : Campus::all();

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
        'campuses' => $campuses,
        'user' => $user,
    ], $this->getCampusesAndTeachers());

    return view('report.edit', $data);
}

    public function update(Request $request, $id)
    {
        try {
            $validated = $this->validateReportCard($request);
            $evaluation = ReportCard::findOrFail($id);
            $evaluation->update($validated);

            return redirect()->route('report.index')->with('success', 'Report card updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the report card.')->withInput();
        }
    }

    public function destroy(ReportCard $report)
    {
        $report->delete();
        return redirect()->route('report.index')->with('success', 'Report card deleted successfully.');
    }

    public function showEvaluationForm($id)
    {
        $evaluation = ReportCard::findOrFail($id);
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

    public function show(ReportCard $report)
    {
        return view('report.show', compact('report'));
    }
}
