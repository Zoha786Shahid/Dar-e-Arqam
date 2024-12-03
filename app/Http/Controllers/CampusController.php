<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use Illuminate\Http\Request;

class CampusController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view campus')->only(['index', 'show']);
        $this->middleware('permission:edit campus')->only(['edit', 'update']);
        $this->middleware('permission:delete campus')->only(['destroy']);
    }

    private function validateCampus(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'website' => 'nullable|url|max:255',
            'principal_name' => 'nullable|string|max:255',
            'principal_email' => 'nullable|email|max:255',
            'principal_phone' => 'nullable|string|max:20',
            'capacity' => 'nullable|integer',
            'status' => 'required|in:active,inactive',
            'description' => 'nullable|string',
        ]);
    }

    private function findCampus($id)
    {
        return Campus::findOrFail($id);
    }

    public function index()
    {
        $user = auth()->user();
        $campuses = $user->hasRole('Principal')
            ? Campus::where('id', $user->campus_id)->get()
            : Campus::all();

        return view('campus.index', compact('campuses'));
    }

    public function create()
    {
        return view('campus.create');
    }

    public function store(Request $request)
    {
        Campus::create($this->validateCampus($request));
        return redirect()->route('campus.index')->with('success', 'Campus created successfully.');
    }

    public function show($id)
    {
        $campus = $this->findCampus($id);
        return view('campuses.show', compact('campus'));
    }

    public function edit($id)
    {
        $campus = $this->findCampus($id);
        return view('campus.edit', compact('campus'));
    }

    public function update(Request $request, Campus $campus)
    {
        $campus->update($this->validateCampus($request));
        return redirect()->route('campus.index')->with('success', 'Campus updated successfully.');
    }

    public function destroy($id)
    {
        $campus = $this->findCampus($id);

        try {
            $campus->delete();
            return redirect()->route('campus.index')->with('success', 'Campus deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('campus.index')->with('error', 'Error deleting campus!');
        }
    }
}
