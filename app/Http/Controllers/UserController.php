<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\Playlist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        return UserResource::collection(User::all());
    }
    public function store(UserRequest $request)
    {
        try {
            $validated = $request->validated();
            $user = User::create($validated);
            return response()->json([
                'status' => 'Created',
                'user' => $user
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }
    public function authUser()
    {
        $user = Auth::user();
        return response()->json([
            'data' => [
                'firstName' => $user->first_name,
                'lastName' => $user->last_name,
                'email' => $user->email,
                'login' => $user->login,

            ]
        ], 200);
    }

}
