<?php

namespace App\Http\Controllers\Shipper\parameter;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ShipperSettingsController extends Controller
{
    //
    public function displayShipperSettings(){
        if (session()->has('username')) {
            $username = session('username');
            $user = User::where('username', $username)->first(); // Je recherche l'utilisateur par son nom d'utilisateur
            
            if ($user) {
                return view('shipper.parameter.shipperSettings', compact('user'));
            } 
}
    }


    public function updateShipperSettings(Request $request)
    {
         // Validez les données respect de consigne pur chaq champ
         $request->validate([
            'name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'user_phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'company_name' => 'required|string|max:255',
            'city' => 'required|string|max:25',
            'address' => 'required|string|max:25',
            
        ]);
        

        // retrouver le user en question
        $username = session('username');
        $user = User::where('username', $username)->first();

        if ($user) {
            // Mis à jour données...
            $user->update([
                'name' => $request->input('name'),
                'first_name' => $request->input('first_name'),
                'username' => $request->input('username'),
                'user_phone' => $request->input('user_phone'),
                'email' => $request->input('email'),
                'company_name' => $request->input('company_name'),
                'city' => $request->input('city'),
                'address' => $request->input('address'),
            ]);
            return redirect()->back()->with('success', 'donnéés mise à jour avec succès.');

        } 
       

}
}
