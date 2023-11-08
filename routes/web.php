<?php

    use App\Http\Controllers\CarController;

    use App\Http\Controllers\Admin\profile\AdminProfileController1;
    use App\Http\Controllers\Shipper\profile\ShipperProfileController1;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Auth;

    use App\Http\Controllers\HomeController;

    use App\Http\Controllers\Auth\OtpController;

    use App\Http\Controllers\Auth\LoginController;
    use App\Http\Controllers\Auth\RegisterController;
    use App\Http\Controllers\Admin\AdminUserGestionController;
    use App\Http\Controllers\Admin\EntrepriseGestionController;
    use App\Http\Controllers\Admin\AdminController;
    use App\Http\Controllers\Carrier\profile\CarrierProfileController;
    use App\Http\Controllers\Shipper\profile\ShipperProfile1Controller;
    use App\Http\Controllers\Carrier\parameter\CarrierSettingsController;
    use App\Http\Controllers\Admin\parameter\AdminSettingsController;

    use App\Http\Controllers\Shipper\Offers\S_MyOfferController;

    use App\Http\Controllers\Carrier\Offers\C_MyOfferController;


//SHIPPER ROUTE

    use App\Http\Controllers\Shipper\Announcement\ShipperAnnouncementController;
    use App\Http\Controllers\Shipper\Offers\S_OfferController;

//CARRIER ROUTE

    use App\Http\Controllers\Carrier\Announcement\CarrierAnnouncementController;
    use App\Http\Controllers\Carrier\Offers\C_OfferController;

//regroupement
    use App\Http\Controllers\Shipper\Offers as ShipperOffers;
    use App\Http\Controllers\Carrier\Offers as CarrierOffers;
    use App\Http\Controllers\Admin as AdminControllers;
    use App\Http\Controllers\shipper\parameter\ShipperSettingsController;

//announcement




    use App\Http\Controllers\Chat\CarrierChatController;
    use App\Http\Controllers\Chat\ShipperChatController;

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider and all of them will
    | be assigned to the "web" middleware group. Make something great!
    |
    */


// Routes spécifiques à l'administrateur ........................................

    Route::get('/chat',function () { return view('chat.shipper'); });
//    Route::get('/email',
//        [RegisterController::class, 'register']
//        function () { return view('email.registerEmail'); }
//    );



// Routes spécifiques au shipper ........................................
//Route::middleware(['check.role:shipper'])->group(function () {
    Route::get('/shipper_home', [HomeController::class, 'home'])->name('shipper_home');
    Route::get('/shipper/offers/add', [S_AddOfferController::class, 'index'])->name('s_add_offer');
    Route::get('/shipper/offers/myoffer', [S_MyOfferController::class, 'index'])->name('s_myoffer');
    Route::get('/shipper/offers/offerdetail', [S_OfferDetailController::class, 'index'])->name('s_offerdetail');
    Route::get('/shipper/offers/offer', [S_OfferController::class, 'index'])->name('s_offer');
    // ... Autres routes spécifiques au shipper ...
//});

// Routes spécifiques au carrier ....................................
//Route::middleware(['check.role:carrier'])->group(function () {
    Route::get('/carrier_home', [HomeController::class, 'home'])->name('carrier_home');
    Route::get('/carrier/offers/add', [C_AddOfferController::class, 'index'])->name('c_add_offer');
    Route::get('/carrier/offers/myoffer', [C_MyOfferController::class, 'index'])->name('c_myoffer');
    Route::get('/carrier/offers/offerdetail', [C_OfferDetailController::class, 'index'])->name('c_offerdetail');
    Route::get('/carrier/offers/offer', [C_OfferController::class, 'index'])->name('c_offer');

    // ... Autres routes spécifiques au carrier ...
//});

