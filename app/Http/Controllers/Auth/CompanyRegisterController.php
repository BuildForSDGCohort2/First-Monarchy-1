<?php

namespace App\Http\Controllers\Auth;

use App\Tag;
use App\Category;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class CompanyRegisterController extends Controller
{
      use RegistersUsers;

      /**
       * Where to redirect users after registration.
       *
       * @var string
       */
      protected $redirectTo = '/login/companies';

      /**
       * Create a new controller instance.
       *
       * @return void
       */
      public function __construct()
      {
          $this->middleware('guest:company')->except('logout');
      }

      /**
       * Get a validator for an incoming registration request.
       *
       * @param  array  $data
       * @return \Illuminate\Contracts\Validation\Validator
       */
      protected function validator(array $data)
      {
        $ids = Category::all()->pluck('id')->implode(',');
          return Validator::make($data, [
          	  'name' => ['required', 'string','min:0', 'max:255'],
              'bio' => ['required', 'string', 'max:255'],
              'logo' =>['required','image','mimes:jpeg,jpg,png','max:2048'],
              'phone' =>['required','string','min:0','max:10'],
              'address' =>['required','string','min:0'],
              'category' =>['required','array'],
              'category.*' => ['integer',"in:$ids"],
              'email' => ['required', 'string', 'email', 'max:255', 'unique:companies'],
              'password' => ['required', 'string', 'min:8', 'confirmed'],
          ]);
      }

      /**
       * Create a new user instance after a valid registration.
       *
       * @param  array  $data
       * @return \App\Company
       */
      protected function create(array $data)
      {
          $company = Company::create([
              'name' => $data['name'],
              'bio' => $data['bio'],
              'logo' => $data['logo']->store('public/companyLogos'),
              'phone' => $data['phone'],
              'address' => $data['address'],
              'email' => $data['email'],
              'password' => Hash::make($data['password']),
          ]);
          $category = Category::find($data['category']);
          foreach ($category as $categ) {
              $categ->companies()->attach($company);
          }
          Tag::create([
            'name' => $data['name'],
            'origin' =>'company',
        ]);
          return $company;
      }
          public function showRegistrationForm()
          {
            return view('companyRegister');
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
              return Auth::guard('company');
            }
}
