<?php

namespace App\Http\Controllers;

use App\Models\task;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : view
    {   $tasks = task::latest()->get();
        return view('index',['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : view
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {

        $request->validate(([
            'title' => 'required',
            'description' => 'required'
        ]));

        task::create($request->all());
        return redirect()->route('tasks.index')->with('succes','Tarea guardada   exitosamente');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(task $task) : view
    {
        $selectedTask = $task;
        return view('edit',['task' => $selectedTask]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, task $task) : RedirectResponse
    {
        $request->validate(([
            'title' => 'required',
            'description' => 'required'
        ]));

        $task -> update($request -> all());
        return redirect()->route('tasks.index')->with('succes','Tarea actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(task $task) : RedirectResponse
    {
        $task -> delete();
        return redirect()->route('tasks.index')->with('succes','Tarea eliminada exitosamente');
    }
}
