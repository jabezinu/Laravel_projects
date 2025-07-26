<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return Task::orderBy('created_at','desc')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate(['title' => 'required|string']);
        return Task::create($data);
    }

    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'title' => 'sometimes|required|string',
            'completed' => 'sometimes|required|boolean',
        ]);
        $task->update($data);
        return $task;
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response(null, 204);
    }
}