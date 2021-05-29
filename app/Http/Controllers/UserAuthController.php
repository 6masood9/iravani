<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\CheckUpdate;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Models\User;
use App\Http\Requests\Auth\CheckRequest;


class UserAuthController extends Controller
{
    function login()
    {
        return view('auth.login');
    }

    function register()
    {
        return View('auth.register');
    }

    function create(Request $request)
    {
        //return $request->input();

        // validate requests
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:12'
        ]);

        // if form validated success

        /*$data = $request->all();
        $check = $this->create("$data");

        return redirect("login")->with('You have signed-in');*/

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $query = $user->save();

        if ($query) {
            return back()->with('success', 'You have been successfuly registered');
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }

    function check(CheckRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/posts');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    function profile()
    {

//        $check = Post::query()->where('user_id',Auth::id())->find(1);
//        return $check;

        /*$posts = Post::query()->where('user_id', Auth::id())->get();
        return view('admin.profile', ['posts' => $posts]);*/
    }

    function logout()
    {
        Auth::logout();
        return redirect('login');
    }

}
