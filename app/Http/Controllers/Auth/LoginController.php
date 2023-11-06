<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Carrier;
use App\Models\Shipper;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

//use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    public function index()
    {
        return view('auth.login');
    }

    public function home()
    {
        return view('home');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = User::whereEmail($request->email)->first();
        if (!empty($user->id)) {
            switch($user->status) {

                case 0:
                    return redirect()->route('otpLogin');
                    break;
                case 1:
                    if (Hash::check($request->password, $user->password)) {
                        $request->session()->put('userId', $user->id);
                        $request->session()->put('username', $user->username);
                        $request->session()->put('role', $user->role);
                        $request->session()->put('status', $user->status);
                        $request->session()->put('fk_carrier_id', $user->fk_carrier_id);
                        $request->session()->put('fk_shipper_id', $user->fk_shipper_id);
                        $request->session()->put('first_name', $user->first_name);
                        // Récupérer le nom de l'entreprise à partir de la table 'carrier' ou 'shipper'
                        if ($user->fk_carrier_id) {
                            $carrier = Carrier::find($user->fk_carrier_id);
                            if ($carrier) {
                                $request->session()->put('company_name', $carrier->company_name);
                            }
                        } elseif ($user->fk_shipper_id) {
                            $shipper = Shipper::find($user->fk_shipper_id);
                            if ($shipper) {
                                $request->session()->put('company_name', $shipper->company_name);
                            }
                        }
                        return redirect('home');
                    }else {
                        return back()->with('fail', "Les mots de passe ne correspondent pas");
                    }
                    break;
                case 2:
                    if (Hash::check($request->password, $user->password)) {
                        $request->session()->put('userId', $user->id);
                        $request->session()->put('username', $user->username);
                        $request->session()->put('role', $user->role);
                        $request->session()->put('status', $user->status);
                        $request->session()->put('fk_carrier_id', $user->fk_carrier_id);
                        $request->session()->put('fk_shipper_id', $user->fk_shipper_id);
                        $request->session()->put('first_name', $user->first_name);
                        // Récupérer le nom de l'entreprise à partir de la table 'carrier' ou 'shipper'
                        if ($user->fk_carrier_id) {
                            $carrier = Carrier::find($user->fk_carrier_id);
                            if ($carrier) {
                                $request->session()->put('company_name', $carrier->company_name);
                            }
                        } elseif ($user->fk_shipper_id) {
                            $shipper = Shipper::find($user->fk_shipper_id);
                            if ($shipper) {
                                $request->session()->put('company_name', $shipper->company_name);
                            }
                        }
                        return redirect('home');
                    }else {
                        return back()->with('fail', "Les mots de passe ne correspondent pas");
                    }
                    break;
                default:
                    return back()->with('fail', "L'email n'existe pas");
                    break;
            }
        }
    }

    public function logout()
    {
        Auth::logout(); // Déconnecte l'utilisateur
        Session::flush(); // Vide la session
        return redirect()->route('login'); // Redirige vers la page de connexion
    }

}
