<?php
session_start();
include("build/controladores/conexion.php");

$usuario=(isset($_POST["usuario"]))?$_POST["usuario"]:"";
$clave=(isset($_POST["clave"]))?$_POST["clave"]:"";

if($usuario!="" and $clave!="")
{
  $sentencia= $pdo->prepare("Select id_usuario, nombre, apellido, usuario,clave,nivel from usuarios where usuario='".$usuario."'");
  $sentencia->execute();
  $datosUsuario=$sentencia->fetchAll(PDO::FETCH_ASSOC);
foreach($datosUsuario as $usuario_a){
  $clave2=$usuario_a['clave'];
  $user=$usuario_a['nombre']." ".$usuario_a['apellido'];
  $nivel_usuario=$usuario_a['nivel'];
  $idusuario=$usuario_a['id_usuario'];
}
if($clave==$clave2){
  $_SESSION['usuario']  = $user;
  $_SESSION['acceso']  = "si";
  $_SESSION['nivel']  = $nivel_usuario;
  $_SESSION['id_usuario_admin']  = $idusuario;
  header("location: pages/acceso/inicio.php");
  
}
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Financial Software</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- PNotify -->
  <link href="plugins/PNotify/dist/PNotifyBrightTheme.css" rel="stylesheet" type="text/css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><i class="text-blue"><b>Financial Software</b></i><p class="login-box-msg"><i class="text-blue">F</i><b>S</b></p></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg"><b>Inicio de Sesión</b></p>

    <form id="form_index" name="form_index" action="index.php" method="POST">
      <div class="form-group has-feedback">
        <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Usuario">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="clave" name="clave" class="form-control" placeholder="Contraseña">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      </br>
      
      <div class="row">
        <div class="box-footer" align="right">
          <button type="button" id="btningresar" name="btningresar" class="btn bg-blue">
            <span class="fa fa-sign-in">&nbsp;&nbsp;&nbsp;</span>Ingresar
          </button>
        </div>
      </div>
    </form>
    

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- PNotify -->
<script src="plugins/PNotify/dist/iife/PNotify.js"></script>
<script src="plugins/PNotify/dist/iife/PNotifyButtons.js"></script>
<script src="plugins/PNotify/dist/iife/PNotifyConfirm.js"></script>
<script src="plugins/PNotify/dist/iife/PNotifyMobile.js"></script>
<!-- Validate -->
<script src="plugins/validar/jquery.validate.js"></script>
<script src="build/validaciones/form_index.js"></script>
</body>
</html>
