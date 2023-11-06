@extends('layouts.admin')

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
    <div id="forms-container">
        <div class="row">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <h5>  {{ session('success') }}</h5>
                    <span aria-hidden="true">&times;</span>
            </div>
            @endif
            <div class="col-md-12">
                <h2>Ajouter une entreprise expéditrice</h2>
                <form action="{{ route('admin.ajouter-expediteur') }}" method="post">
                    @csrf
                    <label for="company_name">Nom de l'entreprise<span class="required">*</span></label>
                    <input type="text" name="company_name" required>

                    <label for="address">Adresse<span class="required">*</span></label>
                    <input type="text" name="address" required>

                    <label for="phone">Téléphone<span class="required">*</span></label>
                    <input type="text" name="phone" required>

                    <label for="city">Ville<span class="required">*</span></label>
                    <input type="text" name="city" required>

                    <label for="email">Email<span class="required">*</span></label>
                    <input type="email" name="email" required>

                    <label for="ifu">Numéro IFU<span class="required">*</span></label>
                    <input type="text" name="ifu" required>

                    <label for="rccm">RCCM<span class="required">*</span></label>
                    <input type="text" name="rccm" required>

                    <!-- Champ caché pour stocker l'ID de l'utilisateur -->
                    <input type="hidden" name="user_id" value="{{ Session::get('userId') }}">

                    <button type="submit" class="btn btn-primary" >Ajouter Expéditeur</button>
                </form>
            </div>
        </div>
    </div>

    <form id="assign-user-form" action="{{ route('admin.assigner-entreprise-user') }}" method="post">
        @csrf
        <div class="box-content">
            <div class="row mt-10">
                <div class="col-md-12">
                    <h2>Assigner des entreprises aux utilisateurs</h2>

                        <div class="mb-3">
                            <label for="shipper_id">Assigner une entreprise expéditrice :</label>
                            <select class="form-control" id="shipper_id" name="shipper_id">
                                <option value="">Sélectionner une entreprise expéditrice</option>
                                @foreach ($shippers as $shipper)
                                    <option value="{{ $shipper->id }}">{{ $shipper->company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Assigner Entreprises aux Utilisateurs Sélectionnés</button>
                </div>
            </div>
        </div>
        <div class="row mt-10">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="user-table">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Entreprise</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users->sortByDesc('id') as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->fk_shipper_id)
                                            {{ $shippers->find($user->fk_shipper_id)->company_name }}
                                        @else
                                            Aucune entreprise associée
                                        @endif
                                    </td>
                                    <td>
                                        <input type="checkbox" class="user-checkbox" name="selected_users[]" value="{{ $user->id }}">
                                        <input type="hidden"  id="user_ids[]" value="{{ $user->id }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>
<style>
    .required {
        color: red;         /* couleur étoile */
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

<script>
    // Script pour gérer la soumission du formulaire d'assignation
    $(document).on('submit', '#assign-user-form', function(e) {
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        var formData = form.serialize();

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            success: function(response) {
                // Afficher un pop-up de succès avec SweetAlert2
                Swal.fire({
                    icon: 'success',
                    title: 'Succès',
                    text: "Utilisateur affecté avec succès",
                    showConfirmButton: false,
                    timer: 1500 // Temps d'affichage du popup en ms
                }).then(() => {
                     // Réinitialiser les cases à cocher
                     $('.user-checkbox').prop('checked', false);
                    // Actualiser la page après la fermeture du popup
                    location.reload();
                });
            },
            error: function(xhr) {
                // Afficher un pop-up d'erreur en cas d'échec
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Une erreur s\'est produite. Veuillez réessayer.'
                });
            }
        });
    });
</script>


@endsection
