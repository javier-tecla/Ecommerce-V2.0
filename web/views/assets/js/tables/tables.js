$("#tables").DataTable({
    "responsive":true,
    "aLengthMenu":[[10, 25, 50, 100],[10, 25, 50, 100]],
    "order":[[0, "desc"]],
    "language":{

        "sProcessing":      "Procesando...",
        "sLengthMenu":      "Mostrar _MENU_ registros",
        "aZeroRecords":     "No se encontraron resultados",
        "sEmptyTable":      "Ningún dato disponible en esta tabla",
        "sInfo":            "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty":       "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered":    "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":     "",
        "sSearch":          "Buscar:",
        "sUrl":             "",
        "sInfoThousands":   ",",
        "sLoadingRecords":  "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior",
        },
        "oAria": {
        "oSortAscending":   ": Activar para ordenar la columna de manera ascendente",
        "oSortDescending":   ": Activar para ordenar la columna de manera descendente"
         }
    }
    
});