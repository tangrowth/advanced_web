<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <title>COACHTECH</title>
</head>
<body>
  <div class="background">
    <div class="container">
      <div class="header">
        <div class="header_top">
          <h1>タスク検索</h1>
          <div class="header_right">
            <p>{{Auth::user()->name}}でログイン中</p>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="header_top_btn">ログアウト</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </div>
        <a href="/" class="search_btn">戻る</a>
      </div>

    <div class="todo">
      <form action="show" method="POST" class="header_form">
        @csrf
        <input type="text" name="input" value="{{$input}}" class="header_input">
        <select name="category" value="{{$category}}" class="tag_box">
          <option value="" selected></option>
          @foreach($tags as $tag)
            <option value="{{ $tag->id }}">{{ $tag->tag }}</option>
          @endforeach
        </select>
        <input type="submit" value="検索" class="header_btn">
      </form>
      @if (@isset($tasks))
      <table class="todolist">
        <tr>
          <th>作成日</th>
          <th>タスク名</th>
          <th>タグ</th>
          <th>更新</th>
          <th>削除</th>
        </tr>
        @foreach($tasks as $task)
        <tr>
          <form action="/edit/{{ $task->id }}" method="POST">
            @csrf
            <td>{{$task->created_at}}</td>
            <td><input type="text" name="task" value="{{$task->task}}" class="todo_form"></td>
            <td>  
              <select name="tag_id" value={{$task->tag_id}} class="tag_box">
                @foreach($tags as $tag)
                @if(old('tag_id',$task->tag_id) == $tag->id)
                  <option value="{{ $tag->id }}" selected>{{ $tag->tag }}</option>
                @else
                  <option value="{{ $tag->id }}">{{ $tag->tag }}</option>
                @endif
                @endforeach
              </select>
            </td>
            <td><button class="edit_btn">更新</button></td>
          </form>
          <td><form action="/delete/{{ $task->id }}" method="POST">@csrf<button class="delete_btn">削除</button></form></td>
        </tr>
        @endforeach
      </table>
      @endif
    </div>
  </div>
  </div>
</body>
</html>