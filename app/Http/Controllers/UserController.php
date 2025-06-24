<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        try {
            $users = User::all();
            return $this->success($users, 'Users retrieved successfully');
        } catch (\Exception $e) {
            Log::error('Failed to fetch users: ' . $e->getMessage());
            return $this->failed(null, 'Failed to fetch users', 500);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'     => 'required|string|max:255',
            'middle_name'    => 'nullable|string|max:255',
            'last_name'      => 'required|string|max:255',
            'extension_name' => 'nullable|string|max:5',
            'email'          => 'required|email|unique:users,email',
            'password'       => 'required|string|min:6',
            'contact'        => 'required|string|unique:users,contact',
            'role'           => ['required', Rule::in(['Employee', 'Survey Client', 'Student', 'Rental Client', 'Admin', 'Super Admin'])],
            'status'         => ['nullable', Rule::in(['Active', 'Inactive'])],
        ]);

        try {
            $validated['password'] = Hash::make($validated['password']);
            $user = User::create($validated);
            return $this->success($user, 'User created successfully', 201);
        } catch (\Exception $e) {
            Log::error('Failed to create user: ' . $e->getMessage());
            return $this->failed(null, 'Failed to create user', 500);
        }
    }

    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            return $this->success($user, 'User retrieved successfully');
        } catch (\Exception $e) {
            Log::error("Failed to retrieve user ID {$id}: " . $e->getMessage());
            return $this->failed(null, 'User not found', 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $validated = $request->validate([
                'first_name'     => 'sometimes|required|string|max:255',
                'middle_name'    => 'nullable|string|max:255',
                'last_name'      => 'sometimes|required|string|max:255',
                'extension_name' => 'nullable|string|max:5',
                'email'          => ['sometimes', 'required', 'email', Rule::unique('users')->ignore($user->id)],
                'password'       => 'nullable|string|min:6',
                'contact'        => ['sometimes', 'required', Rule::unique('users')->ignore($user->id)],
                'role'           => ['sometimes', 'required', Rule::in(['Employee', 'Survey Client', 'Student', 'Rental Client', 'Admin', 'Super Admin'])],
                'status'         => ['nullable', Rule::in(['Active', 'Inactive'])],
            ]);

            if (!empty($validated['password'])) {
                $validated['password'] = Hash::make($validated['password']);
            } else {
                unset($validated['password']);
            }

            $user->update($validated);
            return $this->success($user, 'User updated successfully');
        } catch (\Exception $e) {
            Log::error("Failed to update user ID {$id}: " . $e->getMessage());
            return $this->failed(null, 'Failed to update user', 500);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return $this->success(null, 'User deleted successfully');
        } catch (\Exception $e) {
            Log::error("Failed to delete user ID {$id}: " . $e->getMessage());
            return $this->failed(null, 'Failed to delete user', 500);
        }
    }
}
