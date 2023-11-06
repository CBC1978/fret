@extends('layouts.app')

@section('content')
<script>
    function returnToPreviousPage() {
    window.history.back(); // Revenir à la page précédente
}
</script> 
<button type="submit" onclick="returnToPreviousPage()">Retour</button> <style>
    button[type="submit"] {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
    }

    a {
        color: #007bff;
        text-decoration: none;
    }
</style>
<div class="box-content">
    <div class="box-heading">
        <div class="box-title">
            <h3 class="mb-35">Offres de Fret/Transport</h3>
        </div>
        <div class="box-breadcrumb">
            <div class="breadcrumbs">
                <ul>
                    <li><a class="icon-home" href="index.html">Dashboard</a></li>
                    <li><span>Offres</span></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-12 col-xl-12 col-lg-7">
            <div class="section-box">
                <div class="row">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-box">
                                <div class="container">
                                    <div class="panel-white mb-30">
                                        <div class="box-padding">
                                            <div class="box-filters-job">
                                                <!--  filter  -->
                                                <!-- ... -->
                                            </div>
                                            <div class="row">
                                                @foreach($freightOffers as $offer)
                                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
                                                        <div class="card-grid-2 hover-up">
                                                            <div class="card-grid-2-image-left">
                                                                <span class="flash"></span>
                                                                <div class="image-box">
                                                                    <img src="{{ $offer->image_url }}" alt="{{ $offer->company_name }}">
                                                                </div>
                                                                <div class="right-info">
                                                                    <a class="name-job" href="company-details.html">{{ $offer->company_name }}</a>
                                                                    {{-- <span class="location-small">{{ $offer->location }}</span> --}}
                                                                </div>
                                                            </div>
                                                            <div class="card-block-info">
                                                                <h6><a href="offer-details.html">{{ $offer->destination }}</a>-<a href="offer-details.html">{{ $offer->origin }}</a></h6>
                                                                <div class="mt-5">
                                                                    <span class="card-briefcase">Date limite :</span>
                                                                    <span class="card-time">{{ $offer->limit_date }}<span> jours</span></span>
                                                                </div>
                                                                <p class="font-sm color-text-paragraph mt-15">{{ $offer->description }}</p>
                                                                <div class="mt-30">
                                                                    <a class="btn btn-grey-small mr-5" href="">{{ $offer->weight }} Tonnes</a>
                                                                    <a class="btn btn-grey-small mr-5" href="">{{ $offer->volume }} m3</a>
                                                                </div>
                                                                <div class="card-2-bottom mt-30">
                                                                    <div class="row">
                                                                        {{-- <div class="col-lg-7 col-7">
                                                                            <span class="card-text-price">{{ $offer->price }}</span>
                                                                            <span class="text-muted">FCFA</span>
                                                                        </div> --}}
                                                                        
                                                                          <div class="col-lg-5 col-5 text-end">
                                                                            <div class="btn btn-apply-now" data-bs-toggle="modal" data-bs-target="#ModalApplyJobForm">Postuler</div>
                                                                         
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="paginations">
                                                <!--  pagination  -->
                                                <!-- ... -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-10">
        <div class="section-box">
            <div class="container"> 
                <div class="panel-white pt-30 pb-30 pl-15 pr-15">
                    <div class="box-swiper">
                        <!-- swiper slider  -->
                        <!-- ... -->
                    </div>
                </div>
            </div>
        </div>
    </div>

  {{-- <footer class="footer mt-20">
        <div class="container">
            <div class="box-footer">
                <div class="row">
                    <div class="col-md-6 col-sm-12 mb-25 text-center text-md-start">
                        <p class="font-sm color-text-paragraph-2">© 2022 - <a class="color-brand-2" href="https://themeforest.net/item/jobbox-job-portal-html-bootstrap-5-template/39217891" target="_blank">JobBox </a>Dashboard <span> Made by  </span><a class="color-brand-2" href="http://alithemes.com" target="_blank"> AliThemes</a></p>
                    </div>
                    <div class="col-md-6 col-sm-12 text-center text-md-end mb-25">
                        <ul class="menu-footer">
                            <li><a href="#">About</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Policy</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer> --}} 
</div>

@endsection