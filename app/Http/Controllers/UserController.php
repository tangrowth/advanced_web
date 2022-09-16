<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  public function index(User $user){
    $user = User::find($user->id);
    $posts = Post::where('user_id', $user->id);
    $tags = Tag::all();
    return view('index', [
      'posts' => $posts,
      'tags' => $tags,
    ]);
  }
}
