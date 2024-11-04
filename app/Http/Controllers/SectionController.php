<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\Section;

use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::with('class')->get(); // Eager load the class relationship
        return view('sections.index', compact('sections'));
    }

    public function getSectionsByClass(Request $request)
    {
        $classId = $request->input('class_id');
        $sections = Section::where('class_id', $classId)->get();

        return response()->json(['sections' => $sections]);
    }
    public function create()
    {
        $classes = SchoolClass::all();
        return view('sections.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class_id' => 'required|exists:classes,id', // Ensures a valid class is selected
            'code' => 'nullable|string|unique:sections,code',
        ]);

        // Create the section with the name, class_id, and code
        Section::create($request->only('name', 'class_id', 'code'));

        return redirect()->route('sections.index')->with('success', 'Section created successfully.');
    }


    public function edit(Section $section)
    {
        // Fetch all classes for the dropdown
        $classes = SchoolClass::all();

        // Pass both the section and classes to the view
        return view('sections.edit', compact('section', 'classes'));
    }

    public function update(Request $request, Section $section)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class_id' => 'required|exists:classes,id', // Ensures a valid class is selected
            'code' => 'nullable|string|unique:sections,code,' . $section->id, // Ensures unique code except for this section
        ]);

        // Update the section with the name, class_id, and code
        $section->update($request->only('name', 'class_id', 'code'));

        return redirect()->route('sections.index')->with('success', 'Section updated successfully.');
    }


    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('sections.index')->with('success', 'Section deleted successfully.');
    }
    public function getSections($classId)
    {
        $sections = Section::where('class_id', $classId)->get();
        return response()->json(['sections' => $sections]);
    }
}
