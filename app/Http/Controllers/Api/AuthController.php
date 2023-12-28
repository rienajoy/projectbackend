<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('registration');
    }


    public function register(Request $request)
{
   // Validate the request
   $request->validate([
    'username' => 'required|string|unique:users',
    'fname' => 'required|string',
    'lname' => 'required|string',
    'password' => 'required|min:8', 
    'email' => 'required|email|unique:users',
    'is_admin' => 'boolean',
    'org_code' => 'required|in:050603'
], [
    'org_code.in' => 'The code is incorrect.Provide the correct organization code.',
]);

    

    // Check organization code for non-admin users
    if (!$request->input('is_admin') && $request->input('org_code') !== '050603') {
        return redirect()->back()->withInput()->withErrors(['org_code' => 'Provide the correct organization code.']);
    }

    // Create a new user with hashed password and org_code (if not admin)
    $isAdmin = $request->has('is_admin') && $request->input('is_admin') == '1';
    $user = User::create([
        'username' => $request->input('username'),
        'fname' => $request->input('fname'),
        'lname' => $request->input('lname'),
        'password' => bcrypt($request->input('password')), // Hash the password
        'email' => $request->input('email'),
        'is_admin' => $isAdmin,
        'org_code' => $isAdmin ? null : $request->input('org_code'), // Set org_code to null if admin
    ]);

    // Return the details of the registered user
    return response()->json([
        'message' => 'Registered successfully!',
        'user' => $user,
    ]);}

    

    //LOGIN
    public function showLoginForm()
    {
        return view('login');
    }


    //LOGIN
    public function OfficerDashboard()
    {
        return view('officer (1)/OfficerDashboard');
    }

    public function AdminDashboard()
    {
        return view('admin/dashboard');
    }

    public function login(Request $request)
    {
        // Validate the login form data
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    
        // Attempt to log in the user
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            $user = auth()->user();
    
            // Respond with user data including the userID
            return response()->json([
                'message' => 'Login successful!',
                'role' => $user->is_admin ? 'admin' : ($user->is_officer ? 'officer' : 'regular'),
                'userID' => $user->userID // Assuming this is the correct attribute for the userID
            ]);
        }
    
        // Handle failed login attempt
        return response()->json(['error' => 'Invalid credentials'], 401);
    }
    



    // Add a logout method if needed
    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Logged  out successfully!']);
    }


}
