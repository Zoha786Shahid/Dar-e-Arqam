<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Campus;
use App\Models\Section;
use App\Models\Subject;
use App\Models\SchoolClass;
use App\Models\EvaluationForm;
use Illuminate\Support\Facades\Log;
// use Barryvdh\DomPDF\Facade\Pdf;
use App\Helpers\SearchHelper;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class EvaluationController extends Controller
{
    private function validateEvaluation(Request $request)
    {
        return $request->validate([
            'teacher_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
            'campus_id' => 'required',
            'total_students' => 'required',
            'evaluation_date' => 'nullable|date', 
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

  
    public function index(Request $request)
{
    $user = auth()->user();
    $search = $request->input('search');
    $campusFilter = $request->input('campus');
    $teacherFilter = $request->input('teacher');
    $subjectFilter = $request->input('subject');
    // Use 'schoolClass' instead of 'class' to match the model relationship
    $query = EvaluationForm::with(['campus', 'teacher', 'subject', 'schoolClass', 'section']);

    if ($user->hasRole('Principal')) {
        $query->where('campus_id', $user->campus_id);
    }

    if ($search) {
        $query = SearchHelper::filterByTeacherName($query, $search);
    }

    if ($campusFilter) {
        $query->where('campus_id', $campusFilter);
    }

    if ($teacherFilter) {
        $query->whereIn('teacher_id', explode(',', $teacherFilter));
    }

    if ($subjectFilter) {
        $query->where('subject_id', $subjectFilter);
    }

    // $evaluations = $query->get()->sortBy('subject_id')->groupBy('subject_id')->map(function ($subjectGroup) {
    //     return $subjectGroup->sortBy('teacher_id')->groupBy('teacher_id');
    // });
    $evaluations = $query->get();
    $campuses = Campus::all();
    $teachers = Teacher::all();
    $subjects = Subject::all();
    $classes = SchoolClass::all();

    return view('evaluation.index', compact('evaluations', 'search', 'campuses', 'teachers', 'subjects', 'classes'));
}

    public function create()
{
    $user = auth()->user();

    // Filter campuses if the user is a Principal
    $campuses = $user->hasRole('Principal')
        ? Campus::where('id', $user->campus_id)->get()
        : Campus::all();

    $data = array_merge($this->getCampusesAndTeachers(), compact('campuses', 'user'));

    return view('evaluation.create', $data);
}

   public function store(Request $request)
{
    try {
        $validated = $this->validateEvaluation($request);
        
        // Ensure evaluation_date is always set to today
        $validated['evaluation_date'] = Carbon::today()->format('Y-m-d');
        
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
    $user = auth()->user();
    $evaluation = EvaluationForm::findOrFail($id);

    // Filter campuses if the user is a Principal
    $campuses = $user->hasRole('Principal')
        ? Campus::where('id', $user->campus_id)->get()
        : Campus::all();

    // Fetch teachers based on the selected campus
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

    return view('evaluation.edit', $data);
}

    
 public function update(Request $request, $id)
{
    try {
        $evaluation = EvaluationForm::findOrFail($id);
        $validated = $this->validateEvaluation($request);
        
        // Remove evaluation_date to prevent it from being updated
        unset($validated['evaluation_date']);
        
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
   


// public function batchDownload(Request $request)
// {
//     $user = auth()->user();
//     $subjectId = $request->input('subject_id');
    
//     \Log::info('Selected Filters:', [
//         'user_role' => $user->roles->pluck('name')->toArray(),
//         'subject_id' => $subjectId,
//     ]);

//     if ($user->hasRole('Owner')) {
//         $campusId = $request->input('campus_id');
//         $classIds = $request->input('class_ids', []);

//         \Log::info('Owner Selected Filters:', [
//             'campus_id' => $campusId,
//             'class_ids' => $classIds
//         ]);

//         // Query with filters but ensuring all sections are included
//         $query = EvaluationForm::with(['campus', 'teacher', 'schoolClass', 'section'])
//             ->where('subject_id', $subjectId);

//         if ($campusId) {
//             $query->where('campus_id', $campusId);
//         }

//         if (!empty($classIds)) {
//             $query->whereIn('class_id', $classIds);
//         }

//         \Log::info('Generated Query for Owner:', ['query' => $query->toSql()]);
//         $evaluations = $query->get();
//     } 
//     elseif ($user->hasRole('Principal')) {
//         $campusId = $request->input('campus_id');
//         $teacherId = $request->input('teacher_id');
//         $subjectId = $request->input('subject_id'); // Ensure this is set correctly
    
//         \Log::info('Principal Selected Filters:', [
//             'campus_id' => $campusId,
//             'teacher_id' => $teacherId,
//             'subject_id' => $subjectId
//         ]);
    
//         $query = EvaluationForm::with(['campus', 'teacher', 'schoolClass', 'section'])
//             ->where('campus_id', $campusId);
    
//         if ($subjectId) {
//             $query->where('subject_id', $subjectId);
//         }
    
//         if ($teacherId) {
//             $query->where('teacher_id', $teacherId);
//         }
    
//         \Log::info('Generated Query for Principal:', ['query' => $query->toSql()]);
//         $evaluations = $query->get();
//     }
    
//     else {
//         // For non-owners, only filter by subject_id
//         $evaluations = EvaluationForm::where('subject_id', $subjectId)
//             ->with(['campus', 'teacher', 'schoolClass', 'section'])
//             ->get();
//     }

//     \Log::info('Evaluations Retrieved:', ['evaluations' => $evaluations]);

//     if ($evaluations->isEmpty()) {
//         return redirect()->back()->with('error', 'No evaluations found for the selected filters.');
//     }

//     $pdf = Pdf::loadView('evaluation.batch_pdf', compact('evaluations'));

//     return $pdf->download('batch_evaluations.pdf');
// }
public function batchDownload(Request $request)
{
    $user = auth()->user();
    $subjectId = $request->input('subject_id');
    $campusId = $request->input('campus_id');
    $classIds = $request->input('class_ids', []);
    $teacherId = $request->input('teacher_id');

    \Log::info('Selected Filters:', [
        'user_role' => $user->roles->pluck('name')->toArray(),
        'subject_id' => $subjectId,
        'campus_id' => $campusId,
        'class_ids' => $classIds,
        'teacher_id' => $teacherId
    ]);

    // Check if user is either Owner or Principal
    if ($user->hasRole('Owner') || $user->hasRole('Principal')) {

        \Log::info('Owner/Principal Selected Filters:', [
            'campus_id' => $campusId,
            'class_ids' => $classIds,
            'teacher_id' => $teacherId
        ]);

        // Query with all filters for Owner/Principal
        $query = EvaluationForm::with(['campus', 'teacher', 'schoolClass', 'section']);

        // Fetch evaluations based on selected teacher or filters
        if ($teacherId) {
            // If a teacher is selected, fetch report only for that teacher
            $query->where('teacher_id', $teacherId);
        } else {
            // Otherwise, use filters for Owner
            if ($subjectId) {
                $query->where('subject_id', $subjectId);
            }

            if ($campusId) {
                $query->where('campus_id', $campusId);
            }

            if (!empty($classIds)) {
                $query->whereIn('class_id', $classIds);
            }
        }

        // If the user is a Principal, filter campuses and teachers accordingly
        if ($user->hasRole('Principal')) {
            $campuses = Campus::where('id', $user->campus_id)->get(); // Show only the campus related to Principal
            $teachers = Teacher::where('campus_id', $user->campus_id)->get(); // Filter teachers based on Principal's campus
        } else {
            $campuses = Campus::all(); // If Owner, show all campuses
            $teachers = Teacher::where('campus_id', $campusId)->get(); // Filter teachers based on selected campus
        }

        \Log::info('Generated Query for Owner/Principal:', ['query' => $query->toSql()]);
        $evaluations = $query->get();

    } else {
        // For other users, only filter by subject_id
        $evaluations = EvaluationForm::where('subject_id', $subjectId)
            ->with(['campus', 'teacher', 'schoolClass', 'section'])
            ->get();
        
        // No need to fetch teachers for other roles
        $teachers = collect();
        $campuses = collect();
    }

    \Log::info('Evaluations Retrieved:', ['evaluations' => $evaluations]);

    if ($evaluations->isEmpty()) {
        return redirect()->back()->with('error', 'No evaluations found for the selected filters.');
    }

    // Load PDF view and download
    $pdf = Pdf::loadView('evaluation.batch_pdf', compact('evaluations'));

    return $pdf->download('batch_evaluations.pdf');
}




    public function getSectionsByClass(Request $request)
    {
        $sections = Section::where('class_id', $request->input('class_id'))->get();
        return response()->json(['sections' => $sections]);
    }
    
    


}
