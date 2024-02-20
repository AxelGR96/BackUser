<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Tymon\JWTAuth\Facades\JWTAuth;

class admin extends Controller
{
    public function sendMessage(){
        return 'Conexion exitosa';
    }

    public function createUser(Request $request){
        //Crear usuario usando eloquent en la tabla de user
        $newUser = new User();
        $newUser->name = $request->userData['name'];
        $newUser->lastname = $request->userData['lastname'];
        $newUser->email = $request->userData['email'];
        $newUser->gender = $request->userData['gender'];
        $newUser->age = $request->userData['age'];
        $newUser->password = $request->userData['password'];
        $newUser->save();
    }

    public function getUsers(){
        $users = User::select('id', 'name', 'lastname', 'email', 'gender', 'age', 'password')->get();
        return response()->json([
            'status' => true,
            'users' => $users
        ], 200);
    }

    public function editUser(Request $request){
        $user = $request->userModified;
        $userToEdit = User::where('id',$user['id'])->first();
        $userToEdit->name = $user['name'];
        $userToEdit->lastname = $user['lastname'];
        $userToEdit->email = $user['email'];
        $userToEdit->gender = $user['gender'];
        $userToEdit->age = $user['age'];
        $userToEdit->password = Hash::make($user['password']);
        $userToEdit->save();
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = JWTAuth::fromUser($user);

            return response()->json([
                'token' => $token,
                'user' => $user
            ]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function delete(Request $request){
        $user = $request->userDelete;
        $usertoDelete = User::where('id',$user['id'])->first();
        $usertoDelete->delete();
    }

    public function logout(){
        Auth::logout();
        return response()->json(['message' => 'Logout exitoso']);
    }
}
