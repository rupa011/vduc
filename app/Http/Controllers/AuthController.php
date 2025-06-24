<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Validation error',
                'errors'  => $validator->errors()
            ], 422);
        }

        // Fetch user
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Invalid email or password'
            ], 401);
        }

        if ($user->status !== 'Active') {
            return response()->json([
                'status'  => 'error',
                'message' => 'Your account is inactive. Please contact support.'
            ], 403);
        }

        Auth::login($user);

        return response()->json([
            'status'  => 'success',
            'message' => 'Login successful',
            'redirect' => route('dashboard')
        ]);
    }

    public function register(Request $request)
    {
        // Validate incoming data
        $validator = Validator::make($request->all(), [
            'first_name'      => 'required|string|max:255',
            'middle_name'     => 'nullable|string|max:255',
            'last_name'       => 'required|string|max:255',
            'extension_name'  => 'nullable|string|max:5',
            'email'           => 'required|email|unique:users,email',
            'password'        => 'required|string|min:6',
            'contact'         => 'required|string|unique:users,contact',
            'role'            => 'required|in:Student,Survey Client,Rental Client',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Validation failed.',
                'errors'  => $validator->errors()
            ], 422);
        }

        // Create user
        $user = User::create([
            'first_name'     => $request->first_name,
            'middle_name'    => $request->middle_name,
            'last_name'      => $request->last_name,
            'extension_name' => $request->extension_name,
            'email'          => $request->email,
            'password'       => Hash::make($request->password),
            'contact'        => $request->contact,
            'role'           => $request->role,
            'status'         => 'Active',
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Registration successful. Please log in.',
            'redirect' => route('signin')
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the session and regenerate the CSRF token for security
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('signin')->with('message', 'You have been logged out.');

        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'You have been logged out.',
        //     'redirect' => route('signin') // Replace with your actual login route
        // ]);
    }

    public function dashboard()
    {
        $user = Auth::user();

        switch ($user->role) {
            case 'Employee':
                return redirect()->route('employee.dashboard');
            case 'Survey Client':
                return redirect()->route('survey_client.dashboard');
            case 'Student':
                return redirect()->route('student.dashboard');
            case 'Rental Client':
                return redirect()->route('rental_client.dashboard');
            case 'Admin':
                return redirect()->route('admin.dashboard');
            case 'Super Admin':
                return redirect()->route('super_admin.dashboard');
            default:
                return redirect()->route('default.dashboard');
        }
    }
}
