<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CheckRequest;
use App\Models\User;
use http\Header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Post;



class TestApi extends Controller
{
    function Gdata()
    {
        $users = User::all();
        return response($users);
    }
    function Gposts()
    {
        $posts = Post::query()->where('user_id', Auth::id())->get();
        return response($posts);
    }
    function Cpost(Request $request)
    {
       /* try {
            $request->validate([
                'title' => 'required',
                'content' => 'required'
            ]);
        }
        catch (\Exception $exception)
        {
            return response($exception);
        }*/

        $request->validate([
            'title' => 'required',
            'content' => 'required'

        ]);

        Post::query()->create([
            'user_id' => Auth::id(), 'title' => $request->title, 'content' => $request->input('content')
        ]);

        return response(['message' =>  'user created successfully']);
    }
    function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:12'
        ]);
        try
        {
            User::query()->create([
                'name' => $request->name, 'email' => $request->email, 'password' =>  Hash::make($request->password)
            ]);
        }
        catch (\Exception $exception)
        {
            return response(['message' => $exception->getMessage()], $exception->status);
        }

        return response(['message' => 'user created successfully']);

    }
    function login(CheckRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $token = Hash::make($request->email);
            User::query()->where('email', $request->email)->update(['api_token' => $token]);
            //$request->session()->regenerate();
            return response(['message' => 'user login successfully','token'=> $token]);
        }
        return response(['message' => 'user login NOT successfully']);
    }
    function logout(Request $request)
    {
        try {
            //dd(\auth()->user());
            $logout = \auth()->user()->update(['api_token'=>'']);
            return response(['message' =>  $logout]);
        }
        catch (\Exception $exception)
        {
            return response(['message' => $exception->getMessage()], $exception->status);
        }
    }
}
