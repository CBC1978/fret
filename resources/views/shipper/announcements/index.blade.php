@extends('layouts.carrier')

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
<div class="box-heading mb-25">
    <div class="box-title">
        <h3 class="mb-35"></h3>
    </div>
    <div class="box-breadcrumb">
        <div class="breadcrumbs">
            <ul>
                <li> <a class="icon-home" href="">Tableau de bord</a></li>
                <li><span>Annonces</span></li>
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
                                            <h3>Annonces de fret</h3>
                                        </div>
                                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                            <input type="text" id="recherche" placeholder="Recherchez une annonce">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="search-results"> </div>
                            <div class="row" id="annoncesContainer">
                                @foreach($announcements as $announce)
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12" id="card_annonce">
                                        <div class="card-grid-2 hover-up">
                                            <div class="card-grid-2-image-left"><span class="flash"></span>
                                                <div class="image-box"><img src=" {{ asset('imgs/brands/brand-1.png') }}" alt="jobBox"></div>
                                                <div class="right-info"><a class="name-job" href="{{ route('carrier.announcements.show', ['id' => $announce->id]) }}">{{ $announce->company_name }}</a>
                                                    {{-- <span class="location-small">New York, US</span> --}}
                                                </div>
                                            </div>
                                            <div class="card-block-info">
                                                <h6><a href="">{{ucfirst($announce->origin)}}-{{ucfirst($announce->destination)}}</a></h6>
                                                <div class="mt-5"><span class="card-briefcase">Date d'expiration:</span><span class="card-time">{{ date("d/m/Y",strtotime($announce->limit_date)) }}</span></div>
                                                <p class="font-sm color-text-paragraph mt-15">{{$announce->description}}</p>
                                                <div class="mt-30"><a class="btn btn-grey-small mr-5" href="">{{$announce->weight}} T</a><a class="btn btn-grey-small mr-5" href="">{{ $announce->volume }} m3</a></div>
                                                <div class="card-2-bottom mt-30">
                                                    <div class="row">
                                                       <div class="col-lg-7 col-7"><span class="card-text-price">{{ $announce->price }}FCFA</span><span class="text-muted"></span></div>
                                                        <div class="col-lg-5 col-5 text-end">
                                                            @if(Session::get('fk_shipper_id') != 0)
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
                                                        <p class="font-sm text-brand-2">POSTULER A L'ANNONCE </p>
                                                        <h2 class="mt-10 mb-5 text-brand-1 text-capitalize">Faites une proposition</h2>
                                                        <p class="font-sm text-muted mb-30">Entrer les des information clair et valide pour multiplier vos chances</p>
                                                    </div>

                                                    <form class="login-register text-start mt-20 pb-30" action="{{ route('carrier.announcements.postuler') }}"  method="post" id="formPostuler">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label class="form-label" for="price">Prix <span class="required">*</span><span>(En FCFA)</span></label>
                                                            <input class="form-control" type="number" name="price" id="price" placeholder="votre meilleur offre">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-label" for="price">Poids <span class="required">*</span><span>(En Tonne)</span></label>
                                                            <input class="form-control" type="number" name="weight" id="weight" placeholder="Le poids approximatif">
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="form-label" for="description">Description<span class="required">*</span></label>
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
<style>
    .required {
        color: red;
        margin-left: 4px; /* Espacement entre le texte et l'étoile */
    }

</style>

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

    </script>


    <script>
        var searchInput = document.querySelector('input[id^="recherche"]');
        $(searchInput).keyup(function (){
            var filter, allAnnonces;

            filter = searchInput.value.toUpperCase();
            allAnnonces = document.querySelectorAll('#card_annonce');
            allAnnonces.forEach( item =>{
                itemValue = item.innerText;
                console.log(item);
                if(itemValue.toUpperCase().indexOf(filter) > -1){
                    item.style.display = 'flex';
                }else{
                    item.style.display = 'none';
                }
            });
        });
    </script  -->

@endsection
