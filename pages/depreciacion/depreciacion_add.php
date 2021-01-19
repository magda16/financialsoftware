<?php
session_start();
$logueo=$_SESSION['acceso'];
if($logueo=='si'){

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
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- bootstrap-datepicker -->
  <link href="../../plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet">
  <!-- PNotify -->
  <link href="../../plugins/PNotify/dist/PNotifyBrightTheme.css" rel="stylesheet" type="text/css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue-light sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <?php include("../header.php"); ?> 
  </header>
  
  <?php include("../menu.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="fa fa-calculator"></i>
        Calcular Depreciación
        <small>Mantenimiento</small>
      </h1>
    </section>

    <section class="content">
      <div class="row">
      <form id="form_activo_fijo" name="form_activo_fijo" action="depreciacion_list.php" method="POST">
      <input type="hidden" id="id" name="id">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Datos del Activo Fijo</h3>
            </div>
            <div class="box-body">

              <div class="form-group">
                <label class="control-label" for="categoria"><i class="ic"></i> Categoría</label>
                <select class="form-control" id="categoria" name="categoria">
                </select>
                <span class="help-block"></span>
              </div>

              <div class="form-group">
                <label class="control-label" for="tipo_bien"><i class="ic"></i> Tipo de Bien</label>
                <select class="form-control" id="tipo_bien" name="tipo_bien">
                </select>
                <span class="help-block"></span>
              </div>

              <div class="form-group">
                <label class="control-label" for="activo_fijo"><i class="ic"></i> Activo Fijo</label>
                <select class="form-control" id="activo_fijo" name="activo_fijo">
                </select>
                <span class="help-block"></span>
              </div>
              <div class="row">
                <div class="col-xs-6 form-group">
                  <label class="control-label" for="fecha"><i class="ic"></i> Fecha de Cálculo</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" id="fecha" name="fecha" class="form-control" placeholder="Ingrese Fecha: día/mes/año">
                  </div>
                  <span class="help-block"></span>
                </div>
              </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer" align="right">
              <button type="button" id="btncalcular" name="btncalcular" class="btn bg-blue">
                <span class="fa fa-calculator">&nbsp;&nbsp;&nbsp;</span>Calcular Depreciación
              </button>
                        
              <button type="button" class="btn btn-round btn-default" onclick="location.href='../../pages/depreciacion/depreciacion_add.php'">
                <span class="fa fa-ban">&nbsp;&nbsp;&nbsp;</span>Cancelar Proceso
              </button>
            </div>   
          </div>
          <!-- /.box -->

        </div>
        <!--/.col (left) -->
        </form>

      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <?php include("../footer.php"); ?>
  </footer>

  <!-- Control Sidebar -->
  <?php include("../ayuda_ingreso_datos.php"); ?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- InputMask -->
<script src="../../plugins/input-mask/jquery.inputmask.js"></script>
<!-- bootstrap-datepicker -->
<script src="../../plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<!-- PNotify -->
<script src="../../plugins/PNotify/dist/iife/PNotify.js"></script>
<script src="../../plugins/PNotify/dist/iife/PNotifyButtons.js"></script>
<script src="../../plugins/PNotify/dist/iife/PNotifyConfirm.js"></script>
<script src="../../plugins/PNotify/dist/iife/PNotifyMobile.js"></script>
<!-- Validate -->
<script src="../../plugins/validar/jquery.validate.js"></script>
<script src="../../build/validaciones/depreciacion/depreciacion_add.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
</body>
</html>
<?php 

}else{
  header('location: index.php');
}

?>