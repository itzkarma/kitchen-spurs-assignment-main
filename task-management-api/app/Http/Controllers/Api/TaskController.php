<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use \Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    // public function test(Request $request)
    // {
    //     $user = $request->user();
    //     return response()->json([$user]);
    // }

    public function index(Request $request)
    {
        try {
            $tasks = Task::query();

            if ($request->has('status')) {
                $tasks->where('status', $request->status);
            }

            if ($request->has('due_date')) {
                $tasks->whereDate('due_date', $request->due_date);
            }

            if ($request->has('user_id')) {
                $tasks->whereHas('users', function ($query) use ($request) {
                    $query->where('user_id', $request->user_id);
                });
            }

            $tasks = $tasks->with('users')->get();

            return response()->json([
                'status' => true,
                'data' => $tasks
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $input = $request->all();

            $validator = Validator::make($input, [
                'title' => 'required',
                'description' => 'required',
                'due_date' => 'required|date',
                'status' => 'required|in:pending,in_progress,completed',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "message" => "Validation Error",
                    "data" => $validator->errors()
                ]);
            }

            $task = Task::create($input);

            return response()->json([
                "status" => true,
                "message" => "Task created successfully.",
                "data" => $task
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, Task $task)
    {
        try {
            $input = $request->all();

            $validator = Validator::make($input, [
                'title' => 'required',
                'description' => 'required',
                'due_date' => 'required|date',
                'status' => 'required|in:pending,in_progress,completed',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "message" => "Validation Error",
                    "data" => $validator->errors()
                ]);
            }

            $task->update($input);

            return response()->json([
                "status" => true,
                "message" => "Task updated successfully.",
                "data" => $task
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function destroy(Task $task)
    {
        try {
            $task->delete();

            return response()->json([
                "status" => true,
                "message" => "Task deleted successfully."
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function assignUsers(Request $request, Task $task)
    {
        try {
            $task->users()->attach($request->user_ids, ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);

            return response()->json([
                "status" => true,
                "message" => "Users assigned to task successfully."
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function unassignUser(Request $request, Task $task)
    {
        try {
            $task->users()->detach($request->user_id);

            return response()->json([
                "status" => true,
                "message" => "User unassigned from task successfully."
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function changeStatus(Request $request, Task $task)
    {
        try {
            $input = $request->all();

            $validator = Validator::make($input, [
                'status' => 'required|in:pending,in_progress,completed',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "message" => "Validation Error",
                    "data" => $validator->errors()
                ]);
            }

            $task->update(['status' => $input['status']]);

            return response()->json([
                "status" => true,
                "message" => "Task status updated successfully.",
                "data" => $task
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function tasksAssignedToCurrentUser(Request $request)
    {
        try {
            $user = $request->user();

            $tasks = $user->tasks()->with('users')->get();

            return response()->json([
                "status" => true,
                "message" => "Tasks assigned to current user retrieved successfully.",
                "data" => $tasks
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function tasksAssignedToUser($userId)
    {
        try {
            $user = User::find($userId);

            if (is_null($user)) {
                return response()->json([
                    "status" => false,
                    "message" => "User not found",
                    "data" => []
                ]);
            }

            $tasks = $user->tasks()->get();

            return response()->json([
                "status" => true,
                "message" => "Tasks assigned to user retrieved successfully.",
                "data" => $tasks
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
