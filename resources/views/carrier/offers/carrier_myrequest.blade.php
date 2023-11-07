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
            <h3 class="mb-35">Mes Offres de frets</h3>
        </div>
        <div class="box-breadcrumb">
            <div class="breadcrumbs">
                <ul>
                    <li><a class="icon-home" href="#">Dashboard</a></li>
                    <li><span>Mes Offres de frets</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4" style="background: white; border-radius: 10px;">
    <div class="box-content">
        <div class="row">
            <table class="table table-responsive table-striped table-hover" id="requestTable">
                <thead>
                    <tr>
                        <th scope="col">Numéro</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Description</th>
                        <th scope="col">Statut</th>
                        <th scope="col">Actions</th>
                        <th scope="col">Notification</th>
                        <th scope="col">Messagerie</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($offers->sortByDesc('id') as $key => $offer)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $offer->price }}</td>
                            <td>{{ $offer->description }}</td>
                            <td>
                                @if($offer->status == 0)
                                <button type="button" class="btn btn-primary "> En attente </button>
                                @elseif($offer->status == 1)
                                <button type="button" class="btn btn-success ">  Accepter </button>
                                @else
                                <button type="button" class="btn btn-danger ">Refusé </button>
                                @endif
                            </td>
                            <td>
                                @if($offer->status == 1)
                                <a
                                href="{{ route('c_contract', ['id'=>$offer->id]) }}"
                                class="btn btn-primary">Contrat</a>

                                @endif
                            </td>
                            <td>
                                {{-- Vérifiez la valeur de status_message pour décider d'afficher la notification --}}
                                @if($offer->status == 0)
                                    Aucune notification
                                @elseif($offer->status == 2)
                                    Vous avez un message
                                @elseif($offer->status == 3)
                                    Message lu
                                @endif
                            </td>
                            <td>
                                {{-- Vérifiez si status_message est égal à 2 avant d'afficher le bouton Echanger --}}
                                @if($offer->status_message == 2 || $offer->status_message == 3)
                                <a href="{{ route('shipper-reply-chat', ['offer_id' => $offer->id]) }}" class="btn btn-tag btn-info">Echanger</a>
                            @endif
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
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

@endsection

@section('script')
    <script>
        new DataTable('#requestTable', {
            responsive:true,
            "ordering": false,
            language:{
                "decimal":        "",
                "emptyTable":     "Pas de données disponible",
                "info":           "Affichage _START_ sur _END_ de _TOTAL_ éléments",
                "infoEmpty":      "Affichage 0 sur 0 de 0 entries",
                "infoFiltered":   "(filtrage de _MAX_ total éléments)",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     "Afficher _MENU_ éléments",
                "loadingRecords": "Chargement...",
                "processing":     "",
                "search":         "Recherche:",
                "zeroRecords":    "Pas de correspondance trouvé",
                "paginate": {
                    "first":      "Premier",
                    "last":       "Dernier",
                    "next":       "Suivant",
                    "previous":   "Précédent"
                },
            }
        } );

        $(document).ready(function (){
            var btn_create_contract = $('#btn_create_contract');
            $(btn_create_contract).click( function (){
                alert('test');
                console.log('test')
            })
        });
    </script>

@endsection
