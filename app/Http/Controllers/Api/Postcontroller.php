<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Postcontroller extends Controller
{
    //For get all posts
    function getAllPosts()
    {
        $posts = Post::query()->where('user_id', Auth::id())->get();
        return response($posts);
    }
    //For create new post
    function createNewPost(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'content' => 'required'

        ]);
        try {
            Post::query()->create([
                'user_id' => Auth::id(), 'title' => $request->title, 'content' => $request->input('content')
            ]);
            return response(['message' =>  'post created successfully']);
        }
        catch (\Exception $exception)
        {
            return response(['message' => $exception->getMessage()], $exception->status);
        }
    }
    function deletePost()
    {

    }
}
