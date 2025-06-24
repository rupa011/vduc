<?php

namespace App\Http\Controllers;

use App\Models\DivingApplication;
use App\Models\DivingLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DivingApplicationController extends Controller
{
    public function index()
    {
        try {
            $applications = DivingApplication::all();
            return $this->success($applications, 'Diving applications retrieved successfully');
        } catch (\Exception $e) {
            Log::error('Failed to fetch diving applications: ' . $e->getMessage());
            return $this->failed(null, 'Failed to fetch diving applications', 500);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'       => 'required|exists:users,id',
            'lesson_id'     => 'required|exists:diving_lessons,id',
            'schedule_date' => 'nullable|date',
            'schedule_time' => 'nullable|date_format:H:i',
        ]);

        // Check if the user has already applied for the lesson
        $existingApplication = DivingApplication::where('user_id', $validated['user_id'])
            ->where('lesson_id', $validated['lesson_id'])
            ->first();

        if ($existingApplication) {
            return $this->failed(null, 'Student has already applied for this lesson', 422);
        }

        // Fetch the lesson to check for prerequisite
        $lesson = DivingLesson::find($validated['lesson_id']);

        if ($lesson && $lesson->prerequisite) {
            // Check if user has completed the prerequisite lesson
            $prerequisiteCompleted = DivingApplication::where('user_id', $validated['user_id'])
                ->where('lesson_id', $lesson->prerequisite)
                ->where('status', 'Completed') // Only completed lessons count
                ->exists();

            if (!$prerequisiteCompleted) {
                return $this->failed(null, 'Cannot apply for this lesson. Prerequisite lesson has not been completed.', 422);
            }
        }

        try {
            $application = DivingApplication::create($validated);
            return $this->success($application, 'Diving application created successfully', 201);
        } catch (\Exception $e) {
            Log::error('Failed to create diving application: ' . $e->getMessage());
            return $this->failed(null, 'Failed to create diving application', 500);
        }
    }

    public function show($id)
    {
        try {
            $application = DivingApplication::findOrFail($id);
            return $this->success($application, 'Diving application retrieved successfully');
        } catch (\Exception $e) {
            Log::error("Failed to retrieve diving application ID {$id}: " . $e->getMessage());
            return $this->failed(null, 'Diving application not found', 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $application = DivingApplication::findOrFail($id);

            $validated = $request->validate([
                'user_id'       => 'sometimes|required|exists:users,id',
                'lesson_id'     => 'sometimes|required|exists:diving_lessons,id',
                'schedule_date' => 'nullable|date',
                'schedule_time' => 'nullable|date_format:H:i',
            ]);

            // Determine what values to use: new validated values or existing ones
            $userId = $validated['user_id'] ?? $application->user_id;
            $lessonId = $validated['lesson_id'] ?? $application->lesson_id;

            // If lesson_id is changing OR user_id is changing, check prerequisite
            $lesson = DivingLesson::find($lessonId);

            if ($lesson && $lesson->prerequisite) {
                $prerequisiteCompleted = DivingApplication::where('user_id', $userId)
                    ->where('lesson_id', $lesson->prerequisite)
                    ->where('status', 'Completed')
                    ->exists();

                if (!$prerequisiteCompleted) {
                    return $this->failed(null, 'Cannot update application. Prerequisite lesson has not been completed.', 422);
                }
            }

            $application->update($validated);
            return $this->success($application, 'Diving application updated successfully');
        } catch (\Exception $e) {
            Log::error("Failed to update diving application ID {$id}: " . $e->getMessage());
            return $this->failed(null, 'Failed to update diving application', 500);
        }
    }

    public function destroy($id)
    {
        try {
            $application = DivingApplication::findOrFail($id);
            $application->delete();
            return $this->success(null, 'Diving application deleted successfully');
        } catch (\Exception $e) {
            Log::error("Failed to delete diving application ID {$id}: " . $e->getMessage());
            return $this->failed(null, 'Failed to delete diving application', 500);
        }
    }
}
