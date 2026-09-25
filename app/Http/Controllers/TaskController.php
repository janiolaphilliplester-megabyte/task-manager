<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $taskList = Task::latest()->get();
        $totalCount     = $taskList->count();
        $pendingCount   = $taskList->where('status', 'Pending')->count();
        $completedCount = $taskList->where('status', 'Completed')->count();

        return view('tasks.index', compact('taskList', 'totalCount', 'pendingCount', 'completedCount'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'task_name'   => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date'    => 'nullable|date',
        ]);

        Task::create([
            'task_name'   => $data['task_name'],
            'description' => $data['description'] ?? null,
            'status'      => 'Pending',
            'due_date'    => $data['due_date'] ?? null,
        ]);

        return redirect()->route('tasks.index')->with('toast', 'Task created successfully!');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'task_name'   => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date'    => 'nullable|date',
            'status'      => 'required|in:Pending,Completed',
        ]);

        $task->update($data);

        return redirect()->route('tasks.index')->with('toast', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('toast', 'Task deleted!');
    }

    public function updateStatus(Task $task)
    {
        $task->toggleStatus();
        return redirect()->route('tasks.index')->with('toast', 'Task status updated!');
    }
}