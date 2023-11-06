@extends('layouts.admin')

@section('content')
<script>
  function returnToPreviousPage() {
  window.history.back(); // Revenir à la page précédente
}
</script>
<button type="submit" onclick="returnToPreviousPage()">Retour</button>
    <div class="container1">
        <h1>Annonces de Fret</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="col-md-6">
             <!-- Bouton pour afficher/masquer les champs de recherche et de filtrage -->
             <button class="btn btn-primary" id="toggle-fields">Afficher/Masquer les champs</button>
            <!-- Recherche par nom -->
            <div class="form-group" id="search-group" style="display: none;">
                <label for="search">Rechercher par ID:</label>
                <input type="text" class="form-control" name="search" id="search" placeholder="ID de l'utilisateur">
            </div>
            <div class="form-group" id="filter-group" style="display: none;">
                <!-- Formulaire de filtrage par status -->
            <form action="{{ route('annonces.filter') }}" method="post" >
                @csrf
                @method('PUT')

                <label for="status">Filtrer par statut:</label>
                <select class="form-control" name="status" id="status">
                    <option value="1">Activé</option>
                    <option value="0">Desactivé</option>
                </select>
                <button type="submit">Filtrer</button>
            </form>
            </div>
            
        </div>
        
        <!-- Tableau des annonces -->
        <div class="container1">
        <table>
        <h3>La liste des annonces des Chargeurs</h3>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Entreprise</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($chargeurAnnonces as $annonce)
                    <tr>
                        <td>{{ $annonce->id }}</td>
                        <td>
                            @if ($annonce->fk_shipper_id)
                                {{ $annonce->shipper->company_name }}
                            @else
                                Aucune entreprise associée
                            @endif
                        </td>
                        <td>Chargeur</td>
                        <td>{{ $annonce->description }}</td>
                        <td>
                            @if ($annonce->status == 1) 
                                Actif
                            @else
                                Desactivé
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('annonces.updateFreight', $annonce->id) }}">Mettre à jour</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        
        <div class="container1 mt-2">
        <table>
        <h3>La liste des annonces des Transporteurs</h3>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Entreprise</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
               
                @foreach($transporteurAnnonces as $annonce)
                    <tr>
                        <td>{{ $annonce->id }}</td>
                        <td>
                            @if ($annonce->fk_carrier_id)
                                {{ $annonce->carrier->company_name }}
                            @else
                                Aucune entreprise associée
                            @endif
                        </td>
                        <td>Transporteur</td>
                        <td>{{ $annonce->description }}</td>
                        <td>
                            @if ($annonce->status == 1) 
                                Actif
                            @else
                                Desactivé
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('annonces.updateTransport', $annonce->id) }}">Mettre à jour</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        
    </div>

    <script>
        // Afficher/masquer les champs de recherche et de filtrage
        $('#toggle-fields').click(function() {
            $('#search-group').toggle();
            $('#filter-group').toggle();
        });

        // Récupérer l'élément d'entrée de recherche
        const searchInput = document.getElementById('search');

        // Ajouter un gestionnaire d'événement pour la saisie dans l'entrée de recherche
        searchInput.addEventListener('input', function () {
            const searchID = parseInt(searchInput.value); // ID saisi en tant que nombre
            
            // Parcourir toutes les lignes du tableau et les cacher ou afficher en fonction de la recherche
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const idCell = row.querySelector('td:first-child'); // Cellule de l'ID
                const rowID = parseInt(idCell.textContent); // ID de la ligne en tant que nombre
                
                // Vérifier si l'ID de la ligne correspond à l'ID saisi
                if (isNaN(searchID) || rowID === searchID) {
                    row.style.display = ''; // Afficher la ligne
                } else {
                    row.style.display = 'none'; // Cacher la ligne
                }
            });
        });

    </script>

    <script>
            $(document).ready(function (){
                setTimeout(function(){
                    $("div.alert").remove();
                }, 3000 ); //3s

            });
        </script>

    <style>

    body {
        font-family: Arial, sans-serif;
    }

    .container1 {
        margin: 20px;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f5f5f5;
    }

    #toggle-fields {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-control {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 3px;
        box-sizing: border-box;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    table, th, td {
        border: 1px solid #ddd;
    }

    th, td {
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

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


    .alert-success {
        background-color: #dff0d8;
        color: #3c763d;
        border: 1px solid #d6e9c6;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 15px;
    }

    .mt-2 {
        margin-top: 20px;
    }

    </style>
    
@endsection
