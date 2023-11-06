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
    <div class="box-heading mb-35">
        <div class="box-title">
            <h3 class="mb-3"></h3>
        </div>
        <div class="box-breadcrumb">
            <div class="breadcrumbs">
                <ul>
                    <li> <a class="icon-home" href="#">Tableau de bord</a></li>
                    <li><span>Mes annonces</span></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="section-box">
                <div class="container">
                    <div class="panel-white mb-30">
                        <div class="box-padding">
                            <div class="box-filters-job">
                                <div class="row mb-35">
                                    <div class="box-title">
                                        <div class="row">
                                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-10">
                                                <h3>Mes annonces de transport</h3>
                                            </div>
                                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                <input type="text" id="recherche" placeholder="Recherchez une annonce">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="search-results"> </div>
                                <div class="row" id="annoncesContainer">
                                    @foreach($announces as $announce)
                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12" id="card_annonce">
                                            <div class="card-grid-2 hover-up">
                                                <div class="card-grid-2-image-left"><span class="flash"></span>
                                                    <div class="image-box">
                                                        @if($announce['offre'] > 0)
                                                            <a href="{{ route("carrier.announcements.myoffer", ['id'=>$announce['id']]) }}" ><button type="button" class="btn btn-success ">{{$announce['offre']}} Offres</button></a>
                                                        @elseif($announce['offre'] == 0 )
                                                            <button type="button" class="btn btn-danger "> {{$announce['offre']}} Offres </button>
                                                        @endif
                                                    </div>
                                                    <div class="right-info"><a class="name-job{{ request()->routeIs('c_offerdetail') ? 'active' : '' }}"  href="{{ route('c_offerdetail') }}"></a>
                                                    </div>
                                                </div>

                                                <div class="card-block-info">
                                                    <h6><a href="">{{ucfirst($announce['origin'])}}-{{ucfirst($announce['destination'])}}</a></h6>
                                                    <div class="mt-5"><span class="card-briefcase">Date d'expiration:</span><span class="card-time">{{ date("d/m/Y",strtotime($announce['limit_date'])) }}</span></div>
                                                    <p class="font-sm color-text-paragraph mt-15">{{$announce['description']}}</p>
                                                    <div class="mt-30"><a class="btn btn-grey-small mr-5" href="">{{$announce['vehicule_type']}}</a>
                                                        <div class="mt-30"><a class="btn btn-grey-small mr-5" href="">{{$announce['weight']}} T</a><a class="btn btn-grey-small mr-5" href="">{{ $announce['volume'] }} m3</a> </div>
                                                    </div>
                                                    <div class="card-2-bottom mt-30">
                                                        <div class="row">

                                                        </div>
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

    </script -->
    
@endsection
