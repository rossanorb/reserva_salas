
function is_reservado(h, horarios_ocupados){
    for(i =0; i < horarios_ocupados.length; i++){
        if(horarios_ocupados[i]['data'] == h) return true;
    }
    return false;
}

function render_table(data){
    let horarios_ocupados = JSON.parse(data);

    $(".lista-horarios div").remove();

    $(".lista-horarios").append(`<div class="col-md-6 column1"></div><div class="col-md-6 column2"></div>`);

    for(let i=0; i < 24; i++){
        let h = String(i).length < 2 ? `0${i}:00` : `${i}:00` ;
        let classe = "";

        if(i > 11){
            if( is_reservado(i, horarios_ocupados) == true ){
                classe = 'reservado';
            }
            $(".lista-horarios div.column2").append(`<div class="hora ${classe}">${h}</div>`);
        }else{
            if( is_reservado(i, horarios_ocupados) == true ){
                classe = 'reservado';
            }
            $(".lista-horarios div.column1").append(`<div class="hora ${classe}">${h}</div>`);
        }

    }

}

function busca_horarios(date) {
    $.ajax({
        url: 'reservas.php',
        type: 'GET',
        data:{
            action: 'consultar',
            date: date
        },
        success: function(data) {
            render_table(data);
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
