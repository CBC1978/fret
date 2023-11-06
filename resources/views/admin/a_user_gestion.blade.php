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
    <div class="row mb-4">
        <div class="col-md-6">
            <!-- Bouton pour afficher/masquer les champs de recherche et de filtrage -->
            <button class="btn btn-primary" id="toggle-fields">Afficher/Masquer les champs</button>
            <!-- Recherche par nom -->
            <div class="form-group" id="search-group" style="display: none;">
                <label for="search">Rechercher par nom*:</label>
                <input type="text" class="form-control" name="search" id="search" placeholder="Nom d'utilisateur">
            </div>

            <!-- Filtre par statut -->
            <div class="form-group" id="filter-group" style="display: none;">
                <label for="status">Filtrer par statut:</label>
                <select class="form-control" name="status" id="status">
                    <option value="">Tous</option>
                    <option value="0">Email Non Verifié</option>
                    <option value="1">Email Verifié</option>
                    <option value="2">Validé comme Admin</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <!-- Mise à jour groupée des statuts -->
             <div id="bulk-update-group">
                 <form id="bulk-status-form" class="mb-4">
                     <div class="form-group">
                         <select class="form-control" id="bulk-status" name="bulk_status">
                             <option value="0">Email Non Verifié</option>
                             <option value="1">Email Verifié</option>
                             <option value="2">Validé comme Admin</option>
                         </select>
                     </div>
                     <button type="button" class="btn btn-primary" id="bulk-update">Modifier le statut</button>
                 </form>
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
                                 <table class="table table-responsive table-bordered table-hover" id="user-table">
                                     <thead class="thead-dark">
                                         <tr>
                                             <th>ID</th>
                                             <th>Nom</th>
                                             <th>Email</th>
                                             <th>Statut</th>
                                             <th>Cochez</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                    @foreach($users->sortByDesc('id') as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @php
                                                $statusLabel = '';
                                                switch ($user->status) {
                                                    case '0':
                                                        $statusLabel = 'Email Non Verifié';
                                                        break;
                                                    case '1':
                                                        $statusLabel = 'Email Verifié';
                                                        break;
                                                    case '2':
                                                        $statusLabel = 'Validé comme Admin';
                                                        break;
                                                    default:
                                                        $statusLabel = 'Inconnu';
                                                }
                                            @endphp
                                            {{ $statusLabel }}
                                        </td>
                                        <td><input type="checkbox" class="user-checkbox" name="selected_users[]" value="{{ $user->id }}"></td>
                                    </tr>
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
</div>
<script>

            // Autres options de configuration...
        $('#bulk-update').click(function() {
            var selectedStatus = $('#bulk-status').val();
            var selectedUserIds = $('input[name="selected_users[]"]:checked').map(function() {
                return $(this).val();
            }).get();

            if (selectedUserIds.length > 0) {
                $.ajax({
                    method: 'POST',
                    url: '/bulk_update_status',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: selectedStatus,
                        user_ids: selectedUserIds
                    },
                    success: function(response) {
                        // Mettre à jour les statuts affichés dans le tableau
                        updateStatuses(response.updatedStatuses);
                        // Vider les cases à cocher
                        $('input[name="selected_users[]"]:checked').prop('checked', false);

                        //  SweetAlert2 pour afficher un popup de succès
                        Swal.fire({
                            icon: 'success',
                            title: 'Succès',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500 // Temps d'affichage du popup en ms
                        }).then(() => {
                            // Actualiser la page après la fermeture du popup
                            location.reload();
                        });
                    },
                    error: function(response) {
                        // En cas d'erreur, afficher un message d'erreur
                        alert('Une erreur s\'est produite lors de la mise à jour des statuts.');
                    }
                });
            }
        });

        function updateStatuses(updatedStatuses) {
            $.each(updatedStatuses, function(userId, newStatus) {
                var statusContainer = $('.status-container[data-user-id="' + userId + '"]');
                statusContainer.find('.status-label').text(newStatus);
            });
        }

    // Afficher/masquer les champs de recherche et de filtrage
    $('#toggle-fields').click(function() {
        $('#search-group').toggle();
        $('#filter-group').toggle();
    });

    // Fonction pour gérer la recherche en temps réel
    $('#search').keyup(function() {
        var searchText = $(this).val().toLowerCase();
        var selectedStatus = $('#status').val(); // Obtenez la valeur du statut sélectionné
        filterTableByCriteria(searchText, selectedStatus);
    });

    $('#status').change(function() {
        var selectedStatus = $(this).val();
        var searchText = $('#search').val(); // Obtenez la valeur de la recherche
        filterTableByCriteria(searchText, selectedStatus);
    });

    function filterTableByCriteria(username, status) {
    username = username.toLowerCase(); // Convertir le nom en minuscules pour la comparaison

    $('#user-table tbody tr').each(function() {
        var rowUsername = $(this).find('td:eq(1)').text().toLowerCase();
        var rowStatus = $(this).find('td:eq(3)').text().toLowerCase(); // Obtenir le texte du statut

        var matchesUsername = rowUsername.includes(username);
        var matchesStatus = (status === "" || getStatusValue(rowStatus) === status); // Utiliser la fonction getStatusValue

        if (matchesUsername && matchesStatus) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
}

// Fonction pour obtenir la valeur numérique du statut à partir de son libellé
function getStatusValue(statusLabel) {
    switch (statusLabel) {
        case 'Base':
            return '0';
        case 'En cours de validation':
            return '1';
        case 'Validé':
            return '2';
        default:
            return ''; // Retourner une valeur vide par défaut
    }
}

            new DataTable('#user-table', {
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
</script>

@endsection

@section('script')
<script>
    new DataTable('#user-table', {
        responsive:true,
        "ordering": true,
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

</script>
@endsection
