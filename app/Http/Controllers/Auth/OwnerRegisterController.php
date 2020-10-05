<?php

namespace App\Http\Controllers\Auth;
use App\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;

class OwnerRegisterController extends Controller
{
      use RegistersUsers;

      /**
       * Where to redirect users after registration.
       *
       * @var string
       */
      protected $redirectTo = '/login/owners';

      /**
       * Create a new controller instance.
       *
       * @return void
       */
      public function __construct()
      {
          // $this->middleware('guest');
          // $this->middleware('guest:company');
          //$this->middleware('guest:admin');
          //$this->middleware('guest:owner');
          // $this->middleware('auth:admin');
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
              'bio' => ['required', 'string', 'max:255'],
              'email' => ['required', 'string', 'email', 'max:255', 'unique:owners'],
              'country_code' => ['required', 'string' ,'min:4','max:4'],
              'phone_number' => ['required', 'string' ,'min:10', 'max:10'],
              'logo' =>['nullable','required','image','mimes:jpeg,jpg,png','max:2048'],
              'password' => ['required', 'string', 'min:8', 'confirmed'],
          ]);
      }

      /**
       * Create a new user instance after a valid registration.
       *
       * @param  array  $data
       * @return \App\Owner
       */
      protected function create(array $data)
      {
          return Owner::create([
              'name' => $data['name'],
              'bio' => $data['bio'],
              'email' => $data['email'],
              'country_code' => $data['country_code'],
              'phone_number' => $data['phone_number'],
              'logo' => $data['logo']->store('public/ownerLogos'),
              'password' => Hash::make($data['password']),
          ]);
      }
          public function showRegistrationForm()
          {
              // dd(\Auth::guard('admin')->id());
            return view('properties.ownerRegister');
          }
          public function register(Request $request)
          {
              $this->validator($request->all())->validate();

              event(new Registered($user = $this->create($request->all())));

              // $this->guard()->login($user);

              return $this->registered($request, $user)
                              ?: redirect($this->redirectPath());
          }
            protected function guard()
            {
              return Auth::guard('owner');
            }
}