// Routes communes à tous les utilisateurs....................................
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('loginUser');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/otp', [OtpController::class, 'index'])->name('otp');
    Route::post('/otp-verify', [OtpController::class, 'otpVerify'])->name('otpVerify');
    Route::post('/otp', [OtpController::class, 'login'])->name('otpLogin');
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('registerUser');
    Route::get('/home', [HomeController::class, 'index'])->name('home');


    Route::prefix('carrier/announcements')->name('carrier.announcements.')->group(function () {
        Route::get('/', [CarrierAnnouncementController::class, 'displayTransportAnnouncement'])->name('index');
        Route::get('user', [CarrierAnnouncementController::class, 'userConnectedAnnouncement'])->name('user');
        Route::get('create', [CarrierAnnouncementController::class, 'displayAnnouncementForm'])->name('create');
        Route::post('store', [CarrierAnnouncementController::class, 'handleSubmittedAnnouncement'])->name('store');
        Route::post('offer.manage/{id}', [CarrierAnnouncementController::class, 'manageOffer'])->name('offer.manage')->where('id', '[0-9]+');
        Route::get('myoffer/{id}', [CarrierAnnouncementController::class, 'offer'])->name('myoffer')->where('id', '[0-9]+');;
        Route::get('myrequest', [CarrierAnnouncementController::class, 'myrequest'])->name('carrier_myrequest');
        Route::post('postuler', [CarrierAnnouncementController::class, 'positOffer'])->name('postuler');
        Route::get('{id}', [CarrierAnnouncementController::class, 'show'])->name('show');
        Route::get('contract/home', [CarrierAnnouncementController::class, 'contractHome'])->name('contract');

    });

    Route::prefix('shipper/announcements')->name('shipper.announcements.')->group(function () {
        Route::get('/', [ShipperAnnouncementController::class, 'displayFreightAnnouncement'])->name('index');
        Route::get('user', [ShipperAnnouncementController::class, 'userConnectedAnnouncement'])->name('user');
        Route::get('myrequest', [ShipperAnnouncementController::class, 'myrequest'])->name('shipper_myrequest');
        Route::get('create', [ShipperAnnouncementController::class, 'displayAnnouncementForm'])->name('create');
        Route::get('{id}', [ShipperAnnouncementController::class, 'show'])->name('show');
        Route::post('postuler', [ShipperAnnouncementController::class, 'positOffer'])->name('postuler');
        Route::post('manage-offer/{id}', [ShipperAnnouncementController::class, 'manageOffer'])->name('offer.manage')->where('id', '[0-9]+');

        Route::post('store', [ShipperAnnouncementController::class, 'handleSubmittedAnnouncement'])->name('store');
        Route::get('myoffer/{id}', [ShipperAnnouncementController::class, 'offer'])->name('myoffer')->where('id', '[0-9]+');
        Route::post('store', [ShipperAnnouncementController::class, 'handleSubmittedAnnouncement'])->name('store');

        Route::get('contract/home', [ShipperAnnouncementController::class, 'contractHome'])->name('contract');
        Route::get('contract/view/{id}', [ShipperAnnouncementController::class, 'contract_view'])->name('s_contract_view');

    });

