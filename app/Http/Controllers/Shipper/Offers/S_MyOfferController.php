<?php

namespace App\Http\Controllers\Shipper\Offers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class S_MyOfferController extends Controller
{
    public function index()
    {
        return view('shipper.offers.s_myoffer');
    }
}
