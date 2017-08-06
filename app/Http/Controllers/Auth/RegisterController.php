<?php

namespace App\Http\Controllers\Auth;

use App\Category;
use App\Subcategory;
Use Mail;
use App\User;
use App\Mail\verifyUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/';

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
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        Mail::to($user)->send(new verifyUser($user));

        session()->flash('message', 'Please check your email to confirm your account before logging in.');

        return redirect('/register');
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'budgetStartDay' => 'required|numeric|min:1|max:31',
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
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'budgetStartDay' => $data['budgetStartDay'],
        ]);
    }


    public function verifyEmail($verifyToken)
    {
        $user = User::where('verifiedToken', $verifyToken)->firstOrFail();

        $user->verifyAccount();

        Category::create([
            'user_id' => $user->id,
            'categoryName' => 'Unplanned',
        ]);

        Subcategory::create([
            'user_id' => $user->id,
            'category_id' => '1',
            'subcategoryName' => 'Unplanned',
            'subcategoryBudget' => null
        ]);

        session()->flash('message', 'Account verified, please login');

        return redirect('/login');
    }


}