//Les routes annonces ADMIN
    Route::prefix('annonces')->group(function () {
        Route::get('/', [AdminController::class, 'displayAnnouncement'])->name('annonces.a_annonce');
        Route::get('/transport-offer', [AdminController::class, 'displayAnnounceTransport'])->name('annonces.a_annonceTransporter');
        Route::put('/filtrer', [AdminController::class, 'announcementFilterbyStatus'])->name('annonces.filter');
        Route::get('/update-freight/{annonce}', [AdminController::class,'updateFreightAnnouncementStatus'])->name('annonces.updateFreight');
        Route::get('/update-transport/{annonce}', [AdminController::class,'updateTransportAnnouncementStatus'])->name('annonces.updateTransport');

    });
    Route::post('/bulk_update_status', [AdminController::class, 'bulkUpdateUserStatus'])->name('bulk_update_status');

    Route::middleware(['check.role:admin'])->group(function () {
        Route::get('/admin_home', [HomeController::class, 'home'])->name('admin_home');
        Route::get('/a_user_gestion', [AdminController::class, 'displayUser'])->name('a_user_gestion');
        Route::get('/filter_users', [AdminController::class, 'filterUsers'])->name('filter_users');

    });

    Route::get('/a_user_gestion', [AdminController::class, 'displayUser'])->name('a_user_gestion');

    Route::prefix('admin')->group(function () {

        Route::get('/transporteur', [AdminController::class, 'displayEntrepriseTransporteur'])->name('admin.transporteur');
        Route::get('/chargeur', [AdminController::class, 'displayEntrepriseChargeur'])->name('admin.chargeur');
        Route::get('/entreprise', [AdminController::class, 'displayEntreprise'])->name('admin.entreprise');

        Route::post('/ajouter-transporteur', [AdminController::class, 'addCarrier'])->name('admin.ajouter-transporteur');
        Route::post('/ajouter-expediteur', [AdminController::class, 'addShipper'])->name('admin.ajouter-expediteur');

        Route::post('/assigner-entreprise-user', [AdminController::class, 'assignEntrepriseToUser'])->name('admin.assigner-entreprise-user');
        // ... Autres routes spécifiques à la gestion des entreprises ...
    });

    Route::prefix('admin')->group(function () {
        Route::get('/profile', [AdminController::class,'displayProfile'])->name('admin.profile.affichage');
        Route::get('profile/update', [AdminController::class,'updateUserProfile'])->name('admin.profile.update');
        Route::get('parameter/adminSettings',[AdminSettingsController::class, 'displayAdminSettings'])->name('admin.parameter.displayAdminSettings');
        Route::get('parameter/adminSettings-update',[AdminSettingsController::class, 'updateAdminSettings'])->name('admin.parameter.updateAdminSettings');

    });


    Route::prefix('carrier')->group(function () {
        Route::get('/profile', [CarrierProfileController::class,'affichage'])->name('carrier.profile.affichage');

        Route::post('profile/update', [CarrierProfileController::class,'update'])->name('carrier.profile.update');
        Route::get('parameter/carrierSettings', [CarrierSettingsController::class,'displayCarrierSettings'])->name('carrier.parameter.displayCarrierSettings');
        route::post('parameter/carriersettings-update', [CarrierSettingsController::class, 'updateCarrierSettings'])->name('carrier.parameter.updateCarrierSettings');

        Route::get('profile/update', [CarrierProfileController::class,'update'])->name('carrier.profile.update');

    });


    Route::prefix('shipper')->group(function () {
        Route::get('/profile', [ShipperProfileController1::class,'affichage'])->name('shipper.profile.affichage');
        Route::post('profile/update', [ShipperProfileController1::class,'update'])->name('shipper.profile.update');
        Route::get('parameter/shipperSettings',[ShipperSettingsController::class, 'displayShipperSettings'])->name('shipper.parameter.displayShipperSettings');
        Route::get('parameter/shipperSettings-update',[ShipperSettingsController::class, 'updateShipperSettings'])->name('shipper.parameter.updateShipperSettings');

    });


//Route::get('/carrier-chat', [CarrierChatController::class, 'index'])->name('carrier-chat');
    Route::get('/carrier-chat/{offer_id}', [CarrierChatController::class, 'index'])->name('carrier-chat');

    Route::get('/shipper-chat/{offer_id}', [ShipperChatController::class, 'index'])->name('shipper-chat');

    Route::post('/sendMessage/{offer_id}', [CarrierChatController::class, 'sendMessage'])->name('sendMessage');

    Route::post('/sendMessage/{offer_id}', [ShipperChatController::class, 'sendMessage'])->name('sendMessage');


    Route::get('/carrier-reply-chat/{offer_id}', [CarrierChatController::class, 'reply'])->name('carrier-reply-chat');

    Route::get('/shipper-reply-chat/{offer_id}', [ShipperChatController::class, 'reply'])->name('shipper-reply-chat');



//Route::post('/sendMessage/{offer_id}b', 'CarrierChatController@sendMessage')->name('sendMessage');


    Route::get('/carrier/contract/{id}', [CarrierAnnouncementController::class, 'contract_carrier'])->name('c_contract');



    Route::get('/carrier/contract/{id}', [CarrierAnnouncementController::class, 'contract_carrier'])->name('c_contract');
    Route::get('/carrier/contract/view/{id}', [CarrierAnnouncementController::class, 'contract_view'])->name('c_contract_view');
    Route::post('/carrier/car/add', [CarrierAnnouncementController::class, 'addCar'])->name('add-car');
    Route::post('/carrier/driver/add', [CarrierAnnouncementController::class, 'addDriver'])->name('add-driver');
    Route::post('/carrier/contract/info', [CarrierAnnouncementController::class, 'contractDetails'])->name('add-contract-details');
    Route::get('/carrier/print/{id}', [CarrierAnnouncementController::class, 'printContract'])->name('print-contract');

    Route::get('/car-registrations/{carrierId}', [CarController::class, 'showCarRegistrations'])->name('car.registrations');



    Route::get('/car-registrations', [CarController::class, 'showCarRegistrations'])
        ->name('car-registrations');
    //    Route::post('/add-car', 'CarController@addCar')->name('add-car');

