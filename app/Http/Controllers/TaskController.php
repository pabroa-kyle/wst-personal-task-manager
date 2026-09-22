<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    public const STATUSES = ['Pending', 'In Progress', 'Completed'];
    public const PRIORITIES = ['Low', 'Medium', 'High'];

    public function index(Request $request): View
    {
        $sort = $request->query('sort', 'due_date');

        $tasks = match ($sort) {
            'task_name' => Task::orderBy('task_name', 'asc')->get(),
            'status' => Task::orderBy('status', 'asc')->orderBy('due_date', 'asc')->get(),
            'priority' => Task::orderByRaw("CASE priority WHEN 'High' THEN 1 WHEN 'Medium' THEN 2 WHEN 'Low' THEN 3 ELSE 4 END")
                ->orderBy('due_date', 'asc')
                ->get(),
            default => Task::orderBy('due_date', 'asc')->get(),
        };

        $pendingCount = $tasks->where('status', 'Pending')->count();
        $inProgressCount = $tasks->where('status', 'In Progress')->count();
        $completedCount = $tasks->where('status', 'Completed')->count();
        $overdueCount = $tasks
            ->where('status', '!=', 'Completed')
            ->filter(fn (Task $task) => $task->due_date && $task->due_date->lt(today()))
            ->count();

        return view('tasks.index', compact(
            'tasks',
            'pendingCount',
            'inProgressCount',
            'completedCount',
            'overdueCount',
            'sort'
        ));
    }

    public function dashboard(): View
    {
        $pendingCount = Task::where('status', 'Pending')->count();
        $inProgressCount = Task::where('status', 'In Progress')->count();
        $completedCount = Task::where('status', 'Completed')->count();
        $overdueCount = Task::where('status', '!=', 'Completed')
            ->whereNotNull('due_date')
            ->whereDate('due_date', '<', today())
            ->count();

        $overdueTasks = Task::where('status', '!=', 'Completed')
            ->whereNotNull('due_date')
            ->whereDate('due_date', '<', today())
            ->orderBy('due_date')
            ->take(5)
            ->get();

        $upcomingTasks = Task::where('status', '!=', 'Completed')
            ->whereNotNull('due_date')
            ->whereDate('due_date', '>=', today())
            ->orderBy('due_date')
            ->take(5)
            ->get();

        $recentlyCompleted = Task::where('status', 'Completed')
            ->latest('updated_at')
            ->take(5)
            ->get();

        return view('tasks.dashboard', compact(
            'pendingCount',
            'inProgressCount',
            'completedCount',
            'overdueCount',
            'overdueTasks',
            'upcomingTasks',
            'recentlyCompleted'
        ));
    }

    public function board(): View
    {
        $pendingTasks = Task::where('status', 'Pending')->orderBy('due_date')->get();
        $inProgressTasks = Task::where('status', 'In Progress')->orderBy('due_date')->get();
        $completedTasks = Task::where('status', 'Completed')->orderBy('due_date')->get();

        return view('tasks.board', compact('pendingTasks', 'inProgressTasks', 'completedTasks'));
    }

    public function create(): View
    {
        return view('tasks.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => ['required', Rule::in(self::STATUSES)],
            'priority' => ['required', Rule::in(self::PRIORITIES)],
            'due_date' => 'nullable|date',
        ]);

        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Task added successfully.');
    }

    public function edit(Task $task): View
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        $validated = $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => ['required', Rule::in(self::STATUSES)],
            'priority' => ['required', Rule::in(self::PRIORITIES)],
            'due_date' => 'nullable|date',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()->back()->with('success', 'Task deleted successfully.');
    }

    public function updateStatus(Request $request, Task $task): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(self::STATUSES)],
        ]);

        $task->status = $validated['status'];
        $task->save();

        return redirect()->back()->with('success', 'Task status updated successfully.');
    }
}
