<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Repository\UserRepository;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    public function login (LoginRequest $loginRequest,UserRepository $userRepository){
        // $storeUser = $userRepository->createUser($loginRequest);

        $login =  Auth::attempt(['email' => $loginRequest->email, 'password' => $loginRequest->password]);

        // check if user login attempt was successfull
        if($login){

                // delete already existing token
                auth()->user()->tokens()->delete();

                // create new user token
               $token = auth()->user()->createToken('authentication',['view-post','read-post'])->accessToken;

               $message = ['message'=>'Login Successful, welcome','status'=>200,'token'=>$token];
               return response()->json([$message,$token]);

        }

        $message = ['message'=>'User not found'];

        return response()->json($message);
    }
}
