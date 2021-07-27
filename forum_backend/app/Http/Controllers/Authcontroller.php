<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class Authcontroller extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed|',
            'bio' => 'string',
            'type' => 'integer',
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'bio' => $fields['bio'],
            'type' => $fields['type'],
        ]);

        $token = $user->createToken('Falc0n')->plainTextToken;

        $response = [
            "User" => $user,
            'Token' => $token,
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
        // $fields = $request->validate([
        //     'email' => 'required|string',
        //     'password' => 'required|string',
        // ]);

        //TODO ckeck email :

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response(['error' => 'invalid Infos '], 401);
        }

        $token = $user->createToken('Falc0n')->plainTextToken;

        $response = [
            "User" => $user,
            'Token' => $token,
        ];

        return response($response, 201);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'logged out bro 🎃',
        ];
    }

    public function users(Request $request)
    {
        if ($request->user()->isAdmin()) {
            return User::all();
        } else {
            return [
                'error' => "you dont have permission to make this request",
            ];
        }
    }

    public function destroy($id)
    {
        return User::destroy($id);
    }

    public function user($id)
    {
        return User::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = User::find($id);
        $post->update($request->all());
    }

}
