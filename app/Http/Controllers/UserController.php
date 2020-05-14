<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    public function show($id,Request $request)
    {
        $user = User::find($id);
        if($user == null)
        {
            return response()->json("the user doesn\'t exist.", 404);
        }
        else
        {
            return response()->json($user, 200);
        }
    }

    public function create(Request $request)
    {
        $this->validate($request, User::getRules());
        if(User::where('email', '=', $request->email)->first() == null)
        {
            $user = new User($request->all());
            $user->password = Hash::make($request->password, [
                'rounds' => 12
            ]);
            $user->save();
            return response()->json($user, 200);
        }
        else
        {
            return response()->json("The email has already been taken.",422);
        }
    }

    public function update($id, Request $request)
    {
        $user = User::find($id);
        if($user == null)
        {
            return response()->json("The user doesn\'t exist.",404);
        }
        else
        {
            $this->validate($request, User::getRules());
            if(User::where('email', '=', $request->email)->first() == null or $user->email == $request->email)
            {
                $user->fill($request->all());
                $user->save();
                return response()->json($user, 200);
            }
            else
            {
                return response()->json("The email has already been taken.",422);
            }
        }

    }
    public function delete($id)
    {
        $user = User::find($id);
        if($user == null)
        {
            return response()->json("the user doesn\'t exist.", 404);
        }
        else
        {
            $user->delete();
            return response()->json("The user is deleted", 200);
        }

    }
}
