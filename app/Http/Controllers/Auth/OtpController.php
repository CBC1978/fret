<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Mail\Email\RegisterEmail;
use App\Mail\Email\RegisterEmails;
use App\Mail\Email\ValidatedRegisterEmail;
use App\Mail\Email\ValidatedRegisterEmails;
use App\Models\User;
use App\Providers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OtpController extends Controller
{
    public function index()
    {
        return view('auth.otp');
    }

    public function otpVerify(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'string', 'min:4', 'max:255'],
        ]);

        $user = User::where('code', $request->otp)->first();


        $user = User::whereCode($request->otp)->first();

        if ($user && $user->code === $request->otp) {
            // Si le code OTP est vérifié, mettez le statut à 1
            $user->status = 1;
            $user->save();

            // Envoyez un e-mail pour informer de la vérification
            Mail::to($user->email)->send(new ValidatedRegisterEmails($user->first_name));

            return view('auth.VerifiedAccount');
        } else {
            // Si le code OTP ne correspond pas alors le compte n'est pas vérifié, rediriger vers la page d'envoi de code OTP avec un message d'erreur

            return redirect()->route('otp')->with('error_message', 'Le code OTP est incorrect.');
        }
    }

    public function otpLogin(Request $request)
    {
        // Si le compte n'est pas vérifié, générer et envoyer un nouveau code OTP
        $user = User::whereEmail($request->email)->first();
        Mail::to($user->email)->send(new RegisterEmails($user->first_name,'Valider votre inscription',  $user->code));;

        return redirect()->route('otp')->with('success_message', 'Un nouveau code OTP a été envoyé.');

    }


}
