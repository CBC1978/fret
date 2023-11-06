@extends('layouts.shipper')

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
            <h3 class="mb-35">Ajouter une Annonce de Fret</h3>
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
                    <li><a class="icon-home" >Annonce de Fret</a></li>
                    <li><span>Ajouter une Annonce de Fret</span></li>
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
                                        <div class="box-padding bg-postjob">
                                            <div class="row mt-30">
                                                <div class="col-lg-9">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <h5 class="">Fait une Annonce de Fret</h5>
                                                            <form method="POST" action="{{ route('shipper.announcements.store') }}">
                                                                @csrf

                                                                <input type="hidden" name="user_id" value="{{ session('userId') }}">
                                                                <input type="hidden" name="fk_carrier_id" value="{{ session('fk_shipper_id') }}">


                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group mb-30">
                                                                            <label for="origin">Lieu de départ</label>
                                                                            <select id="origin" class="form-control @error('origin') is-invalid @enderror" name="origin" required>
                                                                                <option value="" disabled selected>Sélectionnez un lieu</option>
                                                                                @foreach($villes as $ville)
                                                                                    <option value="{{ $ville->libelle }}">{{ $ville->libelle }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('origin')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group mb-30">
                                                                            <label for="destination">Lieu de destination</label>
                                                                            <select id="destination" class="form-control @error('destination') is-invalid @enderror" name="destination" required>
                                                                                <option value="" disabled selected>Sélectionnez un lieu</option>
                                                                                @foreach($villes as $ville)
                                                                                    <option value="{{ $ville->libelle }}">{{ $ville->libelle }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('destination')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group mb-30">
                                                                            <label for="limit_date">Date limite<span class="required">*</span></label>
                                                                            <input type="date" id="limit_date" class="form-control @error('limit_date') is-invalid @enderror" name="limit_date" value="{{ old('limit_date') }}" required>
                                                                            @error('limit_date')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group mb-30">
                                                                            <label for="weight">Poids<span class="required">*</span><span >(Tonnes)</span></label>
                                                                            <input type="text" placeholder="En tonnes" id="weight" class="form-control @error('weight') is-invalid @enderror" name="weight" value="{{ old('weight') }}">
                                                                            @error('weight')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group mb-30">
                                                                            <label for="volume">Volume <span>(m3)</span></label>
                                                                            <input type="text" id="volume" placeholder="metre cube" class="form-control @error('volume') is-invalid @enderror" name="volume" value="{{ old('volume') }}">
                                                                            @error('volume')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group mb-30">
                                                                            <label for="price">Prix<span class="required">*</span> <span>(FCFA)</span></label>
                                                                            <input type="text" id="price" placeholder="en FCFA " class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}">
                                                                            @error('price')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="description">Description<span class="required">*</span></label>
                                                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required>{{ old('description') }}</textarea>
                                                                    @error('description')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>

                                                                <div class="form-group">
                                                                    <button type="submit" class="btn btn-primary">Ajouter l'annonce</button>
                                                                </div>

                                                            </form>
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


<script>
    $(document).ready(function() {

        $('.alert').delay(2000).fadeOut(400, function() {
            $(this).alert('close');
        });
    });
</script>

{{-- <script>

    $(document).on('submit', '#announcement-form', function(e) {
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        var formData = form.serialize();

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            success: function(response) {
                if (response.success) {

                    Swal.fire({
                        icon: 'success',
                        title: 'Succès',
                        text: 'L\'annonce a été ajoutée avec succès.',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {

                        form[0].reset();
                    });
                } else {

                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur de validation',
                        html: response.errors.join('<br>'),
                    });
                }
            },
            error: function(xhr) {

                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Une erreur s\'est produite. Veuillez réessayer.'
                });
            }
        });
    });
</script> --}}

@endsection
