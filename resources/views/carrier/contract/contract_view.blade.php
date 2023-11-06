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
                <div class="card">
                    <div class="card-header row">
                        <div class="col-xl-10 col-lg-10 col-md-8 col-sm-6 col-12">
                            Contrat de transport
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-12">
                            <a href="{{ route('print-contract',[$contract_id]) }}" target="_blank"> <button class="btn btn-primary">Imprimer</button> </a>
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
                        Camions concernés
                    </div>
                    <div class="card-body">
                        <div class="row" id="wrapper" >
                            @if(!empty($details))
                                @foreach($details as $detail)
                                    <div class="col-md-12" >
                                        <div class="form-group input-group mb-3">

                                            <input class="form-control" type="text" value="{{ $detail->car_registration}}" id="driver_registration" name="driver_registration[]"  readonly>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            @if(count($details) == 0)
                                <div class="col-md-12" >
                                    <div class="form-group input-group mb-3">
                                        <input class="form-control" type="text" value="Aucun camions ajouté"   readonly>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card mt-20">
                    <div class="card-header">
                       Conducteurs concernés
                    </div>
                    <div class="card-body">
                        <div class="row" id="wrapper_driver" >
                            @if(!empty($details))
                                @foreach($details as $detail)
                                    <div class="col-md-12" >
                                        <div class="form-group input-group mb-3">
                                            <input class="form-control" type="text" value="{{ $detail->licence.' - '.$detail->driver_first.' - '.$detail->driver_last }}" id="driver_registration" name="driver_registration[]"  readonly>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            @if(count($details) == 0)
                                <div class="col-md-12" >
                                    <div class="form-group input-group mb-3">
                                        <input class="form-control" type="text" value="Aucun conducteur ajouté"   readonly>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
        </div>
@endsection
