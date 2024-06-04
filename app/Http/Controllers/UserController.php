<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {

        return response()->json([
            'status' => true,
            'data'=>UserResource::collection(User::all())
        ]);
    }
    public function auth(){
        return response()->json([
            'isAuth' => Auth::user()
        ]);
    }
    public function store(UserRequest $request)
    {
        try {
            $validated = $request->validated();
            $user = User::create($validated);
            return response()->json([
                'status' => true,
                'user' => $user
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 400);
        }
    }

    public function show(User $user)
    {
        $findUser = new UserResource($user);

        return response()->json([
            'status' => true,
            'data'=>$findUser
        ]);
    }

    public function update(Request $request,string $user )
    {
        $file = null;
        dd($request->all());
        if($request->profile_pic){
            $path = $request->file('profile_pic');
            $name = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $path->storeAs('profile_pictures', $name.'.'.$extension);
            $file = $path;
        }
        $user->update(array_merge($request->all(),$file));

        return response()->json([
            'status' => true,
            'message' => 'user successfully updated',
            'data'=>$user
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'status' => true,
            'message' => 'user successfully deleted'
        ]);
    }
    public function searchUsers(string $request){
        $searchTerm = $request;

        $users = User::where(function ($query) use ($searchTerm) {
            $query->where('login', 'like', '%' . $searchTerm . '%')
                ->orWhere('first_name', 'like', '%' . $searchTerm . '%')
                ->orWhere('last_name', 'like', '%' . $searchTerm . '%');
        })
            ->where('id', '!=', Auth::id()) // Исключаем текущего пользователя
            ->take(5) // Получаем не более 5 результатов
            ->get();
        if($users){
            return UserResource::collection($users);

        }else{
            return response()->json([
                'status' =>false,
                'message' =>'Никого не нашли'
            ]);
        }
    }
    public function authUser()
    {
            $user = Auth::user();
            if($user) return response()->json([
                                     'status' =>true,
                                     'data' => [
                                         'firstName' => $user->first_name,
                                         'lastName' => $user->last_name,
                                         'email' => $user->email,
                                         'login' => $user->login,
                                     ]
                                 ]);
           else return response()->json([
                'status' => false,
                'message' => 'Вы не авторизованы'
            ],400);

    }

    public function login(Request $request, User $user)
    {
        try {
            $validateUser = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required'
            ]);
            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 400);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],400);
        }
        if (Auth::attempt($request->only(['email', 'password']))) {
            Auth::user()->tokens()->delete();
            $token = Auth::user()->createToken('api')->plainTextToken;
            Auth::user()->token = $token;
            return response()->json([
                'status' => true,
                'user' => Auth::user(),
                'message' => 'User Logged in successfully',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Hey buddy, i think you got the wrong door the leather club is 2 blocks down'
            ],400);
        }
    }

}
