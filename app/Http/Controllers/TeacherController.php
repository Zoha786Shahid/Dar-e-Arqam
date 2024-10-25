<?php

namespace App\Http\Controllers;
use App\Models\Teacher;
use App\Models\Campus;
use Illuminate\Http\Request;

class TeacherController extends Controller
{

       // Display a listing of the teachers
    //    public function index()
    //    {
    //        try {
    //            // Authorize if the user can view any teachers
    //            $this->authorize('viewAny', Teacher::class);
       
    //            $user = auth()->user();
       
    //            // Show only teachers in the principal's campus
    //            if ($user->hasRole('Principal')) {
    //                $teachers = Teacher::where('campus_id', $user->campus_id)->get();
    //            } else {
    //                // Admins or other roles see all teachers
    //                $teachers = Teacher::all();
    //            }
       
    //            return view('teachers.index', compact('teachers'));
    //        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
    //            // Redirect back with an error message if unauthorized
    //            return redirect()->route('user.index')->with('error', 'Unauthorized access attempt.');
    //        }
    //    }
       
       
    public function index()
    {
        try {
            $user = auth()->user();
    
            // If the user has the Owner role, they can see all data
            if ($user->hasRole('Owner')) {
                $teachers = Teacher::all(); // Load all teachers for the Owner role
            } elseif ($user->hasRole('Principal')) {
                // Show only teachers in the principal's campus
                $teachers = Teacher::where('campus_id', $user->campus_id)->get();
            } else {
                // Admins or other roles can also see all teachers
                $teachers = Teacher::all();
            }
    
            return view('teachers.index', compact('teachers'));
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            // Redirect back with an error message if unauthorized
            return redirect()->route('user.index')->with('error', 'Unauthorized access attempt.');
        }
    }
    
       
   
       // Show the form for creating a new teacher
       public function create()
       {
           // Fetch campuses from the database
           $campuses = Campus::all(); // Adjust the model name as needed
       
           // Pass campuses to the view
           return view('teachers.create', compact('campuses'));
       }
       
       // Store a newly created teacher in storage
       public function store(Request $request)
       {
           try {
               // Validate the request
               $request->validate([
                   'first_name' => 'required|string|max:255',
                   'last_name' => 'required|string|max:255',
                   'date_of_birth' => 'required|date',
                   'gender' => 'required|string|in:male,female,other',
                   'phone_number' => 'required|string|max:15',
                   'email' => 'required|email|unique:teachers,email',
                   'address' => 'required|string|max:255',
                   'employee_id' => 'required|string|unique:teachers,employee_id',
                   'hire_date' => 'required|date',
                   'subjects' => 'required|string|max:255',
                   'qualification' => 'required|string|max:255',
                   'experience' => 'required|string|max:255',
                   'campus_id' => 'required|exists:campuses,id',
               ]);
       
               // Create the new teacher
               Teacher::create([
                   'first_name' => $request->first_name,
                   'last_name' => $request->last_name,
                   'date_of_birth' => $request->date_of_birth,
                   'gender' => $request->gender,
                   'phone_number' => $request->phone_number,
                   'email' => $request->email,
                   'address' => $request->address,
                   'employee_id' => $request->employee_id,
                   'hire_date' => $request->hire_date,
                   'subjects' => $request->subjects,
                   'qualification' => $request->qualification,
                   'experience' => $request->experience,
                   'campus_id' => $request->campus_id,
               ]);
       
               // Redirect to the index page with a success message
               return redirect()->route('teacher.index')->with('success', 'Teacher created successfully.');
       
           } catch (\Illuminate\Validation\ValidationException $e) {
               // Handle validation errors
               return redirect()->back()
                   ->withErrors($e->errors()) // Pass validation errors to the view
                   ->withInput(); // Retain input values
           }
       }
       
       // Show the form for editing the specified teacher
       public function edit($id)
       {
           // Find the teacher by ID
           $teacher = Teacher::findOrFail($id);
           $campuses = Campus::all(); 
           return view('teachers.edit', compact('teacher', 'campuses'));
       }
   
       // Update the specified teacher in storage
       public function update(Request $request, $id)
       {
           try {
               // Validate the request
               $request->validate([
                   'first_name' => 'required|string|max:255',
                   'last_name' => 'required|string|max:255',
                   'date_of_birth' => 'required|date',
                   'gender' => 'required|string|in:male,female,other',
                   'phone_number' => 'required|string|max:15',
                   'email' => 'required|email|unique:teachers,email,' . $id, // Ignore current teacher's email
                   'address' => 'required|string|max:255',
                   'employee_id' => 'required|string|unique:teachers,employee_id,' . $id, // Ignore current teacher's employee_id
                   'hire_date' => 'required|date',
                   'subjects' => 'required|string|max:255',
                   'qualification' => 'required|string|max:255',
                   'experience' => 'required|string|max:255',
                   'campus_id' => 'required|exists:campuses,id',
               ]);
       
               // Find the existing teacher
               $teacher = Teacher::findOrFail($id);
       
               // Update the teacher
               $teacher->update([
                   'first_name' => $request->first_name,
                   'last_name' => $request->last_name,
                   'date_of_birth' => $request->date_of_birth,
                   'gender' => $request->gender,
                   'phone_number' => $request->phone_number,
                   'email' => $request->email,
                   'address' => $request->address,
                   'employee_id' => $request->employee_id,
                   'hire_date' => $request->hire_date,
                   'subjects' => $request->subjects,
                   'qualification' => $request->qualification,
                   'experience' => $request->experience,
                   'campus_id' => $request->campus_id,
               ]);
       
               // Redirect to the index page with a success message
               return redirect()->route('teacher.index')->with('success', 'Teacher updated successfully.');
       
           } catch (\Illuminate\Validation\ValidationException $e) {
               // Handle validation errors
               return redirect()->back()
                   ->withErrors($e->errors()) // Pass validation errors to the view
                   ->withInput(); // Retain input values
           }
       }
       public function show(Teacher $teacher)
{
    // Pass the selected teacher to the 'show' view
    return view('teachers.show', compact('teacher'));
}

       // Remove the specified teacher from storage
       public function destroy($id)
       {
           // Find the teacher by ID
           $teacher = Teacher::findOrFail($id);
           $teacher->delete();
   
           return redirect()->route('teacher.index')->with('success', 'Teacher deleted successfully!');
       }
}
