<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">

    <title>Usuários</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="asssets/css/salas.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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

        .widget li.list-group-item {
            border-radius: 0;
            border: 0;
            border-top: 1px solid #ddd;
        }

        .widget .btn-new {
            float: right;
            margin-right: 1%;
        }

        .widget li.list-group-item:hover {
            background-color: rgba(200, 200, 124, .1);
        }

        .widget .mic-info {
            color: #666666;
            font-size: 11px;
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
                            <span class="glyphicon glyphicon-user"></span>
                            <h3 class="panel-title">Usuários</h3>
                            <span class="label label-info"><?= count($usuarios) ?></span>
                            <a href="user.php?action=new" class="btn btn-success btn-xs btn-new" title="New"><span class="glyphicon glyphicon-plus"></span></a>
                        </div>
                        <div class="panel-body">
                            <ul class="list-group">
                                <?php foreach ($usuarios as $usuario): ?>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-xs-10 col-md-11">

                                                <div>
                                                    <?= $usuario['nome'] ?>
                                                    <div class="mic-info">
                                                        <?= $usuario['username'] ?>
                                                    </div>
                                                </div>
                                                <!--<div class="comment-text">
                                                    Awesome design
                                                </div>
                                                -->
                                                <div class="action">
                                                    <a href="user.php?action=edit&id=<?= $usuario['id'] ?>"
                                                       class="btn btn-primary btn-xs" title="Edit"><span
                                                            class="glyphicon glyphicon-pencil"></span></a>
                                                    <a href="user.php?action=delete&id=<?= $usuario['id'] ?>"
                                                       class="btn btn-danger btn-xs" title="Delete"><span
                                                            class="glyphicon glyphicon-trash"></span></a>
                                                </div>


                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
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
