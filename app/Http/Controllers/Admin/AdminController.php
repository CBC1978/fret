<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FreightAnnouncement;
use App\Models\TransportAnnouncement;
use App\Models\Carrier;
use App\Models\Shipper;
use App\Models\User;



class AdminController extends Controller
{   //ADMIN CONTROLLER.....................................................................................................
    // Méthode pour afficher toutes les annonces de fret
    public function displayAnnouncement()
    {
        $chargeurAnnonces = FreightAnnouncement::with(['shipper'])->get();
        $transporteurAnnonces = TransportAnnouncement::with(['carrier'])->get();

        return view('admin.annonces.a_annonce', compact('chargeurAnnonces','transporteurAnnonces'));
    }

    // Méthode pour filtrer les annonces par status
    public function announcementFilterbyStatus(Request $request)
    {
        $status = $request->input('status');

         $chargeurAnnonces = FreightAnnouncement::query()->where('status', $status)->get();
         $transporteurAnnonces = TransportAnnouncement::query()->where('status', $status)->get();

        return view('admin.annonces.filter', compact('chargeurAnnonces', 'transporteurAnnonces'));
    }

    public function updateFreightAnnouncementStatus(FreightAnnouncement $annonce)
    {
        // marquer l'annonce comme activée ou désactivée
        $annonce->status = ($annonce->status == 1) ? 0 : 1;
        $annonce->save();

        return redirect()->route('annonces.a_annonce')->with('success', 'Annonce de chargement mise à jour avec succès.');
    }



    public function updateTransportAnnouncementStatus(TransportAnnouncement $annonce)
    {

        $annonce->status = ($annonce->status == 1) ? 0 : 1;
        $annonce->save();

        return redirect()->route('annonces.a_annonce')->with('success', 'Annonce de transport mise à jour avec succès.');
    }

    //USER GESTION.....................................................................................................
    public function bulkUpdateUserStatus(Request $request)
    {
        $selectedStatus = $request->input('status');
        $selectedUserIds = $request->input('user_ids');


        User::whereIn('id', $selectedUserIds)->update(['status' => $selectedStatus]);

        return response()->json(['message' => 'Statuts des utilisateurs mis à jour avec succès']);
    }

    public function filterUsers(Request $request)
    {
        $status = $request->input('status');
        $search = $request->input('search');

        $query = User::query();

        if (!empty($status)) {
            $query->where('status', $status);
        }

        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $users = $query->get();

        return view('admin.a_user_gestion', compact('users'));
    }

    public function displayUser()
    {
        $users = User::all();
        return view('admin.a_user_gestion', compact('users'));
    }

    //ENTREPRISE GESTION..................................................................................................
    public function displayEntrepriseChargeur()
{


    $users = User::all();

   // $carriers = Carrier::all(); // Récupérer tous les transporteurs
    $shippers = Shipper::all(); // Récupérer tous les expéditeurs

    return view('admin.chargeur', compact('users', 'shippers'));

}

public function displayEntrepriseTransporteur()
{


    $users = User::all();

    $carriers = Carrier::all(); // Récupérer tous les transporteurs
   // $shippers = Shipper::all(); // Récupérer tous les expéditeurs

    return view('admin.transporteur', compact('users', 'carriers'));

}
public function addCarrier(Request $request)
{
    // Récupérer l'ID de l'utilisateur depuis le champ hidden
$userId = $request->input('user_id');

    $validatedData = $request->validate([
        'company_name' => 'required|string',
        'address' => 'required|string',
        'phone' => 'required|string',
        'city' => 'required|string',
        'email' => 'required|email',
        'ifu' => 'required|string',
        'rccm' => 'required|string',

    ]);

    // Ajouter l'ID de l'utilisateur
$validatedData['created_by'] = $userId;
    // Créer un nouveau transporteur associé à l'utilisateur
    Carrier::create($validatedData);

    return redirect()->back()->with('success', 'Transporteur ajouté avec succès.');
    // Renvoyer une réponse JSON avec le message de succès
return Response::json(['message' => 'Transporteur ajouté avec succès.']);
}

    public function addShipper(Request $request)
    {
    // Récupérer l'ID de l'utilisateur à partir de la session

    $userId = $request->input('user_id');

    // Valider les données du formulaire
    $validatedData = $request->validate([
        'company_name' => 'required|string',
        'address' => 'required|string',
        'phone' => 'required|string',
        'city' => 'required|string',
        'email' => 'required|email',
        'ifu' => 'required|string',
        'rccm' => 'required|string',

    ]);
      // Ajouter l'ID de l'utilisateur
$validatedData['created_by'] = $userId;

    Shipper::create($validatedData);

    return redirect()->back()->with('success', 'Expéditeur ajouté avec succès.');

    }
    public function assignEntrepriseToUser(Request $request)
    {
    // Récupérer les données du formulaire
    $selectedUsers = $request->input('selected_users');
    $carrierId = $request->input('carrier_id');
    $shipperId = $request->input('shipper_id');

    // Parcourir les utilisateurs sélectionnés
    foreach ($selectedUsers as $userId) {
        // Récupérer l'utilisateur en utilisant son ID
        $user = User::find(intval($userId));


        // Attribuer l'entreprise de transport s'il y a un transporteur sélectionné
        if (!empty($carrierId)) {
            $user->fk_carrier_id = intval($carrierId);
            $user->fk_shipper_id = 0;
            $user->save();
        }

        // Attribuer l'entreprise d'expédition s'il y a un expéditeur sélectionné
        if (!empty($shipperId)) {
            $user->fk_shipper_id = intval($shipperId);
            $user->fk_carrier_id = 0;
            $user->save();
        }
    }
    }

//PROFILE ADMIN ...............................................................................................
 //
 public function displayProfile(){
    if (session()->has('username')) {
        $username = session('username');
        $user = User::where('username', $username)->first(); // Recherchez l'utilisateur par son nom d'utilisateur

        if ($user) {
            return view('admin.profile.a_profile', compact('user'));
        }
}
}

public function updateUserProfile(Request $request)
{
    // Validez les données respect de consigne pur chaq champ
    $request->validate([
        'name' => 'required|string|max:255',
        'first_name' => 'required|string|max:255',
        'username' => 'required|string|max:255',
        'user_phone' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
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
        ]);

        return redirect()->route('admin.profile.affichage')->with('success', 'donnéés mise à jour avec succès.');
    }
}

}
