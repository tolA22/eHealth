<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Services\UserService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use App\Mail\RegistrationSuccessful;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected $UserService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $UserService)
    {
        $this->middleware('guest');
        $this->UserService = $UserService;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address' => ['required','string'],
            'dob'=>['required'],
            'phone'=>['required'],
            'role'=>['required','string']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $data["password"] = Hash::make($data['password']);
        $data["api_token"] = Str::random(60);
        $user =  $this->UserService->createModel($data);
        
        Mail::to($user->email)->send(new RegistrationSuccessful($user));
    
        return $user;
    }
}
