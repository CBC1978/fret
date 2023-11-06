<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\FreightOffer;
use App\Models\TransportOffer;
use App\Models\User;
use App\Models\Driver;
use App\Models\TransportAnnouncement;
use App\Models\TransportOffers;
use App\Models\ContractTransport;
use App\Models\CarAndContract;
use Illuminate\Support\Facades\DB;
use Opcodes\LogViewer\Log;


use App\Models\Car; 

class CarController extends Controller
{
    public function showCarRegistrations()
    {
        
        $carrierId = session('fk_carrier_id');

       
        $registrations = Car::where('fk_carrier_id', $carrierId)->get();

        return view('carrier.contract.contract_carrier', ['registrations' => $registrations]);
    }
    public function showDriverLicenses()
    {
        $carrierId = session('fk_carrier_id');
        $license_ids = Driver::where('fk_carrier_id', $carrierId)->get();
        return view('carrier.contract.contract_carrier', ['license_ids' => $license_ids]);
    }

    public function showContractDetails()
    {
        $registrations = $this->showCarRegistrations();
        $license_ids = $this->showDriverLicenses();
        return view('carrier.contract.contract_carrier', compact('registrations', 'license_ids'));
    }

    public function addCar(Request $request)
    {
        $request->validate([
            'registration' => 'required|string|max:255',
        ]);

        $carrierId = session('fk_carrier_id');
        $car = new Car();
        $car->registration = $request->input('registration');
        $car->fk_carrier_id = $carrierId;
        $car->save();

        return redirect()->route('carrier.contract.contract_carrier');
    }
}