
function get_sala_reservada(h, horarios_ocupados){
    for(i =0; i < horarios_ocupados.length; i++){
        if(horarios_ocupados[i]['data'] == h) return horarios_ocupados[i];
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
        let dados_sala = "";

        if(i > 11){
            let sala = get_sala_reservada(i, horarios_ocupados['salas_reservadas']);
            if(sala){
                classe = 'reservado';
                if(horarios_ocupados['info_salas'][sala['id_sala']]){
                    dados_sala = `:${horarios_ocupados['info_salas'][sala['id_sala']]['nome']} | ${horarios_ocupados['info_salas'][sala['id_sala']]['numero']} `;
                }
            }

            $(".lista-horarios div.column2").append(`<div class="hora ${classe}">${h} ${dados_sala}</div>`);
        }else{
            let sala = get_sala_reservada(i, horarios_ocupados['salas_reservadas']);
            if(sala){
                classe = 'reservado';
                if(horarios_ocupados['info_salas'][sala['id_sala']]){
                    dados_sala = `:${horarios_ocupados['info_salas'][sala['id_sala']]['nome']} | ${horarios_ocupados['info_salas'][sala['id_sala']]['numero']} `;
                }
            }

            $(".lista-horarios div.column1").append(`<div class="hora ${classe}">${h} ${dados_sala}</div>`);
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
        $('#data').val(date)
        busca_horarios(date);
    });

    $('html').on('click',".lista-horarios .hora:not('.reservado')", function(){
        $('#hora').val($(this).text());
        $(".lista-horarios .hora:not('.reservado')").css('background-color','#66c03733');
        $(this).css('background-color','#c1dec1');
    })

    $('#btn-reservar').on('click',function(){
        if($('#id_sala').val() && $('#data').val() && $('#hora').val() ){
            $.ajax({
                url: 'reservas.php',
                type: 'POST',
                data:{
                    action: 'reservar',
                    id_sala: $('#id_sala').val(),
                    date: $('#data').val(),
                    hora: $('#hora').val(),
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
            });
        }else{
            alert('selecione uma data e um horário');
        }

    });
});
