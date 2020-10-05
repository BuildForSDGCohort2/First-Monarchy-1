<?php

namespace App\Http\Controllers\Auth;
use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;

class AdminRegisterController extends Controller
{
      use RegistersUsers;

      /**
       * Where to redirect users after registration.
       *
       * @var string
       */
      // protected $redirectTo = '/login/admins';

      /**
       * Create a new controller instance.
       *
       * @return void
       */
      public function __construct()
      {
          $this->middleware('guest:web');
          $this->middleware('guest:company');
          $this->middleware('guest:owner');
          $this->middleware('guest:agent');
          $this->middleware('auth:admin');
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
          	  'first_name' => ['required', 'string', 'max:255'],
              'last_name' => ['required', 'string', 'max:255'],
              'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
              'avatar' =>['sometimes','required','image','mimes:jpeg,jpg,png','max:2048'],
              'password' => ['required', 'string', 'min:8', 'confirmed'],
          ]);
      }

      /**
       * Create a new user instance after a valid registration.
       *
       * @param  array  $data
       * @return \App\Admin
       */
      protected function create(array $data)
      {
          return Admin::create([
              'first_name' => $data['first_name'],
              'last_name' => $data['last_name'],
              'email' => $data['email'],
              'avatar' => $data['avatar']->store('public/adminAvatars'),
              'password' => Hash::make($data['password']),
          ]);
      }
          public function showRegistrationForm()
          {
            return view('homepage');
          }
          public function register(Request $request)
          {
              $this->validator($request->all())->validate();

              event(new Registered($user = $this->create($request->all())));

              // $this->guard()->login($user);

              return $this->registered($request, $user)
                              ?: redirect($this->redirectPath());
          }
          protected function registered(Request $request, $user)
          {
            return $user;
          }
            protected function guard()
            {
              return Auth::guard('admin');
            }
}
