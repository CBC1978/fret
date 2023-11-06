<?php

namespace App\Http\Controllers\Shipper\Announcement;

use App\Http\Controllers\Controller;
use App\Mail\Email\AcceptedOffer;
use App\Mail\Email\AnnouncementOffer;
use App\Mail\Email\OfferReceive;
use App\Mail\Email\OfferSend;
use App\Models\Carrier;
use App\Models\ContractTransport;
use App\Models\FreightOffer;
use App\Models\Shipper;
use App\Models\TransportAnnouncement;
use App\Models\TransportOffer;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\FreightAnnouncement;
use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\Mail;
use mysql_xdevapi\Exception;
use Opcodes\LogViewer\Log;

class ShipperAnnouncementController extends Controller
{
   // Afficher toutes les annonces
   public function displayFreightAnnouncement()
   {
       $announcements = DB::table('freight_announcement')
           ->selectRaw("
            freight_announcement.id,freight_announcement.origin,freight_announcement.destination,freight_announcement.limit_date,
            freight_announcement.weight, freight_announcement.volume,freight_announcement.description,freight_announcement.price,shipper.company_name")
           ->join('shipper','freight_announcement.fk_shipper_id' ,"=",'shipper.id')
           ->orderBy('freight_announcement.id', 'DESC')
           ->get();
       return view('shipper.announcements.index', ['announcements' => $announcements]);
   }

   public function positOffer (Request $request)
   {

       $request->validate([

           'price' => [ 'max:2555', 'numeric'],

           'price' => [ 'max:255'],
           'description' => ['string']
       ]);
       $user = User::find(intval(session('userId')));

       $announce = TransportAnnouncement::find(intval($request->announce));
       $carrierName = Carrier::find(intval($announce->fk_carrier_id));
       $shipperName = Shipper::find($user->fk_shipper_id);
       $shipperUsers = User::where([['fk_shipper_id', $user->fk_shipper_id ],['status', '2']])->get();
       $carrierUsers = User::where([['fk_carrier_id',$announce->fk_carrier_id],['status', '2']])->get();

       $freightOffer = new FreightOffer();
       $freightOffer->price = floatval($request->price);
       $freightOffer->description = $request->description;
       $freightOffer->weight = $request->weight;
       $freightOffer->fk_transport_announcement_id = intval($request->announce);
       $freightOffer->fk_shipper_id = intval($user->fk_shipper_id);
       $freightOffer->status = 0;
       $freightOffer->created_by = $user->id;
       $freightOffer->save();

       $data['price'] = $request->price;
       $data['description'] = $request->description;
       $data['announce'] = $announce;
       $data['receiver'] = $carrierName->company_name;
       $data['sender'] = $shipperName->company_name;

       //Send mail
       foreach ($shipperUsers as $shipper){
           Mail::to($shipper->email)->send(new OfferSend($data));
       }
       foreach ($carrierUsers as $carrier){
           Mail::to($carrier->email)->send(new OfferReceive($data));
       }
       return redirect('home')->with('success', "Offre ajouté avec succès");

   }

       // Afficher les annonces de l'utilisateur
       public function userConnectedAnnouncement()
       {
           $user = User::find(session()->get('userId'));
           $announces = FreightAnnouncement::where('fk_shipper_id',intval($user->fk_shipper_id))
               ->orderBy('created_at', 'DESC')
               ->get();
          // Traiter les annonces et compter les offres
       foreach ($announces as $announce) {
        $announce->offre = $announce->transportOffer->count();
    }

           return view('shipper.announcements.user', compact('announces'));
       }

       // Méthode pour gérer l'acceptation ou le refus d'une offre
       public function handleOffer(Request $request, $offerId)
       {
           $offer = Offer::findOrFail($offerId);


           return redirect()->back()->with('message', 'Offre traitée avec succès.');
       }


   // Afficher le détail d'une annonce
   public function show($id)
   {
       $announcement = FreightAnnouncement::findOrFail($id);
       return view('shipper.announcements.show', ['announcement' => $announcement]);
   }


   public function displayAnnouncementForm()
   {
       return view('shipper.announcements.create');
   }


   public function handleSubmittedAnnouncement(Request $request)
   {
       $user = User::find(session('userId'));

       $data = $request->validate([
           'origin' => ['required', 'string', 'max:255'],
           'destination' => ['required', 'string', 'max:255'],
           'limit_date' => ['required', 'date'],
           'weight' => ['nullable', 'numeric'],
           'volume' => ['nullable', 'numeric'],
           'price' => ['nullable', 'numeric'],
           'description' => ['required', 'string'],

       ]);
        $shipperName = Shipper::find(session('fk_shipper_id'));

        $data['fk_shipper_id'] = session('fk_shipper_id');
        $data['created_by'] = session('userId');
        $data['name'] = $shipperName->company_name;

       FreightAnnouncement::create($data);

//       Get all Carrier User
       $carriersUser = User::where([['fk_carrier_id', '!=', '0'],['status', '2']])->get();
       foreach ($carriersUser as $shipper){
           Mail::to($shipper->email)->send(new AnnouncementOffer($data));
       }

       return redirect()->route('shipper.announcements.create')->with('success', 'Annonce ajoutée avec succès.');
   }


   public function offer($id)
   {
       $annonce = FreightAnnouncement::find(intval($id));
       $offers = DB::table('transport_offer')
           ->selectRaw("
               transport_offer.id,
               transport_offer.price,
               transport_offer.status,
               transport_offer.description,
               carrier.company_name
           ")
           ->join('carrier', 'transport_offer.fk_carrier_id', '=', 'carrier.id')
           ->where('transport_offer.fk_freight_announcement_id', $id) // Filtre par l'annonce spécifique
           ->get();
       return view('shipper.offers.s_myoffer', compact(['annonce', 'offers']));
   }

   public function myrequest(){
    $shipperId = session('fk_shipper_id');

    // Récupérez toutes les offres de chargeur liées à ce chargeur
   $offers =DB::table('freight_offer')
       ->where('fk_shipper_id', $shipperId)->get();

   return view('shipper.offers.shipper_myrequest', ['offers'=>$offers]);
   }

   public function manageOffer(Request $request, $id)
   {
       $action = $request->input('action');

       // Récupérer l'offre en fonction de l'ID
       $transportOffer = TransportOffer::findOrFail($id);
      // $emailUtilisateur = $transportOffer->user->email;


       if ($action === 'accept') {

          // Mail::to($emailUtilisateur->email)->send(new AcceptedOffer($emailUtilisateur->first_name));

           $contract = new ContractTransport();
           $contract->created_by = session("userId");
           $contract->fk_freight_offert_id = 0;
           $contract->fk_transport_offer_id = $request->input('offer');

           $contract->save();
           $transportOffer->status = 1;
       } elseif ($action === 'refuse') {

           $transportOffer->status = 2;
       }

       // Sauvegarde des  modifications
       $transportOffer->save();

       return redirect()->back()->with('success', 'Statut de l\'offre mis à jour avec succès.');
   }

    public function contractHome()
    {
        $user = User::find(intval(session('userId')));

        try {
            $contracts = DB::table('contract_transport')
                ->selectRaw("
                    contract_transport.id,
                    transport_announcement.origin,
                    transport_announcement.destination,
                    transport_announcement.description,
                    shipper.company_name
                    ")
                ->join('freight_offer', 'contract_transport.fk_freight_offert_id', '=', 'freight_offer.id')
                ->join('transport_announcement', 'freight_offer.fk_transport_announcement_id', '=', 'transport_announcement.id')
                ->join('shipper', 'freight_offer.fk_shipper_id', '=', 'shipper.id')
                ->where('freight_offer.status', 1)
                ->where('freight_offer.fk_shipper_id', $user->fk_shipper_id)
                ->orderBy('contract_transport.id','desc')
                ->get();

            $contractsFromShipper = DB::table('contract_transport')
                ->selectRaw("
                    contract_transport.id,
                    freight_announcement.origin,
                    freight_announcement.destination,
                    freight_announcement.description,
                    shipper.company_name
                    ")
                ->join('transport_offer', 'contract_transport.fk_transport_offer_id', '=', 'transport_offer.id')
                ->join('freight_announcement', 'transport_offer.fk_freight_announcement_id', '=', 'freight_announcement.id')
                ->join('shipper', 'freight_announcement.fk_shipper_id', '=', 'shipper.id')
                ->where('transport_offer.status', 1)
                ->where('freight_announcement.fk_shipper_id', $user->fk_shipper_id)
                ->orderBy('contract_transport.id','desc')
                ->get();
        } catch (\PHPUnit\Exception $e){
            $contracts = [];
            $contractsFromShipper = [];
        }
        return view('shipper.contract.home', compact(['contracts','contractsFromShipper']));
   }

    public function contract_view($id)
    {
        $contract = ContractTransport::find($id);
        $contractDetails = DB::table('contract_details')
            ->selectRaw("
                contract_details.id as details_id,
                driver.id as driver_id,
                driver.licence  as licence,
                driver.first_name as driver_first,
                driver.last_name as driver_last,

                car.id_car as car_id,
                car.registration as car_registration

            ")
            ->join('driver', 'contract_details.driver_id' ,'=', 'driver.id')
            ->join('car', 'contract_details.cars_id' ,'=', 'car.id_car')
            ->where('contract_id', $id)
            ->get();
        if ( isset($contract->fk_transport_offer_id) && $contract->fk_transport_offer_id != 0){
            $contractInfos = DB::table('transport_offer')
                ->selectRaw("
                freight_announcement.origin,
                freight_announcement.destination,
                freight_announcement.weight,
                freight_announcement.description,

                shipper.company_name as shipperName,
                shipper.address as shipperAddress,
                shipper.ifu as shipperIfu,
                shipper.rccm as shipperRccm,
                shipper.phone as shipperPhone,

                carrier.company_name as carrierName,
                carrier.address as carrierAddress,
                carrier.ifu as carrierIfu,
                carrier.rccm as carrierRccm,
                carrier.phone as carrierPhone
                ")
                ->join('contract_transport', 'transport_offer.id' , '=', 'contract_transport.fk_transport_offer_id')
                ->join('freight_announcement', 'transport_offer.fk_freight_announcement_id','=', 'freight_announcement.id')
                ->join('carrier' , 'transport_offer.fk_carrier_id' , '=', 'carrier.id')
                ->join('shipper', 'freight_announcement.fk_shipper_id', '=', 'shipper.id')
                ->where('contract_transport.id', $id)
                ->get();
        }elseif(isset($contract->fk_freight_offert_id) && $contract->fk_freight_offert_id != 0){
            $contractInfos = DB::table('freight_offer')
                ->selectRaw("
                transport_announcement.origin,
                transport_announcement.destination,
                transport_announcement.weight,
                transport_announcement.description,

                shipper.company_name as shipperName,
                shipper.address as shipperAddress,
                shipper.ifu as shipperIfu,
                shipper.rccm as shipperRccm,
                shipper.phone as shipperPhone,

                carrier.company_name as carrierName,
                carrier.address as carrierAddress,
                carrier.ifu as carrierIfu,
                carrier.rccm as carrierRccm,
                carrier.phone as carrierPhone
                ")
                ->join('contract_transport', 'freight_offer.id' , '=', 'contract_transport.fk_freight_offert_id')
                ->join('transport_announcement', 'freight_offer.fk_transport_announcement_id','=', 'transport_announcement.id')
                ->join('carrier' , 'transport_announcement.fk_carrier_id' , '=', 'carrier.id')
                ->join('shipper', 'freight_offer.fk_shipper_id', '=', 'shipper.id')
                ->where('contract_transport.id', $id)
                ->get();
        }

        return view('shipper.contract.contract_view', ['contract_id'=>$id, 'contract'=> $contractInfos, 'details'=>$contractDetails ]);

    }
}
