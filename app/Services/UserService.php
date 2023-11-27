<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Services\ImportInterface;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class UserService extends BaseService 
{
    //protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

  
 public function login($credentials)
 {
   if( \Auth::attempt($credentials));
     {
        $user = $this->repository->getModel()->where("email",$credentials['email'])->first();

            $token = $user->createToken('Elraya')->accessToken;
            return [true ,trans('messages.success'), ['token' => $token ,'user'=> $user], 200];
        
     }

     return [false ,"user not found", null, 404];

 }



}
