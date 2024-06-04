<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;


class UserController extends Controller
{
    private $fillableAttributes = ['first_name', 'last_name', 'email', 'password', 'role', 'remember_token'];

    public function getUsers()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function createUser(Request $request)
    {
        $user = new User();
        foreach ($this->fillableAttributes as $attribute) {
            if ($attribute === 'password') {
                $user->$attribute = bcrypt($request->input($attribute));
            } else {
                $user->$attribute = $request->input($attribute);
            }
        }
        $user->save();

        return response()->json($user);
    }

    public function getUserById($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        foreach ($this->fillableAttributes as $attribute) {
            if ($request->has($attribute)) {
                if ($attribute === 'password') {
                    $user->$attribute = bcrypt($request->input($attribute));
                } else {
                    $user->$attribute = $request->input($attribute);
                }
            }
        }

        $user->save();

        return response()->json($user);
    }

    public function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
