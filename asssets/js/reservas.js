function busca_horarios(date) {
    $.ajax({
        url: 'reservas.php',
        type: 'GET',
        data:{
            action: 'consultar',
            date: date
        },
        success: function(result) {

        },
        statusCode: {
            404: function() {
                console.log('recurso não disponível')
            },
            419: function() {
                console.log('status desconhecido')
            },
            403: function() {
                console.log('sem permissão')
            },
            500: function() {
                console.log('erro interno')
            }
        }

    }).done(function( data ) {

    });
}

$(document).ready(function () {
    $('#datetimepicker').datetimepicker({
        locale: 'pt-BR',
        inline: true,
        format: 'DD/MM/YYYY'
    });

    $("#datetimepicker").on("dp.change", function (e) {
        let date = $('#datetimepicker td.day.active').attr('data-day')
        busca_horarios(date);
    });
});
