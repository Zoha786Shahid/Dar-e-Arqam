<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
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
        Subject::create($request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]));
        return redirect()->route('subjects.index')->with('success', 'Subjec created successfully.');
    }

    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $subject->update($request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]));
        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully!');
    }
    public function getSubjects($sectionId)
{
    $subjects = Subject::whereHas('sections', function($query) use ($sectionId) {
        $query->where('id', $sectionId);
    })->get();

    return response()->json(['subjects' => $subjects]);
}

}
