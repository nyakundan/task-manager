<?php 
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class taskController extends Controller
{
    // Fetch all tasks
    public function index()
    {
        return Task::all();
    }

    // Fetch a single task by ID
    public function show($id)
    {
        return Task::find($id);
    }

    // Create a new task
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'string|nullable',
            'completed' => 'boolean'
        ]);

        return Task::create($request->all());
    }

    // Update an existing task
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->update($request->all());
        return $task;
    }

    // Delete a task
    public function destroy($id)
    {
        Task::findOrFail($id)->delete();
        return response()->json(['message' => 'Task deleted successfully']);
    }
}