<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\CheckUpdate;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    function index() {

        $posts = Post::query()->where('user_id', Auth::id())->get();
        return view('admin.profile', ['posts' => $posts]);
    }

    function SendP(Request $request)
    {
        Post::query()->create([
            'user_id' => Auth::id(), 'title' => $request->title, 'content' => $request->input('content')
        ]);
        return redirect('posts');
    }

    function UpdateP(CheckUpdate $request)
    {
        $title = $request->title;
        $content = $request->input('content');
        Post::query()->where('id', $request->id)->update(['title' => $title, 'content' => $content]);
        return redirect('posts');
    }

    function DeleteP($id)
    {
        Post::query()->where('id', $id)->delete();
        return redirect('posts');
    }

    function EditP($id)
    {
        $Res = Post::query()->find($id);
        return view('admin.profile', ['edit' => $Res]);
    }
}
