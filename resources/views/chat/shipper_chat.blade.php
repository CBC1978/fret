
@extends('layouts.shipper')
@php
    $userId = session('userId');
@endphp
@section('styles')
<style>
    .chat {
        max-height: 80%;
        overflow-y: scroll;
    }

    .chat-messages {
        display: flex;
        flex-direction: column;
        max-height: 800px;
        overflow-y: scroll;
    }

    .chat-message-left,
    .chat-message-right {
        display: flex;
        flex-shrink: 0;
    }

    .chat-message-left {
        margin-right: auto;
    }

    .chat-message-right {
        flex-direction: row-reverse;
        margin-left: auto;
    }

    .py-3 {
        padding-top: 1rem!important;
        padding-bottom: 1rem!important;
    }

    .px-4 {
        padding-right: 1.5rem!important;
        padding-left: 1.5rem!important;
    }

    .flex-grow-0 {
        flex-grow: 0!important;
    }

    .border-top {
        border-top: 1px solid #dee2e6!important;
    }
</style>
@endsection

@section('content')

<div class="box-content">
    <div class="box-heading">
        <div class="box-title">
            <h3 class="mb-35">Messagerie</h3> 
        </div>
        <div class="box-breadcrumb">
            <div class="breadcrumbs">
                <ul>
                    <li><a class="icon-home" href="index.html">Tableau de bord</a></li>
                    <li><span>Messagerie</span></li>
                </ul>
            </div>
        </div>
    </div>

    

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <h5>{{ session('success') }}</h5>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="card chat">
        <div class="row g-0">
            <div class="col-12 col-lg-12 col-xl-12 col-md-12">
                <div class="py-2 px-4 border-bottom d-flex d-lg-block d-md-block d-sm-block">
                    <div class="card-header">
                        <div class="card-body">
                        <h4>Informations sur l'offre de Transport</h4>
                        <p>Prix de l'offre : {{ $transportOffer->price }} FCFA</p>
                        <p>Expéditeur: {{ $carrier->company_name }}</p>
                        <p><h5> Itinéraire:</h5> {{ $freightAnnouncement->origin.'--'.$freightAnnouncement->destination }}</p>
                        <p class="job-type"> <h5>Date d'expiration:</h5> {{ date("d/m/Y", strtotime($freightAnnouncement->limit_date)) }}</p>
                        
                        </div>
                    </div>
                </div>
                <div class="position-relative">
                    <div class="chat-messages p-4">
                        @foreach($chatMessages as $message)
                        <div class="chat-message-{{ $message->fk_user_id === session('userId') ? 'right' : 'left' }} pb-4">
                            <div>
                                <div>
                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                    <div class="text-muted small text-nowrap mt-2">{{ $message->created_at }}</div>
                                </div>
                                <div class="font-weight-bold mb-1">
                                    @if($message->fk_user_id === session('userId'))
                                        Vous
                                    @else
                                        {{ $message->username }}
                                    @endif
                                </div>
                                <div class="flex-shrink-1 bg-light rounded py-2 px-3">
                                    {{ $message->message }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                    <div class="flex-grow-0 py-3 px-4 border-top">
                        <form action="{{ route('sendMessage', ['offer_id' => $transportOffer->id]) }}" method="post">
                            @csrf
                            <input type="text" class="form-control" placeholder="Entrez votre message" name="message">
                            <button type="submit" class="btn btn-primary">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.alert').delay(4000).fadeOut(400, function() {
            $(this).alert('close');
        });
    });
</script>
@endsection
