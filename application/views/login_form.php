<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url('images/pdvsa.ico');?>">

    <title>Inicio Sesi&oacute;n - SIEPCP</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url("css/bootstrap.min.css");?>" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?php echo base_url("css/ie10-viewport-bug-workaround.css");?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url("css/signin.css");?>" rel="stylesheet">
    <link href="<?php echo base_url("css/login_fondo.css");?>" rel="stylesheet">
    

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo base_url("js/ie-emulation-modes-warning.js");?>"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container-">

          <form class="form-signin" accept-charset="utf-8" method="post" action="<?php echo base_url('sesion/login')?>">
          <h2 class="form-signin-heading" style="color: #000;text-shadow: 3px 6px 9px #666;">Inicio de Sesión</h2>
        <label for="indicador" class="sr-only">Indicador</label>
        <input type="indicador" id="indicador" name="indicador" class="form-control" placeholder="indicador" required autofocus>
        <label for="password" class="sr-only">Clave de Red</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Clave de Red" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Recordar
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url("js/ie10-viewport-bug-workaround.js");?>"></script>
  </body>
</html>
