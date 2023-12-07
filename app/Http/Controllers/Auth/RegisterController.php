<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Repository\UserRepository;
use App\Http\Requests\Auth\registerRequest;

class RegisterController extends Controller
{
    public function Register (RegisterRequest $registerRequest,UserRepository $userRepository){

        // check if user aleady exists
        $checkIfAccountExist = $userRepository->checkForAccount($registerRequest->email);

        if($checkIfAccountExist){
            return $message = ['message'=>'User already has an account'];
        }
        // create new user
        $storeUser = $userRepository->createUser($registerRequest);

        if($storeUser){
           $login =  Auth::attempt(['email' => $registerRequest->email, 'password' => $registerRequest->password]);

            //  if login was successful
           if($login){
               $token = auth()->user()->createToken('authentication',['view-post','read-post'])->accessToken;

               $message = ['message'=>'something went wrong, try again','status'=>200,'token'=>$token];
               return response()->json($token);
           }

        }

        $message = ['message'=>'something went wrong, try again'];

        return response()->json($message);
    }
}
