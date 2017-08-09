<?php

namespace App\Http\Controllers\Auth;

use App\Account;
use App\Category;
use App\Subcategory;
use App\User;
use App\Events\Users\UserRegistered;
use App\Events\Users\UserIsRegistered;
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

        event(new UserRegistered($user));

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

        $unplannedCategory = Category::create([
            'user_id' => $user->id,
            'categoryName' => 'Unplanned',
        ]);

        Subcategory::create([
            'user_id' => $user->id,
            'category_id' => $unplannedCategory->id,
            'subcategoryName' => 'Unplanned',
            'subcategoryBudget' => null
        ]);

        $exampleCategory = Category::create([
            'user_id' => $user->id,
            'categoryName' => 'Example Category',
        ]);

        Subcategory::create([
            'user_id' => $user->id,
            'category_id' => $exampleCategory->id,
            'subcategoryName' => 'Example Subcategory',
            'subcategoryBudget' => '100'
        ]);

        Account::create([
            'user_id' => $user->id,
            'accountName'=> 'Example Account',
            'accountDescription' => 'Example Description',
            'accountType' => 'Example Type',
            'openingBalance' => '0',
            'balance' => '0' // Read 'Receive Required Data' section.
        ]);

        event(new UserIsRegistered($user));

        session()->flash('message', 'Account verified, please login');

        return redirect('/login');
    }


}
