<?php

namespace App\Http\Controllers\Carrier\Announcement;

use App\Http\Controllers\Controller;
use App\Mail\Email\AnnouncementOffers;
use App\Mail\Email\OfferReceives;
use App\Mail\Email\OfferSends;
use App\Models\Carrier;
use App\Models\ContractDetails;
use App\Models\ContractTransport;
use App\Models\Driver;
use App\Models\FreightAnnouncement;
use App\Models\FreightOffer;
use App\Models\Shipper;
use App\Models\TransportOffer;
use App\Models\User;

use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Models\TransportAnnouncement;
use App\Models\TransportOffers;
use App\Models\Car;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Exception;

class CarrierAnnouncementController extends Controller
{
    public function displayTransportAnnouncement()
    {
        $announcements =  DB::table('transport_announcement')
                ->selectRaw("transport_announcement.id, transport_announcement.origin, transport_announcement.destination, transport_announcement.limit_date,
                        transport_announcement.weight, transport_announcement.vehicule_type, transport_announcement.description,
                       carrier.company_name")
                ->join('carrier', 'transport_announcement.fk_carrier_id','=', 'carrier.id')
                ->orderBy('transport_announcement.id', 'DESC')
                ->get();


        return view('carrier.announcements.index', ['announcements' => $announcements]);
    }

    public function userConnectedAnnouncement()
{
    $user = User::find(session()->get('userId'));
    $announces = TransportAnnouncement::where('fk_carrier_id', intval($user->fk_carrier_id))
        ->orderBy('created_at', 'DESC')
        ->get();

    // Traiter les annonces et compter les offres
    // Filtrer pour garder uniquement les annonces avec des offres
    $announcesWithOffers = $announces->each(function ($announce) {
        $announce->offreCount = $announce->freightOffers->count();
    })->filter(function ($announce) {
        return $announce->offreCount > 0;
    });

    return view('carrier.announcements.user', compact('announcesWithOffers'));
}


public function userConnectedAnnounce()
    {


        $user = User::find(session()->get('userId'));
        $announces = TransportAnnouncement::where('fk_carrier_id',intval($user->fk_carrier_id))
            ->orderBy('created_at', 'DESC')
            ->get();
             // Traiter les annonces et compter les offres, en gardant seulement celles sans offres
         $announcesWithoutOffers = $announces->each(function ($announce) {
             $announce->offreCount = $announce->freightOffers->count();
         })->filter(function ($announce) {
             return $announce->offreCount === 0;
         });


    return view('carrier.announcements.useroffer', compact('announcesWithoutOffers'));

}

    //  Méthode pour  gérer l'acceptation ou le refus d'une offre
//    public function offerManagementHandleOffer(Request $request, $offerId)
//    {
//        $offer = Offer::findOrFail($offerId);
//    }


    //  Méthode pour  gérer l'acceptation ou le refus d'une offre
    public function offerManagementHandleOffer(Request $request, $offerId)
    {
        $offer = Offer::findOrFail($offerId);

            return redirect()->back()->with('message', 'Offre traitée avec succès.');
    }


    public function show($id)
    {
        $announcement = TransportAnnouncement::findOrFail($id);
        return view('carrier.announcements.show', ['announcement' => $announcement]);
    }


   // Affiche le formulaire d'ajout d'annonce
   public function displayAnnouncementForm()
   {
       $villes = DB::table('ville')
           ->get();
       return view('carrier.announcements.create',compact('villes'));
   }

   // Traitement de la soumission du formulaire d'ajout
   public function handleSubmittedAnnouncement(Request $request)
   {
       $data = $request->validate([
           'origin' => ['required'],
           'destination' => ['required'],
           'limit_date' => ['required', 'date'],
           'vehicule_type' => ['required'],
           'weight' => ['nullable'],
           'description' => ['required', 'string'],
       ]);

       $carrierName = Carrier::find(session('fk_carrier_id'));
       $data['fk_carrier_id'] = session('fk_carrier_id');
       $data['created_by'] = $carrierName->created_by;
       $data['name'] = $carrierName->company_name;
       TransportAnnouncement::create($data);

        // Get all Shipper users
       $shippersUser = User::where([['fk_shipper_id', '!=', '0'],['status', '2']])->get();
       foreach ($shippersUser as $shipper){
           Mail::to($shipper->email)->send(new AnnouncementOffers($data));
       }
       return redirect()->route('carrier.announcements.create')->with('success', 'Annonce ajoutée avec succès.');
   }

   public function offer($id)
   {
    $transportAnnouncement = TransportAnnouncement::find(intval($id));
    $freightOffers = DB::table('freight_offer')
        ->selectRaw("
            freight_offer.id,
            freight_offer.price,
            freight_offer.weight,
            freight_offer.description,
            freight_offer.status,
            freight_offer.created_by,
            shipper.company_name
        ")
        ->join('shipper', 'freight_offer.fk_shipper_id', '=', 'shipper.id')
        ->where('freight_offer.fk_transport_announcement_id', $id) // Filtre par l'annonce de transport spécifique
        ->get();
       return view('carrier.offers.c_myoffer', compact(['transportAnnouncement', 'freightOffers']));
   }


    public function positOffer(Request $request){

     $request->validate([
            'prix' => [ 'max:255'],
            'description' => ['string'],

        ]);
        $user = User::find($request->idUser);

        $announce = FreightAnnouncement::find(intval($request->announce));
        $carrierName = Carrier::find(intval($user->fk_carrier_id));
        $shipperName = Shipper::find($announce->fk_shipper_id);
        $shipperUsers = User::where([['fk_shipper_id', $announce->fk_shipper_id],['status', '2']])->get();
        $carrierUsers = User::where([['fk_carrier_id', $user->fk_carrier_id],['status', '2']])->get();

        $transportOffer = new TransportOffer();
        $transportOffer->price = floatval($request->price);
        $transportOffer->description = $request->description;
        $transportOffer->fk_freight_announcement_id = intval($request->announce);
        $transportOffer->fk_carrier_id = intval($user->fk_carrier_id);
        $transportOffer->status = 0;
        $transportOffer->created_by = $user->id;
        $transportOffer->save();

        $data['price'] = $request->price;
        $data['description'] = $request->description;
        $data['announce'] = $announce;
        $data['sender'] = $carrierName->company_name;
        $data['receiver'] = $shipperName->company_name;

        //Send mail
        foreach ($shipperUsers as $shipper){
            Mail::to($shipper->email)->send(new OfferReceives($data));
        }
        foreach ($carrierUsers as $carrier){
            Mail::to($carrier->email)->send(new OfferSends($data));
        }

        return redirect('home')->with('success', "Offre ajouté avec succès");

    }

    public function myrequest()
    {
        $carrierId = session('fk_carrier_id');

        // Récupérez toutes les offres de transport liées à ce transporteur
        $offers = TransportOffer::where('fk_carrier_id', $carrierId)->get();
        $offers = TransportOffer::where('fk_carrier_id', $carrierId)->get();

        $offers = TransportOffer::where('fk_carrier_id', $carrierId)->paginate(10);
        return view('carrier.offers.carrier_myrequest', ['offers' => $offers]);
    }

    public function traiterAction(Request $request){
        $action = $request->input('action');
        if($action === 'accept'){


        }
    }

    public function manageOffer(Request $request, $id)
    {
        $action = $request->input('action');

        // Récupérer l'offre en fonction de l'ID
        $freightOffer = FreightOffer::findOrFail($id);


        if ($action === 'accept') {

           // Mail::to($emailUtilisateur->email)->send(new AcceptedOffer($emailUtilisateur->first_name));

            $freightOffer->status = 1;

            $contract = new ContractTransport();
            $contract->created_by = session("userId");
            $contract->fk_freight_offert_id = $request->input('offer');
            $contract->fk_transport_offer_id = 0;

            $contract->save();


        } elseif ($action === 'refuse') {

          //  Mail::to($emailUtilisateur->email)->send(new AcceptedOffer($emailUtilisateur->first_name));

            $freightOffer->status = 2;
        }
        // Sauvegarde des  modifications
        $freightOffer->save();

        return redirect()->back()->with('success', 'Statut de l\'offre mis à jour avec succès.');
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

        return view('carrier.contract.contract_view', ['contract_id'=>$id, 'contract'=> $contractInfos, 'details'=>$contractDetails ]);

    }
    public function contract_carrier($id)
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

        $carrierId = session('fk_carrier_id');
        $cars= Car::where('fk_carrier_id', $carrierId)->get();
        $drivers= Driver::where('fk_carrier_id', $carrierId)->get();
        return view('carrier.contract.contract_carrier',
            ['cars' => $cars, 'drivers'=>$drivers , 'contract_id'=>$id, 'contract'=> $contractInfos, 'details'=>$contractDetails ]);
    }


    public function addCar(Request $request)
    {
       $request->validate([
            'registration' => 'required|string|max:255',
        ]);

        $carrierId = session('fk_carrier_id');
        $car = new Car();
        $car->registration = $request->input('registration');
        $car->type = '';
        $car->brand = '';
        $car->type = '';
        $car->model = '';
        $car->payload = '';
        $car->fk_carrier_id = $carrierId;
        $car->save();
        return json_encode($car);

    }

    public function addDriver(Request $request)
    {
        $request->validate([
            'first' => 'required|string|max:255',
            'last' => 'required|string|max:255',
            'licence' => 'required|string|max:255',
        ]);

        $carrierId = session('fk_carrier_id');
        $driver = new Driver();
        $driver->first_name = $request->input('first');
        $driver->last_name = $request->input('last');
        $driver->licence = $request->input('licence');
        $driver->date_issue = $request->input('date_e');
        $driver->place_issue = $request->input('place');
        $driver->fk_carrier_id = $carrierId;
        $driver->created_by = session('userId');

        $driver->save();

        return $driver;
    }

    public function contractDetails(Request $request)
    {
        $cars = $request->input('id_car_contract');
        if (count($cars) <= 0)
        {
            return 2;
        }
        elseif(count($cars) == count($cars))
        {
            $db_details = ContractDetails::where('contract_id',intval($request->input('contract')))->get();
                foreach ($db_details as $db){
                    $db->delete();
                }

            for($i = 0; $i < count($cars); $i++ ){

                $contractDetails = new ContractDetails();
                $contractDetails->contract_id = intval($request->input('contract'));
                $contractDetails->driver_id = $request->input('id_driver_contract')[$i];
                $contractDetails->cars_id = $request->input('id_car_contract')[$i];
                $contractDetails->created_by = intval(session()->get('userId'));

                $contractDetails->save();
            }

            return 0;

        }elseif(count($cars) != count($cars))
        {
            return 1;
        }
    }

    public function contractHome()
    {
        $user = User::find(intval(session('userId')));
        try {
                $contracts = DB::table('contract_transport')
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
                    ->where('transport_offer.fk_carrier_id', $user->fk_carrier_id)
                    ->orderBy('contract_transport.id','desc')
                    ->get();

                $contractsFromShipper = DB::table('contract_transport')
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
                    ->where('transport_announcement.fk_carrier_id', $user->fk_carrier_id)
                    ->orderBy('contract_transport.id','desc')
                    ->get();
        } catch (Exception $e){
            $contracts = [];
            $contractsFromShipper = [];
        }
        return view('carrier.contract.home',compact(['contracts', 'contractsFromShipper']));
    }

    public function printContract($id)
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

        $data = [
            'details'=>$contractDetails,
            'info'=>$contractInfos
        ];
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('carrier.contract.print_contract',$data);

        return $pdf->stream('Contrat_de_transport.pdf');

    }

}
