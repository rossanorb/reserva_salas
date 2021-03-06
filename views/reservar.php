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

        #datetimepicker{

        }

        .reservas{
            margin-top: 15px;
        }

        div.hora {
            background: #66c03733;
            border: 1px solid #b5c2aecc;
            padding-top: 8px;
            padding: 1%;
            margin: 1%;
            cursor: pointer;
        }

        div.hora.reservado {
            background: #c0373733;
        }

        .info-sala li{
            list-style: square;
        }

        .reservas > div > ul{
            background-color: #f6f6f6;
        }

        .reservas > div > ul li{
            line-height: 25px;
        }

        i.glyphicon-remove::before{
            color:red;
        }
    </style>

</head>
<body>
<div id="wrapper">
    <div class="overlay"></div>

    <!-- Sidebar -->
    <?php echo realpath(include('./partials/sidebar.php')) ?>
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

                                        <div class="row reservas">

                                            <div class="col-md-12">
                                                <ul class="info-sala">
                                                    <li><?=$sala['nome'] ?></li>
                                                    <li><?=$sala['numero']?></li>
                                                </ul>
                                            </div>

                                            <div class="col-md-6">
                                                <div id="datetimepicker"></div>
                                            </div>
                                            <div style="min-height: 360px;" class="col-md-6 lista-horarios"></div>
                                            <div class="col-md-12">
                                                <button type="button" id="btn-reservar" class="btn btn-success">Reservar</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    <input type="hidden" id="id_sala" value="<?=$sala['id']?>">
    <input type="hidden" id="data" value="">
    <input type="hidden" id="hora" value="">

</div>
<!-- /#wrapper -->
<script type="text/javascript" src="asssets/js/reservas.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

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
