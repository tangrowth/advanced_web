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

    public function show()
    {   $tags = Tag::all();
        return view('show', ['input' => '','category' => '','tags' => $tags]);
    }

    public function search(Request $request)
    {
        $tags = Tag::all();
        $tasks = Task::where('user_id', \Auth::user()->id)->where('task', 'LIKE BINARY',"%{$request->input}%")->where('tag_id', 'LIKE',"%{$request->category}%")->get();
        $param = [
            'input' => $request->input,
            'category' => $request->category,
            'tasks' => $tasks
        ];
        return view('show', $param,['tags' => $tags]);
    }

    public function login(){
        return view('welcome');
    }
}
