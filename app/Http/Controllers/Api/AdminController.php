<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Officer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;





class AdminController extends Controller
{ 
    public function getOfficers()
    {
        // Fetch only officers where is_officer is true
        $officers = User::where('is_officer', true)->get();

        return response()->json($officers);
    }

    public function addOfficer(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'email' => 'required|string|email|max:255|unique:users',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Set a default value for org_code
        $defaultOrgCode = '050603';
    
        // Handle file upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $originalName = $image->getClientOriginalName(); // Get the original filename
            $imageName = pathinfo($originalName, PATHINFO_FILENAME); // Use the original filename without extension
            $extension = $image->getClientOriginalExtension(); // Get the original file extension
    
            $imageName = $imageName . '_' . time() . '.' . $extension; // Combine with a timestamp to ensure uniqueness
    
            $image->storeAs('public/images', $imageName); // Save the image to the storage folder
        } else {
            $imageName = null; // No image uploaded
        }
    
        // Create a new user with is_officer set to true, is_admin set to false,
        // and org_code set to the default value
        $user = new User([
            'username' => $request->input('username'),
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
            'password' => bcrypt($request->input('password')),
            'email' => $request->input('email'),
            'is_officer' => true,
            'is_admin' => false,
            'org_code' => $defaultOrgCode,
            'image' => $imageName,
        ]);
    
        $user->save();
    
        return response()->json(['message' => 'Officer added successfully']);
    }





    public function updateOfficer(Request $request, $userID)
{
    // Find the officer by userID where is_officer is true
    $officer = User::where('is_officer', true)->findOrFail($userID);

    // Your validation and update logic here
    // For instance, updating specific officer details
    $officer->update([
        'username' => $request->input('username'),
        'fname' => $request->input('fname'),
        'lname' => $request->input('lname'),
        'email' => $request->input('email'),
        // Include other fields you want to update
    ]);

    return response()->json(['message' => 'Officer details updated successfully']);
}

    





public function deleteOfficer($userID)
{
    $officer = User::where('is_officer', true)->findOrFail($userID);

    // Delete officer's image if it exists
    if ($officer->image) {
        Storage::delete('public/images/' . $officer->image);
    }

    // Delete the officer's record from the database
    $officer->delete();

    return response()->json(['message' => 'Officer deleted successfully']);
}


    public function searchUser(Request $request, $username)
{
    try {
        $request->validate([
            'username' => 'required|string',
        ]);

        $username = $request->input('username');

        // Search for the user by username
        $user = User::where('username', $username)->first();

        if ($user) {
            return response()->json(['user' => $user]);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    } catch (ValidationException $e) {
        return response()->json(['message' => $e->errors()], 422);
    }
}
}
