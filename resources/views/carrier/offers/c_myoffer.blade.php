@extends('layouts.carrier')

@section('content')
<style>
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
<script>
function returnToPreviousPage() {
window.history.back(); // Revenir à la page précédente
}
</script>
<button type="submit" onclick="returnToPreviousPage()">Retour</button>
<div class="box-content">
    <div class="box-heading">
        <div class="box-title">
            <h3 class="mb-35">mes offres de fret</h3>
            @if(session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <h5>  {{ session('success') }}</h5>
                <span aria-hidden="true">&times;</span>
              </div>
            @endif
        </div>
        <div class="box-breadcrumb">
            <div class="breadcrumbs">
                <ul>
                    <li> <a class="icon-home" href="">OFFRE</a></li>
                    <li><span>mes offres </span></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card-style-2 hover-up">
                <div class="card-head">
                    <div class="card-image"> <img src="{{asset('assets/imgs/page/dashboard/img1.png')}}" alt="jobBox"></div>
                    <div class="card-title">
                      <h5> Itinéraire: {{ $transportAnnouncement->origin.'--'.$transportAnnouncement->destination }}</h5>
                      <span class="job-type">Date d'expiration: {{ date("d/m/Y", strtotime($transportAnnouncement->limit_date)) }}</span>
                      <p>Description:{{ $transportAnnouncement->description }}</p>
                  </div>
              </div>
              <div class="card-price"><strong>{{ $transportAnnouncement->price }} F CFA</strong><span class="hour">/T</span></div>
          </div>
        </div>
    </div>
 <div class="row">
  <div class="col-lg-12">
    <div class="section-box">
      <div class="container">
        <div class="panel-white mb-30">
          <div class="box-padding">
            <div class="row display-list">
                @foreach($freightOffers as $freightOffer)
                    <div class="col-lg-6">
                        <div class="card-style-2 hover-up">
                            <div class="card-head">
                                <div class="card-image"> <img src="{{asset('assets/imgs/page/dashboard/img1.png')}}" alt="jobBox"></div>
                                <div class="card-title">
                                    <h6>{{ $freightOffer->description }}</h6><span class="location">{{ $freightOffer->company_name }}</span>
                                </div>
                            </div>
                            <form action="{{ route('carrier.announcements.offer.manage', ['id' => $freightOffer->id]) }}" method="POST">
                              @csrf

                              <input type="hidden" name="action" value="accept">
                              <input type="hidden" name="offer" value="{{ $freightOffer->id }}">
                              <button type="submit" class="btn btn-tag btn-success">Accepter</button>
                          </form>

                          <form action="{{ route('carrier.announcements.offer.manage', ['id' => $freightOffer->id]) }}" method="POST">
                              @csrf

                              <input type="hidden" name="action" value="refuse">
                              <button type="submit" class="btn btn-tag btn-danger">Refuser</button>
                          </form>

                          <div class="card-tags"> <a href="{{ route('carrier-chat', ['offer_id' => $freightOffer->id]) }}" class="btn btn-tag btn-info">Echanger</a> </div>

                            <div class="card-price"><strong>{{$freightOffer->price}} FCFA</strong><span class="hour"></span></div>
                        </div>
                    </div>

                    @endforeach
            </div>
            <div class="paginations">

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>




  
{{--  <footer class="footer mt-20">
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
</div></div>
  <script>
      $(document).ready(function() {

          $('.alert').delay(2000).fadeOut(400, function() {
              $(this).alert('close');
          });
      });
  </script>

@endsection
