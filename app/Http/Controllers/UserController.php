<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Services\UserService;
use App\Traits\ResponseTrait;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;



class UserController extends Controller
{
    use ResponseTrait;

    protected $UserService;

    public function __construct(UserService $UserService){
        // testing
        $this->UserService = $UserService;
    }

    public function login(LoginRequest $request){
        if(Auth::attempt(['email'=>$request["email"],'password'=>$request["password"]])){
            return $this->success("Login Successful",new UserResource(Auth::user()),$this->code200);
            
        }
        return $this->error("Invalid credentials",$this->code422);
    
    }

    public function logout(){
        return Auth::logout();
    }

    public function register(RegisterRequest $request){
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $data['api_token'] =  Str::random(60);
        $user =  $this->UserService->createModel($data);
        Auth::attempt(['email'=>$request["email"],'password'=>$request["password"]]);
        return $this->success("Registration Successful",new UserResource($user),$this->code201);
    }
}
