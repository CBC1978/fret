<?php

namespace App\Http\Controllers;

use App\Models\ContractTransport;
use App\Models\FreightAnnouncement;
use App\Models\FreightOffer;
use App\Models\TransportAnnouncement;
use App\Models\TransportOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function countFreightAnnouncements()
    {
        $countFreightAnnouncement = FreightAnnouncement::count();
        return $countFreightAnnouncement;
    }

    public function countFreightOffer()
    {
        $countFreightOffer = FreightOffer::count();
        return $countFreightOffer;
    }

     
     public function ContractTransport()
    {
        $countContractTransport = ContractTransport::count();
        return $countContractTransport;
    }

     public function countOffers()
     {
         $count = TransportOffer::count();
         return $count;
     }

     public function countAnnouncements()
     {
         $countAnnouncements = TransportAnnouncement::count(); // Compter les annonces
         return $countAnnouncements;
     }

     public function index()
     {   
         $countFreightAnnouncement = $this->countFreightAnnouncements(); // Utilisation de la fonction pour compter les annonces de fret
         $countFreightOffer = $this->countFreightOffer();// Utilisation de la fonction pour compter les offres de fret
         $countContractTransport = $this->ContractTransport(); // Utilisation de la fonction pour compter les contrats
         $countAnnouncements = $this->countAnnouncements(); // Utilisation de la fonction pour compter les annonces
         $count = $this->countOffers(); // Utilisation de la fonction pour compter les annonces


         $announcements = DB::table('freight_announcement')
             ->selectRaw("
             freight_announcement.id,freight_announcement.origin,freight_announcement.destination,freight_announcement.limit_date,
             freight_announcement.weight, freight_announcement.volume,freight_announcement.description,
             shipper.company_name
             ")
             ->join('shipper','freight_announcement.fk_shipper_id' ,"=",'shipper.id')
             ->orderBy('freight_announcement.id', 'DESC')
             ->limit(10)
             ->get();

         $transports = DB::table('transport_announcement')
                        ->selectRaw("transport_announcement.id, transport_announcement.origin, transport_announcement.destination, transport_announcement.limit_date,
                        transport_announcement.weight, transport_announcement.vehicule_type, transport_announcement.description,
                       carrier.company_name")
             ->join('carrier', 'transport_announcement.fk_carrier_id','=', 'carrier.id')
             ->orderBy('transport_announcement.id', 'DESC')
             ->limit(10)
             ->get();
//         dd($transports);

         $role = session('role'); // Récupérer le rôle depuis la session

         if ($role === 'admin') {
             return view('admin_home');
         } elseif ($role === 'chargeur') {
             return view('shipper_home', compact('transports',"countFreightAnnouncement","countFreightOffer"));
         } elseif ($role === 'transporteur') {
            return view('carrier_home' , compact('announcements', 'countAnnouncements',"count","countContractTransport")); // Passer le nombre d'annonces à la vue
         } else {
             return view('home'); // Par défaut, si le rôle n'est pas reconnu
         }

     }
 }
