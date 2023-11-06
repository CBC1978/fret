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
                <h3 class="mb-35">Mes contrats de transports</h3>
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
                        <li> <a class="icon-home" href="">Contrat</a></li>
                        <li><span>mes contrats </span></li>
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
                                <table class="table table-responsive table-striped table-hover" id="contract_table">
                                    <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">description</th>
                                        <th scope="col">Itinéraire</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach($contracts as $contract)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $contract->company_name }}</td>
                                            <td>{{ $contract->description }}</td>
                                            <td>{{ $contract->origin.' - '.$contract->destination }}</td>
                                            <td>
                                                <a href="{{ route('c_contract_view',[$contract->id]) }}"><button class="btn btn-outline-primary" type="button"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                                <a href="{{ route('c_contract',[ $contract->id]) }}"> <button class="btn btn-outline-success" type="button"><i class="fa fa-pencil-square-o"></i></button></a>
{{--                                                <a href=""><button class="btn btn-outline-danger" type="button"><i class="fa fa-trash-o"></i></button></a>--}}
                                            </td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                    @foreach($contractsFromShipper as $contract)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $contract->company_name }}</td>
                                            <td>{{ $contract->description }}</td>
                                            <td>{{ $contract->origin.' - '.$contract->destination }}</td>
                                            <td>
                                                <a href="{{ route('c_contract_view',[$contract->id]) }}"><button class="btn btn-outline-primary" type="button"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                                <a href="{{ route('c_contract',[$contract->id]) }}"> <button class="btn btn-outline-success" type="button"><i class="fa fa-pencil-square-o"></i></button></a>
{{--                                                <a href=""><button class="btn btn-outline-danger" type="button"><i class="fa fa-trash-o"></i></button></a>--}}

                                            </td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                    </tbody>
                                </table>
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
        $(document).ready(function (){
            new DataTable('#contract_table', {
                responsive:true,
                "ordering": false,
                buttons: [
                    'modifier',
                ],
                language:{
                    "decimal":        "",
                    "emptyTable":     "Pas de données disponible",
                    "info":           "Afficher _START_ sur _END_ de _TOTAL_ éléments",
                    "infoEmpty":      "Afficher 0 sur 0 de 0 entries",
                    "infoFiltered":   "(filtrer de _MAX_ total éléments)",
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
        });
        $('.alert').delay(2000).fadeOut(400, function() {
            $(this).alert('close');
        });

    </script>

@endsection
