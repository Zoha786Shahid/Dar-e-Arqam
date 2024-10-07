<?php

namespace App\Http\Controllers;
use App\Models\Campus;
use App\Models\User;
use Illuminate\Http\Request;

class CampusController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view campus')->only(['index', 'show']);
        $this->middleware('permission:edit campus')->only(['edit', 'update']);
        $this->middleware('permission:delete campus')->only(['destroy']);
    }
        // Display a listing of the resource
        public function index()
        {
            $campuses = Campus::all();
            $user = User::find(1); // Use auth()->id() to get the logged-in user dynamically
            
            // Fetch all permissions the user has
            $permissions = $user->getAllPermissions(); // Correct method to get user permissions
            
            // dd('User ID: ' . $user->id . ', Permissions: ', $permissions->toArray());
        
            return view('campus.index', compact('campuses'));
        }
        
        // Show the form for creating a new resource
        public function create()
        {
            return view('campus.create');
        }
    
        // Store a newly created resource in storage
        public function store(Request $request)
        {
            // Validate the request
            $validated = $request->validate([
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
            // Create a new campus
            Campus::create($validated);
            // Redirect to the index page with success message
            return redirect()->route('campus.index')->with('success', 'Campus created successfully.');
        }
        
    
        
        public function show($id)
    {
        // Find the campus by ID or return a 404 error
        $campus = Campus::findOrFail($id);
        
        // Return a view with the campus details
        return view('campuses.show', compact('campus'));
    }
        // Show the form for editing the specified resource
        public function edit($id)
        {
            $campus = Campus::findOrFail($id);
            return view('campus.edit', compact('campus'));
            
        }
        
     // Update the specified resource in storage
     public function update(Request $request, Campus $campus)
     {
         // Validate the request
         $request->validate([
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
 
         // Update the campus data
         $campus->update($request->all());
 
         // Redirect to the index page with success message
         return redirect()->route('campus.index')->with('success', 'Campus updated successfully.');
     }
 
        
     public function destroy($id)
{
    $campus = Campus::findOrFail($id);
    
    try {
        $campus->delete();
        return redirect()->route('campus.index')->with('success', 'Campus deleted successfully!');
    } catch (\Exception $e) {
        return redirect()->route('campus.index')->with('error', 'Error deleting campus!');
    }
}

}
