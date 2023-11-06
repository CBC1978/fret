<?php
namespace App\Http\Controllers\Auth;

use App\Mail\Email\RegisterEmail;
use App\Mail\Email\RegisterEmails;
use App\Providers\Helper;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }


    public function register( Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'first_name' => ['required', 'string', 'max:255'],
                'user_phone' => ['required', 'string', 'max:20'],
                'username' => ['required', 'string', 'max:255', 'unique:users'],
                'email' => ['required', 'string', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'role' => ['required', 'string', 'in:chargeur,transporteur'],
            ]
        );
        $user = new User();
        $user->name = $request->name;
        $user->first_name = $request->first_name;
        $user->user_phone = $request->user_phone;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->code = Helper::random_int(4, 9999);
        $user->email = $request->email;
        $user->password =Hash::make( $request->password);
        $user->role = $request->role;
        $user->status = 0;
        try {

            Mail::to( $user->email)->send(new RegisterEmails($user->first_name,'Valider votre inscription',  $user->code));
            $user->save();
            return view('auth.otp');
        }catch (\Exception $e){
            return view('auth.register');
        }
    }
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


//     protected function validator(array $data)
//     {
//         return Validator::make($data,
// [
//             'name' => ['required', 'string', 'max:255'],
//             'first_name' => ['required', 'string', 'max:255'],
//             'user_phone' => ['required', 'string', 'max:20'],
//             'username' => ['required', 'string', 'max:255', 'unique:users'],
//             'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//             'password' => ['required', 'string', 'min:8', 'confirmed'],
//             'role' => ['required', 'string', 'in:chargeur,transporteur'],
//         ]);
//     }
// /**
//      * Create a new user instance after a valid registration.
//      *
//      * @param  array  $data
//      * @return \App\Models\User
//      */
//     protected function create(array $data)
//     {
//         return User::create([
//             'name' => $data['name'],
//             'first_name' => $data['first_name'],
//             'user_phone' => $data['user_phone'],
//             'username' => $data['username'],
//             'email' => $data['email'],
//             'password' => Hash::make($data['password']),
//             'role' => $data['role'],
//         ]);
//     }
    }
