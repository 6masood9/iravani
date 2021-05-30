<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CheckRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //For get all users
    function getAllUsers()
    {
        try {
            $users = User::all();
            return response($users);
        }
        catch (\Exception $exception)
        {
            return response(['message' => $exception->getMessage()], $exception->status);
        }

    }
    //For create new user
    function createNewUser(Request $request)
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
            return response(['message' => 'user created successfully']);
        }
        catch (\Exception $exception)
        {
            return response(['message' => $exception->getMessage()]);
        }
    }
    //For login users
    function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:12'
        ]);
        try
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
        catch (\Exception $exception)
        {
            return response(['message' => $exception->getMessage()], $exception->status);
        }
    }
    //For logout users
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
