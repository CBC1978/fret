

function datablesContrat(nom){
    new DataTable(nom, {
        responsive:true,
        paging:true,
        "ordering": true,
        pageLength: 5,
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
            "search":         "",

            "zeroRecords":    "Pas de correspondance trouvé",
            "paginate": {
                "first":      "Premier",
                "last":       "Dernier",
                "next":       "Suivant",
                "previous":   "Précédent"
            },
        }
    } );
}
