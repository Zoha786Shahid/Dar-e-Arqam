<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    private function validateSubject(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
    }

    private function handleSubjectSave(Request $request, Subject $subject = null)
    {
        $data = $this->validateSubject($request);

        $subject ? $subject->update($data) : Subject::create($data);
    }

    public function index()
    {
        $subjects = Subject::all();
        return view('subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('subjects.create');
    }

    public function store(Request $request)
    {
        $this->handleSubjectSave($request);
        return redirect()->route('subjects.index')->with('success', 'Subject created successfully.');
    }

    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $this->handleSubjectSave($request, $subject);
        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully!');
    }

    public function getSubjects($sectionId)
    {
        $subjects = Subject::whereHas('sections', function ($query) use ($sectionId) {
            $query->where('id', $sectionId);
        })->get();

        return response()->json(['subjects' => $subjects]);
    }
    public function getSubjectsBySection(Request $request)
    {
        // dd('Section ID:', [$request->input('section_id')]);
        $subjects = Subject::whereHas('teacherSectionSubjects', function ($query) use ($request) {
            $query->where('section_id', $request->input('section_id'));
        })->get(['id', 'name']);
    
    
    
        return response()->json(['subjects' => $subjects]);
    }
    
  
    
}
