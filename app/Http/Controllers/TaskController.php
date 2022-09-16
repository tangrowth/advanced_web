<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    public function index(){
        $tasks = Task::where('user_id', \Auth::user()->id)->get();
        $tags = Tag::all();
        return view('index', ['tasks' => $tasks, 'tags' => $tags]);
    }

    public function post(TaskRequest $request, Task $task){
        $task->user_id = Auth::id();
        $form = $request->all();
        $form['user_id'] = Auth::id();
        Task::create($form);
        return redirect ('/');
    }

    public function edit(TaskRequest $request){
        $form = $request->all();
        unset($form['_token']);
        Task::where('id', $request->id)->update($form);
        return redirect('/');
    }

    public function delete(Request $request)
    {
        Task::find($request->id)->delete();
        return redirect('/');
    }

    public function show(){
        return view('show');
    }

    public function login(){
        return view('welcome');
    }
}
