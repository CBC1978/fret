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

        
        <!-- Tableau des annonces -->
       
        
        <div class="container1 mt-2">
        <table class="table table-responsive" id="requestTable">
        <h3>La liste des annonces des Transporteurs</h3>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Entreprise</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Nombre D'offre(s)</th>
                    <!--th>status</th-->
                    <th>Détail sur l'offre</th>
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
                        
                            @if($annonce->freightOffers->count() > 0)
                                {{ $annonce->freightOffers->count() }} Offre(s)
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
                                    @if($annonce->freightOffers->count() > 0)
                                        <ul>
                                            @foreach($annonce->freightOffers as $offre)
                                                <li>
                                                    <p>Details Offre</p>
                                                    <p>Description de l'annonce : {{ $annonce->description }}</p>
                                                    <p>Date d'expiration : {{ $annonce->limit_date }}</p>
                                                    <strong>Shipper :</strong> {{ $offre->shipper->company_name}}</br>
                                                    <strong>Prix :</strong> {{ $offre->price }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>Aucune offre de transport pour cette annonce.</p>
                                    @endif
                                </div>

                                <button class="voir-offre small" data-offre-id="{{ $annonce->id }}" onclick="toggleContent(this)">Voir plus...</button>
                            </div>

                            <style>
                                .small {
                                    font-size: 10px; /* Taille de la police */
                                    padding: 5px 5px ; /* Espacement intérieur du bouton */
                                }
                            </style>

                                
                            <script>
                            function toggleContent(bouton) {
                                var contenu = bouton.parentNode.querySelector(".annonceContent");
                                if (contenu.style.display === "none") {
                                    contenu.style.display = "block";
                                } else {
                                    contenu.style.display = "none";
                                }
                            }
                            </script>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        
    </div>

    <style>
        .small {
            font-size: 10px; /* Taille de la police */
            padding: 5px 5px 5px 5px; /* Espacement intérieur du bouton */
        }
    </style>


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

            function toggleContent(bouton) {
                var contenu = bouton.parentNode.querySelector(".annonceContent");
                if (contenu.style.display === "none") {
                    contenu.style.display = "block";
                } else {
                    contenu.style.display = "none";
                        }
            }

            $(document).ready(function (){
                setTimeout(function(){
                    $("div.alert").remove();
                }, 3000 ); //3s

            });
        </script>


        <style>

         /* Add this CSS code to your existing styles */
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