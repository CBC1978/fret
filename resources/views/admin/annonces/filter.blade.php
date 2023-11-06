@extends('layouts.admin')

@section('content')
<script>
  function returnToPreviousPage() {
  window.history.back(); // Revenir à la page précédente
}
</script>
<button type="submit" onclick="returnToPreviousPage()">Retour</button>
    <div class="chargeurAnnonces mt-2">
            <h3>La liste des annonces des Chargeurs</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>statut</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($chargeurAnnonces as $annonce)
                        <tr>
                            <td>{{ $annonce->id }}</td>
                            <td>
                                <li>
                                    @if ($annonce->status == 1) 
                                        Actif
                                    @else
                                        Desactivé 
                                    @endif
                                </li>
                            </td>
                        </tr>
                    @empty
                        <p class="text text-info"> Aucune Annonce trouvée</p>
                    @endforelse
                </tbody>
            </table>
    </div>
   
    <div class="transporteurAnnonces mt-4" >
            <h3>La liste des annonces des Transporteurs</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>statut</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transporteurAnnonces as $annonce)
                        <tr>
                            <td>{{ $annonce->id }}</td>
                            <td>
                                <li>
                                    @if ($annonce->status == 1) 
                                        Actif
                                    @else
                                        Desactivé 
                                    @endif
                                </li>
                            </td>
                        </tr>
                    @empty
                        <p class="text text-info"> Aucune Annonce trouvée</p>
                    @endforelse
                </tbody>
            </table>
    </div>
    
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        button a {
            text-decoration: none;
            color: white;
            padding: 5px 10px;
            background-color: #007bff;
            border-radius: 5px;
        }

        .chargeurAnnonces,
        .transporteurAnnonces {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f5f5f5;
        }

        h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }

        th {
            background-color: #f0f0f0;
        }

        li {
            list-style-type: none;
        }

        .text-info {
            color: #17a2b8;
        }
    </style>


@endsection