<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SectionController extends Controller
{
    private function validateSection(Request $request, $isUpdate = false, $sectionId = null)
    {
        return $request->validate([
            'section' => 'required|array',
            'section.*' => 'required|string|max:255',
            'class_id' => 'required|exists:classes,id',
            'code' => $isUpdate
                ? 'nullable|string|unique:sections,code,' . $sectionId
                : 'nullable|string|unique:sections,code',
        ]);
    }

    private function handleSectionSave(Request $request, Section $section = null)
    {
        $combinedSections = implode(',', $request->section);

        $data = [
            'name' => $combinedSections,
            'class_id' => $request->class_id,
            'code' => $request->code,
        ];

        $section ? $section->update($data) : Section::create($data);
    }

    public function index()
    {
        $sections = Section::with('class')->get();
        return view('sections.index', compact('sections'));
    }

    public function create()
    {
        $classes = SchoolClass::all();
        $sections = DB::table('lists')->pluck('name');
        return view('sections.create', compact('classes', 'sections'));
    }

    public function store(Request $request)
    {
        $this->validateSection($request);
        $this->handleSectionSave($request);
        return redirect()->route('sections.index')->with('success', 'Sections created successfully.');
    }

    public function edit(Section $section)
    {
        $classes = SchoolClass::all();
        $sections = DB::table('lists')->pluck('name');
        return view('sections.edit', compact('section', 'classes', 'sections'));
    }

    public function update(Request $request, Section $section)
    {
        $this->validateSection($request, true, $section->id);
        $this->handleSectionSave($request, $section);
        return redirect()->route('sections.index')->with('success', 'Section updated successfully.');
    }

    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('sections.index')->with('success', 'Section deleted successfully.');
    }

    public function getSectionsByClass(Request $request)
    {
        $sections = Section::where('class_id', $request->input('class_id'))->get();
        return response()->json(['sections' => $sections]);
    }

    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:2048',
        ]);

        if ($request->hasFile('csv_file')) {
            $file = $request->file('csv_file');
            $csvData = array_map('str_getcsv', file($file->getRealPath()));
            $header = array_shift($csvData);

            $sectionsByClass = [];
            foreach ($csvData as $row) {
                $rowData = array_combine($header, $row);
                $sectionsByClass[$rowData['class_id']][] = $rowData['name'];
            }

            foreach ($sectionsByClass as $classId => $sections) {
                Section::create([
                    'name' => implode(',', $sections),
                    'class_id' => $classId,
                    'code' => null,
                ]);
            }

            return redirect()->route('sections.index')->with('success', 'Sections imported successfully!');
        }

        return redirect()->back()->with('error', 'File upload failed!');
    }

    public function getSections($classId)
    {
        $sections = Section::where('class_id', $classId)->get();
        return response()->json(['sections' => $sections]);
    }
}
