<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::all();

        return Inertia::render(
            'Todos/Index',
            [
                'todos' => $todos
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render(
            'Todos/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'todo' => 'required|string|max:255'
        ]);

        Todo::create([
            'todo' => $request->todo
        ]);
        sleep(1);

        return redirect()->route('todos.index')->with('message', 'To-do created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        return Inertia::render(
            'Todos/Edit',
            [
                'todos' => $todo
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'todo' => 'required|string|max:255'
        ]);

        $todo->todo = $request->todo;
        $todo->save();
        sleep(1);

        return redirect()->route('todos.index')->with('message', 'To-do Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        sleep(1);

        return redirect()->route('todos.index')->with('message', 'To-do Deleted Successfully');
    }
}
