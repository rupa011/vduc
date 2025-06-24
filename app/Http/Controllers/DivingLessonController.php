<?php

namespace App\Http\Controllers;

use App\Models\DivingLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DivingLessonController extends Controller
{
    public function index()
    {
        try {
            $divingLessons = DivingLesson::all();
            return $this->success($divingLessons, 'Diving lessons retrieved successfully');
        } catch (\Exception $e) {
            Log::error('Failed to fetch diving lessons: ' . $e->getMessage());
            return $this->failed(null, 'Failed to fetch diving lessons', 500);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'lesson_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'duration_minutes'    => 'required|integer|min:1',
            'price' => 'required|decimal:2|min:1',
            'prerequisite' => 'nullable|exists:diving_lessons,id', // Ensure prerequisite exists in the diving_lessons table
        ]);

        try {
            $divingLesson = DivingLesson::create($validated);
            return $this->success($divingLesson, 'Diving lesson created successfully', 201);
        } catch (\Exception $e) {
            Log::error('Failed to create diving lesson: ' . $e->getMessage());
            return $this->failed(null, 'Failed to create diving lesson', 500);
        }
    }

    public function show($id)
    {
        try {
            $divingLesson = DivingLesson::findOrFail($id);
            return $this->success($divingLesson, 'Diving lesson retrieved successfully');
        } catch (\Exception $e) {
            Log::error("Failed to retrieve diving lesson ID {$id}: " . $e->getMessage());
            return $this->failed(null, 'Diving lesson not found', 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $divingLesson = DivingLesson::findOrFail($id);

            $validated = $request->validate([
                'lesson_name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'duration_minutes' => 'required|integer|min:1',
                'price' => 'required|decimal:2|min:1',
                'prerequisite' => 'nullable|exists:diving_lessons,id',
            ]);

            // Prevent self-reference
            if (isset($validated['prerequisite']) && $validated['prerequisite'] == $id) {
                return $this->failed(null, 'A lesson cannot be its own prerequisite.', 422);
            }

            // Prevent circular dependency
            if (isset($validated['prerequisite'])) {
                $prerequisiteId = $validated['prerequisite'];
                if ($this->isCircularPrerequisite($id, $prerequisiteId)) {
                    return $this->failed(null, 'Circular prerequisite detected.', 422);
                }
            }

            $divingLesson->update($validated);
            return $this->success($divingLesson, 'Diving lesson updated successfully');
        } catch (\Exception $e) {
            Log::error("Failed to update diving lesson ID {$id}: " . $e->getMessage());
            return $this->failed(null, 'Failed to update diving lesson', 500);
        }
    }

    /**
     * Check for circular prerequisite dependency.
     *
     * @param int $lessonId        The ID of the lesson being updated.
     * @param int $prerequisiteId  The ID of the new prerequisite.
     * @return bool
     */
    private function isCircularPrerequisite($lessonId, $prerequisiteId)
    {
        // Traverse up the prerequisite chain to detect cycles
        while ($prerequisiteId !== null) {
            if ($prerequisiteId == $lessonId) {
                // Found a circular reference
                return true;
            }
            $nextLesson = DivingLesson::find($prerequisiteId);
            if (!$nextLesson) {
                break; // Reached a lesson without a prerequisite
            }
            $prerequisiteId = $nextLesson->prerequisite; // Move up the chain
        }
        return false; // No circular dependency found
    }

    public function destroy($id)
    {
        try {
            $divingLesson = DivingLesson::findOrFail($id);
            $divingLesson->delete();
            return $this->success(null, 'Diving lesson deleted successfully');
        } catch (\Exception $e) {
            Log::error("Failed to delete diving lesson ID {$id}: " . $e->getMessage());
            return $this->failed(null, 'Failed to delete diving lesson', 500);
        }
    }
}
