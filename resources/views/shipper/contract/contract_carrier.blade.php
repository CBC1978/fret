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
                <h3 class="mb-35">Mon contrat de Transport</h3>
            </div>
            <div class="box-breadcrumb">
                <div class="breadcrumbs">
                    <ul>
                        <li><a class="icon-home" href="#">Dashboard</a></li>
                        <li><span>Contrat de transport</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
        <form id="form_contrat" action="{{ route('add-contract-details') }}">
            <input type="hidden" name="contract" id="contract" value="{{ $contract_id }}">
            <div class="card">
                <div class="card-header row">
                    <div class="col-xl-10 col-lg-10 col-md-8 col-sm-6 col-12">
                        Contrat de transport
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-12">
                        <button class="btn btn-primary"  type="submit" id="btn_contrat_save">Enregistrer</button>
                    </div>
                </div>
                <div class="card-body row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 ">
                        D'une part, {{ $contract[0]->shipperName }} sis à {{ $contract[0]->shipperAddress }}, immatriculé sous le RCCM
                        {{$contract[0]->shipperRccm}}
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 ">
                        D'autre part, {{ $contract[0]->carrierName }} sis à {{ $contract[0]->carrierAddress }}, immatriculé sous le RCCM
                        {{$contract[0]->carrierRccm}}

                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-20">
                        Il est convenu  le transport de marchandise sur l'itinéraire  {{ $contract[0]->origin.' - '. $contract[0]->destination }}
                        avec la description suivante {{ $contract[0]->description }}
                    </div>

                </div>
            </div>

                <div class="card mt-20">
                    <div class="card-header">
                        Ajouter les camions concernés
                        <button class="btn" type="button" data-bs-toggle="modal" data-bs-target="#ModalContrat">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                            </svg>
                        </button>

                    </div>
                    <div class="card-body">
                        <div class="row" id="wrapper" >
                            @if(!empty($details))
                                @foreach($details as $detail)
                                    <div class="col-md-12" >
                                        <div class="form-group input-group mb-3">
                                            <span class="input-group-text" id="remove_field">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                </svg>
                                            </span>
                                            <input class="form-control" type="hidden" value="{{ $detail->details_id }}" name="details_id[]" >
                                            <input class="form-control" type="hidden" value="{{ $detail->car_id }}" id="id_car_contract[]" name="id_car_contract[]" >
                                            <input class="form-control" type="text" value="{{ $detail->car_registration}}" id="car_registration" name="car_registration[]"  readonly>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card mt-20">
                    <div class="card-header">
                        Ajouter les conducteurs concernés
                        <button class="btn" type="button"  data-bs-toggle="modal" data-bs-target="#ModalContrat1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row" id="wrapper_driver" >
                            @if(!empty($details))
                                @foreach($details as $detail)
                                    <div class="col-md-12" >
                                        <div class="form-group input-group mb-3">
                                            <span class="input-group-text" id="remove_field_driver">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                </svg>
                                            </span>
                                            <input class="form-control" type="hidden" value="{{ $detail->driver_id }}" id="id_driver_contract" name="id_driver_contract[]" >
                                            <input class="form-control" type="text" value="{{ $detail->licence.' - '.$detail->driver_first.' - '.$detail->driver_last }}" id="driver_registration" name="driver_registration[]"  readonly>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                </div>
            </form>
        </div>

        {{-- Search car--}}
        <div class="modal fade" id="ModalContrat" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content apply-job-form">
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body pl-30 pr-30 pt-50">
                        <div class="text-center mb-10" >
                            <button id="add_car_modal" class=" btn font-sm text-brand-2" data-bs-toggle="modal" data-bs-target="#ModalCar">Ajouter</button>
                        </div>
                        <table class="table table-bordered table-responsive" id="registration_table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>IMMATRICULATION</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cars as $car)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="id_car" id="id_car" value="{{ $car->id_car }}" class="form-check"/>
                                    </td>
                                    <td>
                                        <p id="car_register">  {{ $car->registration }}</p>
                                    </td>
                                        <td>
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                </svg>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <button class="btn btn-primary" id="btn_save_car">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16">
                                  <path d="M11 2H9v3h2V2Z"/>
                                  <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0ZM1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5Zm3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4v4.5ZM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5V15Z"/>
                                </svg>
                            </span>
                            Enregistrer
                        </button>

                    </div>
                </div>
            </div>
        </div>

        {{--Add car--}}
        <div class="modal fade" id="ModalCar" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content apply-job-form">
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body pl-30 pr-30 pt-50">
                        <form action="{{ route('add-car') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="font-sm color-text-muted mb-10">Ajouter un camion<span class="required">*</span></label>
                                        <input class="form-control" type="text" name="registration" placeholder="BF11GH0000" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{--{{-- Search drivers --}}
        <div class="modal fade" id="ModalContrat1" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content apply-job-form">
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body pl-30 pr-30 pt-50">
                        <div class="text-center mb-10" >
                            <button id="add_driver_modal" class=" btn font-sm text-brand-2" data-bs-toggle="modal" data-bs-target="#ModalDriver">Ajouter</button>
                        </div>
                        <table class="table table-bordered table-responsive" id="registration_table_permis">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>PERMIS DE CONDUIRE</th>
                                    <th>Nom</th>
                                    <th>Prénoms</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($drivers as $driver)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="id_driver" id="id_driver" value="{{ $driver->id }}" class="form-check"/>
                                        </td>
                                        <td>
                                            <p id="driver_licence">  {{ $driver->licence }}</p>
                                        </td>
                                        <td>
                                            <p id="driver_first">  {{ $driver->firstName }}</p>
                                        </td>
                                        <td>
                                            <p id="driver_last">  {{ $driver->lastName }}</p>
                                        </td>
                                        <td>
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                </svg>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button class="btn btn-primary" id="btn_save_driver">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16">
                                  <path d="M11 2H9v3h2V2Z"/>
                                  <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0ZM1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5Zm3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4v4.5ZM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5V15Z"/>
                                </svg>
                            </span>
                            Enregistrer
                        </button>
                    </div>
                </div>
            </div>
        </div>


        {{--Add CONDUCTEUR--}}
        <div class="modal fade" id="ModalDriver" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content apply-job-form">
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body pl-30 pr-30 pt-50">
                        <form action="{{ route('add-driver') }}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="font-sm color-text-mutted mb-10">Nom<span class="required">*</span></label>
                                        <input class="form-control" type="text" id="first" name="first" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-sm color-text-mutted mb-10">Prénoms<span class="required">*</span></label>
                                        <input class="form-control" type="text" id="last" name="last" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="font-sm color-text-mutted mb-10">Numéro de permis<span class="required">*</span></label>
                                        <input class="form-control" type="text" id="licence" name="licence" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-sm color-text-mutted mb-10">Date d'établissement</label>
                                        <input class="form-control" type="date" id="date_e" name="date_e">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-sm color-text-mutted mb-10">Lieu d'établissement</label>
                                        <input class="form-control" type="text" id="place" name="place">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            $('#form_contrat').submit( function (e){
                e.preventDefault();
                var formData = new FormData(this);

                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                    .then(data =>{
                        console.log(data);
                    if(data == 0){
                        Swal.fire({
                                icon: 'success',
                                title: 'Bravo',
                                text: 'les camions et les conducteurs sont ajoutés au contrat de transport',
                            }
                        );
                    }
                    if(data ==1){
                        Swal.fire({
                                icon: 'warning',
                                title: 'Oops...',
                                text: 'le nombre de camions est différent du nombre de conducteurs',
                            }
                        );
                    }
                    if(data == 2){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Aucun camion ajouté',
                            }
                        );
                    }
                    });
                });

            //car table
            new DataTable('#registration_table', {
                responsive:true,
                paging:true,
                "ordering": true,
                pageLength: 5,
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
                    "search":         "",

                    "zeroRecords":    "Pas de correspondance trouvé",
                    "paginate": {
                        "first":      "Premier",
                        "last":       "Dernier",
                        "next":       "Suivant",
                        "previous":   "Précédent"
                    },
                }
            } );

            //driver table
            new DataTable('#registration_table_permis', {
                responsive:true,
                paging:true,
                "ordering": true,
                pageLength: 5,
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
                    "search":         "",

                    "zeroRecords":    "Pas de correspondance trouvé",
                    "paginate": {
                        "first":      "Premier",
                        "last":       "Dernier",
                        "next":       "Suivant",
                        "previous":   "Précédent"
                    },
                }
            } );
            //end driver table

            // $("#btn_car_add").hide();
            var wrapper  = $("#wrapper"); //Fields wrapper

            var btn_car_modal = $("#add_car_modal");
            $(btn_car_modal).click(function (e){
                $("#ModalContrat").modal('hide');
            });

            //Add car to database
            $("#ModalCar form").submit(function(e) {
                e.preventDefault();
                // Récupérer les données du formulaire
                var formData = new FormData(this);
                // Envoyer les données au serveur en utilisant AJAX
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    var newRow = `
                    <div class="col-md-12">
                        <div class="form-group input-group mb-3">
                            <span class="input-group-text" id="remove_field">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                </svg>
                            </span>
                            <input class="form-control" type="hidden" value="${data.id_car}" id="id_car_contract" name="id_car_contract[]">
                            <input class="form-control" type="text" value="${data.registration}" id="car_registration" name="car_registration[]" required readonly>
                        </div>
                    </div>
                    `;
                    $("#wrapper").append(newRow); // Ajoute la nouvelle ligne à l'élément avec l'ID "wrapper"
                });
                //     .catch(error => {
                //         console.error('Error:', error);
                //     });
                $('#ModalCar').modal('hide'); // Ferme la modal "Modalcar"
            });
            var data = []
            var btn_save_car = $("#btn_save_car");

            $(btn_save_car).click(function (){
                data = [];
                var checkedBoxes = document.querySelectorAll('input[name=id_car]');
                var id_registration = document.querySelectorAll('#car_register');

                for(i =0; i < checkedBoxes.length; i++){
                    if(checkedBoxes[i].checked){
                        data.push({
                            id:checkedBoxes[i].value,
                            registration:id_registration[i].innerText,
                        })
                    }
                }
                data.forEach(item => {
                    $(wrapper).append(
                        `
                     <div class="col-md-12" >
                        <div class="form-group input-group mb-3">
                            <span class="input-group-text" id="remove_field">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                </svg>
                            </span>
                            <input class="form-control" type="hidden" value="${item.id}" id="id_car_contract" name="id_car_contract[]" >
                            <input class="form-control" type="text" value="${item.registration}" id="car_registration" name="car_registration[]" required readonly>
                        </div>
                    </div>
                    `
                    ); //add input box
                    checkedBoxes.forEach(check=>{
                        if(check.checked){
                            check.checked = false;
                        }
                    });
                });
                // $("#btn_car_add").show();
                $('#ModalContrat').modal('hide');
            });
            $(wrapper).on("click","#remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').remove();
            });

            var wrapper_driver = $("#wrapper_driver");
            var btn_driver_modal = $("#add_driver_modal");
            $(btn_driver_modal).click(function (e){
                $("#ModalContrat1").modal('hide');
            });

            //Add driver to database
            $("#ModalDriver form").submit(function(e) {
                e.preventDefault();
                // Récupérer les données du formulaire
                var formData = new FormData(this);
                // Envoyer les données au serveur en utilisant AJAX
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    var name = data.licence +' '+ data.first_name +' '+ data.last_name;
                    var newRow = `
                    <div class="col-md-12">
                        <div class="form-group input-group mb-3">
                            <span class="input-group-text" id="remove_field_driver">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                </svg>
                            </span>
                            <input class="form-control" type="hidden" value="${data.id}" id="id_driver_contract" name="id_driver_contract[]">
                            <input class="form-control" type="text" value="${name}" id="driver_registration" name="driver_registration[]" readonly>
                        </div>
                    </div>
                    `;
                        $(wrapper_driver).append(newRow); // Ajoute la nouvelle ligne à l'élément avec l'ID "wrapper"
                    });


                $('#ModalDriver').modal('hide'); // Ferme la modal "Modalcar"
            });

            var dataDriver = []
            var btn_save_driver = $("#btn_save_driver");


            $(btn_save_driver).click(function () {
                dataDriver = [];
                var checkedBoxes = document.querySelectorAll('input[name=id_driver]');
                var licence = document.querySelectorAll('#driver_licence');
                var first = document.querySelectorAll('#driver_first');
                var last = document.querySelectorAll('#driver_last');

                for (i = 0; i < checkedBoxes.length; i++) {
                    if (checkedBoxes[i].checked) {
                       var name = licence[i];
                           +' '+first[i]+' '+last[i];
                        dataDriver.push({
                            id: checkedBoxes[i].value,
                            registration: name.innerText,
                        })
                    }
                }
                dataDriver.forEach(item => {
                    $(wrapper_driver).append(
                        `
                             <div class="col-md-12" >
                                <div class="form-group input-group mb-3">
                                    <span class="input-group-text" id="remove_field_driver">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                          <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                        </svg>
                                    </span>
                                    <input class="form-control" type="hidden" value="${item.id}" id="id_driver_contract" name="id_driver_contract[]" >
                                    <input class="form-control" type="text" value="${item.registration}" id="driver_registration" name="driver_registration[]"  readonly>
                                </div>
                            </div>
                            `
                    ); //add input box
                });
                checkedBoxes.forEach(check=>{
                    if(check.checked){
                        check.checked = false;
                    }
                });
                // $("#btn_dr_add").show();
                $('#ModalContrat1').modal('hide');
            });

            $(wrapper_driver).on("click","#remove_field_driver", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').remove();
            });
    });
    </script>

@endsection
