<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\ClassModel;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SectionController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:2048',
        ]);
    
        if ($request->hasFile('csv_file')) {
            $file = $request->file('csv_file');
            $csvData = array_map('str_getcsv', file($file->getRealPath()));
            $header = array_shift($csvData); // Extract the header row
    
            $sectionsByClass = []; // To group sections by class_id
    
            foreach ($csvData as $row) {
                $rowData = array_combine($header, $row);
    
                // Group sections by class_id
                $classId = $rowData['class_id'];
                $sectionsByClass[$classId][] = $rowData['name'];
            }
    
            // Loop through each class and create a single record with combined sections
            foreach ($sectionsByClass as $classId => $sections) {
                $combinedSections = implode(',', $sections);
    
                Section::create([
                    'name' => $combinedSections, // Save sections as a single comma-separated string
                    'class_id' => $classId,
                    'code' => null, // Or generate a unique code if needed
                ]);
            }
    
            return redirect()->route('sections.index')->with('success', 'Sections imported successfully!');
        }
    
        return redirect()->back()->with('error', 'File upload failed!');
    }
    

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
        $sections = DB::table('lists')->pluck('name');
        return view('sections.create', compact('classes', 'sections'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'section' => 'required|array', // Ensure it's an array (multi-select)
            'section.*' => 'required|string|max:255', // Validate each selected section
            'class_id' => 'required|exists:classes,id', // Ensures a valid class is selected
            'code' => 'nullable|string|unique:sections,code',
        ]);
    
        // Combine all selected sections into a single string
        $combinedSections = implode(',', $request->section);
    
        // Create a single record with the combined sections
        Section::create([
            'name' => $combinedSections, // Save sections as a single comma-separated string
            'class_id' => $request->class_id,
            'code' => $request->code,
        ]);
    
        return redirect()->route('sections.index')->with('success', 'Sections created successfully.');
    }
    


    public function edit(Section $section)
    {
        // Fetch all classes for the dropdown
        $classes = SchoolClass::all();

        // Fetch all sections for the dropdown
        $sections = DB::table('lists')->pluck('name');

        // Pass the section, classes, and available sections to the view
        return view('sections.edit', compact('section', 'classes', 'sections'));
    }


    public function update(Request $request, Section $section)
    {
        $request->validate([
            'section' => 'required|array', // Ensure it's an array (multi-select)
            'section.*' => 'required|string|max:255', // Validate each section name
            'class_id' => 'required|exists:classes,id', // Ensures a valid class is selected
            'code' => 'nullable|string|unique:sections,code,' . $section->id, // Ensures unique code except for this section
        ]);

        // Combine the selected sections into a string (if stored as CSV in the database)
        $sectionNames = implode(',', $request->section);

        // Update the section with the selected names, class_id, and code
        $section->update([
            'name' => $sectionNames, // Store selected sections
            'class_id' => $request->class_id,
            'code' => $request->code,
        ]);

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
