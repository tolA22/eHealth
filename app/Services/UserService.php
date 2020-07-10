<?php

namespace App\Services;

use App\Repositories\User\UserRepository;


class UserService{

    protected $UserRepository;

    public function __construct(UserRepository $UserRepository){
        $this->UserRepository = $UserRepository;
    }

    public function createModel(array $param){
        $user = $this->UserRepository->create($param);
        if(strtolower($param['role'])=="doctor"){
            $user->assignRole('doctor');
        }else{
            $user->assignRole('patient');
        }
        return $user;
    }


    public function roles($role){
        return $this->UserRepository->roles($role);
    }

}