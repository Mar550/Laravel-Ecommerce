<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    protected $redirectTo = 'login';
        
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'passwordconfirm' => ['required', 'string', 'min:8','same:password'],
            'avatar' => ['required','max:2048']
            ],
            
            [
            'firstname.required'=> 'Your First Name is Required',
            'firstname.string'=> 'Your First Name should contain just letters',
            'lastname.required'=> 'Your Last Name is Required',
            'lastname.string'=> 'Your Last Name should contain just letters',
            'username.required'=> 'A Username is Required',
            'username.string'=> 'A Username should contain just letters',
            'email.required'=> 'Your Email  is Required',
            'email.unique'=> 'This Email already exists',
            'password.required'=> 'The password is Required',
            'password.min'=> 'The password should contain at least 8 characters',
            'passwordconfirm.same'=> 'The two passwords should be identical',
            'avatar' => 'Please enter an image of less than 2048Mo'
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $image = $data['avatar'];
        $storage = $image->store('avatars');

        return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'passwordconfirm' => Hash::make($data['password']),
            'avatar' => $storage
        ]);
    }
}
