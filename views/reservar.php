<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">

    <title>Salas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="asssets/datepicker/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <link rel="stylesheet" href="asssets/css/salas.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="asssets/datepicker/js/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="asssets/datepicker/js/bootstrap-datetimepicker.js"></script>

    <style type="text/css">
        body {
            padding-top: 30px;
        }

        .widget .panel-body {
            padding: 0px;
        }

        .widget .list-group {
            margin-bottom: 0;
        }

        .widget .panel-title {
            display: inline
        }

        .widget .label-info {
            float: right;
        }

        .widget .btn-new {
            float: right;
            margin-right: 1%;
        }

        .widget li.list-group-item {
            border-radius: 0;
            border: 0;
            border-top: 1px solid #ddd;
        }

        .widget li.list-group-item:hover {
            background-color: rgba(200, 200, 124, .1);
        }

        .widget .mic-info {
            color: #666666;
            font-size: 15px;
        }

        .widget .action {
            margin-top: 5px;
        }

        .widget .comment-text {
            font-size: 12px;
        }

        .widget .btn-block {
            border-top-left-radius: 0px;
            border-top-right-radius: 0px;
        }
    </style>

</head>
<body>
<div id="wrapper">
    <div class="overlay"></div>

    <!-- Sidebar -->
    <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
        <ul class="nav sidebar-nav">
            <li class="sidebar-brand">
                <a href="#">
                    Brand
                </a>
            </li>
            <li>
                <a href="salas.php">Salas</a>
            </li>
            <li>
                <a href="user.php?action=lista">Usuários</a>
            </li>

        </ul>
    </nav>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
            <span class="hamb-top"></span>
            <span class="hamb-middle"></span>
            <span class="hamb-bottom"></span>
        </button>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="panel panel-default widget">
                        <div class="panel-heading">
                            <span class="glyphicon glyphicon-book"></span>
                            <h3 class="panel-title">Reserva</h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-lg-12">
                                <div style="overflow:hidden;">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div id="datetimepicker12"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->
<script type="text/javascript">

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

        $('#datetimepicker12').datetimepicker({
            locale: 'pt-BR',
            inline: true,
            format: 'DD/MM/YYYY'
        });

        $("#datetimepicker12").on("dp.change", function (e) {
            let date = $('#datetimepicker12 td.day.active').attr('data-day')
            busca_horarios(date);
        });

        var trigger = $('.hamburger'),
            overlay = $('.overlay'),
            isClosed = false;

        trigger.click(function () {
            hamburger_cross();
        });

        function hamburger_cross() {

            if (isClosed == true) {
                overlay.hide();
                trigger.removeClass('is-open');
                trigger.addClass('is-closed');
                isClosed = false;
            } else {
                overlay.show();
                trigger.removeClass('is-closed');
                trigger.addClass('is-open');
                isClosed = true;
            }
        }

        $('[data-toggle="offcanvas"]').click(function () {
            $('#wrapper').toggleClass('toggled');
        });
    });
</script>
</body>
</html>
