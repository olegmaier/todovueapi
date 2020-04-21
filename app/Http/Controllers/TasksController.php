<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Http\Resources\Task as TaskResource;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tasks=Task::orderBy('id', 'desc')->paginate(5);

        return TaskResource::collection($tasks);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $task=$request->isMethod('PUT') ? Task::findOrFail($request->id):new Task;
        $task->id=$request->input('id');
        $task->title=$request->input('title');
        $task->description=$request->input('description');
        $task->user_id=$request->input('user_id');
        $task->task_done=$request->input('task_done');

        if($task->save())
        {return new TaskResource($task);}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $task=Task::findOrFail($id);
        return new TaskResource($task);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $task=Task::findOrFail($id);
        if($task->delete())
        {return new TaskResource($task);}
    }
}
