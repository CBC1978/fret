@extends('layouts.shipper')

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
            <h3 class="mb-35">Offres de Transport</h3>
        </div>
        <div class="box-breadcrumb">
            <div class="breadcrumbs">
                <ul>
                    <li><a class="icon-home" href="index.html">Dashboard</a></li>
                    <li><span>Mes offres de Transport</span></li>
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
                            
                                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                <input type="text" id="recherche" placeholder="Recherchez une annonce">
                                            </div>
                                          <div id="search-results"> </div>
                                            <div class="row" id="annoncesContainer">
                                                @foreach($announcements as $announce)
                                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
                                                        <div class="card-grid-2 hover-up">
                                                            <div class="card-grid-2-image-left"><span class="flash"></span>
                                                                <div class="image-box"><img src="" alt=""></div>
                                                                <div class="right-info"><a class="name-job" href="{{ route('shipper.announcements.show', ['id' => $announce->id]) }}">{{ $announce->company_name }}</a>
                                                                    {{-- <span class="location-small">New York, US</span> --}}
                                                                </div>
                                                            </div>
                                                            <div class="card-block-info">
                                                                <h6><a href="">{{ucfirst($announce->origin)}}-{{ucfirst($announce->destination)}}</a></h6>
                                                                <div class="mt-5"><span class="card-briefcase">Date d'expiration:</span><span class="card-time">{{ date("d/m/Y",strtotime($announce->limit_date)) }}</span></div>
                                                                <p class="font-sm color-text-paragraph mt-15">{{$announce->description}}</p>
                                                                <div class="mt-30"><a class="btn btn-grey-small mr-5" href="">{{$announce->vehicule_type}}</a></div>
                                                                <div class="mt-30"><a class="btn btn-grey-small mr-5" href="">{{$announce->weight}} T</a> </div>
                                                                <div class="card-2-bottom mt-30">
                                                                    <div class="row">
                                                                        <div class="col-lg-5 col-5 text-end">
                                                                        @if(Session::get('fk_carrier_id') != 0)
                                                                            <div class="btn btn-apply-now" data-bs-toggle="modal" data-bs-target="#ModalApplyJobForm{{$announce->id}}">Postuler</div>  
                                                                        @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal fade" id="ModalApplyJobForm{{$announce->id}}" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content apply-job-form">
                                                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                <div class="modal-body pl-30 pr-30 pt-50">
                                                                    <div class="text-center">
                                                                        <p class="font-sm text-brand-2">POSTULER A L'Offre </p>
                                                                        @if(session('success'))
                                                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                                            
                                                                                <h5>  {{ session('success') }}</h5>
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </div>
                                                                        @endif
                                                                        <h2 class="mt-10 mb-5 text-brand-1 text-capitalize">Faites une proposition</h2>
                                                                        <p class="font-sm text-muted mb-30">Entrer les des information clair et valide pour multiplier vos chances</p>
                                                                    </div>

                                                                    <form class="login-register text-start mt-20 pb-30" action="{{ route('shipper.announcements.postuler') }}"  method="post" id="formPostuler">
                                                                        @csrf
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="price">Prix <span class="required">*</span><span>(En FCFA)</span></label>
                                                                            <input class="form-control" type="number" name="price" id="price" placeholder="votre meilleur offre">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="price">Poids<span class="required">*</span><span>(En Tonne)</span></label>
                                                                            <input class="form-control" type="number" name="weight" id="weight" placeholder="Le poids approximatif">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="description">Description <span class="required">*</span></label>
                                                                            <input class="form-control" id="description" type="text" required="" name="description" placeholder="description...">
                                                                            <input class="form-control" id="idUser" name="idUser" value="{{session('userId') }}" type="hidden">
                                                                            <input class="form-control" id="announce" name="announce" value="{{ $announce->id }}" type="hidden">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <button class="btn btn-default hover-up w-100" type="submit" name="login">ENVOYER</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
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

    <!-- Swiper slider section -->
    <div class="mt-10">
        <div class="section-box">
            <div class="container">
                <div class="panel-white pt-30 pb-30 pl-15 pr-15">
                    <div class="box-swiper">
                        <!-- Swiper slider content -->
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
        <style>
            .required {
                color: red;
                margin-left: 4px; /* Espacement entre le texte et l'étoile */
            }

        </style>
    </footer> --}}
</div>
    <script>
        $(document).ready(function() {
            
            $('.alert').delay(2000).fadeOut(400, function() {
                $(this).alert('close');
            });
        });
    </script>
@endsection
@section('script')



<script>
             
             $(document).ready(function () {
          setTimeout(function () {
              $("div.alert").remove();
          }, 3000); //3s

          var searchInput = document.querySelector('input[id^="recherche"]');
          $(searchInput).keyup(function () {
              var filter, allAnnonces;

              filter = searchInput.value.toUpperCase();
              allAnnonces = document.querySelectorAll('#card_annonce');
              allAnnonces.forEach(item => {
                  itemValue = item.innerText;
                  console.log(item);
                  if (itemValue.toUpperCase().indexOf(filter) > -1) {
                      item.style.display = 'flex';
                  } else {
                      item.style.display = 'none';
                  }
              });
          });
      });

    </script>

    <!--script>

        $(document).ready(function () {
            var annoncesContainer = $('#annoncesContainer');

            var searchInput = document.querySelector('input[id^="recherche"]');
            $(searchInput).keyup(function () {
                var filter = searchInput.value.toUpperCase();

                // Réinitialiser les résultats de la recherche
                $('#search-results').empty();

                annoncesContainer.find('.card-block-info').each(function () {
                    var itemValue = $(this).text().toUpperCase();

                    if (itemValue.indexOf(filter) > -1) {
                        // Ajouter l'annonce correspondante aux résultats de la recherche
                        $('#search-results').append($(this).parent().clone());
                    }
                });
            });
        });

    </script-->



@endsection

