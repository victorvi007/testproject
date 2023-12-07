<?php
namespace App\Http\Repository;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository {
   private $model;
   public function __construct(User $model){
    $this->model = $model;
   }

   public function createUser($request){
        return $this->model->create([
            'firstname'=>$request->firstname,
            'lastname'=>$request->lastname,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
   }

   public function checkForAccount($email){
    return $this->model->where(['email'=>$email])->first();
   }
   public function getAllUsers(){
    return $this->model->get();
   }
} ;
