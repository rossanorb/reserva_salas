<?php
$erros = $_SESSION['erros'] ?? [];
$display = count($erros) > 0 ? 'block':'none';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">

    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</head>
<body>
<div class="container">
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">

            <div class="panel-heading">
                <div class="panel-title">Registro</div>
            </div>

            <div style="padding-top:30px" class="panel-body">

                <div style="display:<?=$display?>" id="login-alert" class="alert alert-danger col-sm-12">
                    <ul>
                        <?php  foreach ($erros as $erro): ?>
                            <li><?php echo $erro ?></li>
                        <?php  endforeach; ?>

                    </ul>
                </div>

                <form id="register" class="form-horizontal" role="form" method="post" action="user.php?action=do_register">

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="login-username" class="form-control" name="nome" value="" placeholder="nome" type="text">
                    </div>

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input id="login-username" class="form-control" name="username" value="" placeholder="email" type="text">
                    </div>

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="login-password" class="form-control" name="password" placeholder="password" type="password">
                    </div>

                    <div style="margin-top:10px" class="form-group">
                        <div class="col-sm-12 controls">
                            <button type="submit" class="btn btn-success">Enviar</button>
                        </div>
                    </div>



                </form>

            </div>
        </div>
    </div>

</div>
</body>
</html>