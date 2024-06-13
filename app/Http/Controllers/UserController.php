<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;


class UserController extends Controller
{
    private $fillableAttributes = ['first_name', 'last_name', 'email', 'password', 'role', 'remember_token'];

    public function getUsers($conference_id): JsonResponse
    {
        $users = User::whereHas('registration.talk.timeSlots.stage.conferences', function ($query) use ($conference_id) {
            $query->where('conference_id', $conference_id);
        })->get();

        return response()->json($users);
    }

    public function createUser(Request $request): JsonResponse
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

    public function getUserById($id): JsonResponse
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    public function updateUser(Request $request, $id): JsonResponse
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

    public function deleteUser($id): JsonResponse
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
