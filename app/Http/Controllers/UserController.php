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

    public function show($id)
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
