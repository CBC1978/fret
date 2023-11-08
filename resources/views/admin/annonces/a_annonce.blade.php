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

        <!--div class="col-md-6">
            
             <button class="btn btn-primary" id="toggle-fields">Barre de Recherche</button>
           
            <div class="form-group" id="search-group" style="display: none;">
                <label for="search">Rechercher par ID:</label>
                <input type="text" class="form-control" name="search" id="search" placeholder="ID de l'utilisateur">
            </div>
            <div class="form-group" id="filter-group" style="display: none;">
                
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
            
        </div-->
        
        <!-- Tableau des annonces -->
        <div class="container1">
        <table class="table table-responsive" id="requestTable">
        <h3>La liste des annonces des Chargeurs</h3>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Entreprise</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>nombre d'offre(s)</th>
                    <!--th>status</th-->
                    <th>Détail sur l'offre</th>
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
                            @if($annonce->transportOffer->count() > 0)
                                {{ $annonce->transportOffer->count() }} Offre(s)
                            @else
                                Aucune offre
                            @endif
                        </td>
                        <!--td>
                            @if ($annonce->status == 1) 
                                Actif
                            @else
                                Desactivé
                            @endif
                        </td-->
                        <td>
                            <div class="annonce">
                                <div class="annonceContent" style="display:none;">
                                    <!-- Détails pour cette annonce spécifique -->
                                    @if($annonce->transportOffer->count() > 0)
                                        <ul>
                                            @foreach($annonce->transportOffer as $offre)
                                                <li>
                                                    <p>Détails de l'Offre</p>
                                                    <p>Description de l'annonce : {{ $annonce->description }}</p>
                                                    <p>Date d'expiration : {{ $annonce->limit_date }}</p>
                                                    <strong>transporteur :</strong> {{ $offre->carrier->company_name}}</br>
                                                    <strong>Prix :</strong> {{ $offre->price }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>Aucune offre de transit pour cette annonce.</p>
                                    @endif
                                </div>

                                <button class="voir-offre small" data-offre-id="{{ $annonce->id }}" onclick="toggleContent(this)">Voir plus...</button>
                            </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
      </div>
    </div>

    <script>

        function toggleContent(bouton) {
            var contenu = bouton.parentNode.querySelector(".annonceContent");
            if (contenu.style.display === "none") {
                contenu.style.display = "block";
            } else {
                contenu.style.display = "none";
            }
        }
        
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
 
        // Afficher/masquer les champs de recherche et de filtrage
        $('#toggle-fields').click(function() {
            $('#search-group').toggle();
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
        .small {
            font-size: 10px; /* Taille de la police */
            padding: 5px 5px 5px 5px; /* Espacement intérieur du bouton */
        }

    @media (max-width: 768px) {
        .container1 {
                    overflow-x: auto;
                }
                table {
                    min-width: 100%;
        }
    }

    body {
        font-family: Arial, sans-serif;
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