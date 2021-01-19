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
  
  <style>
    #preview {
      width: 45%;
      margin: 0 auto;
      margin-bottom: 10px;
      position: relative;
    }
         
    #preview a {
      position: absolute;
      bottom: 5px;
      left: 5px;
      right: 5px;
      display: none;
    }

    input[type=file] {
      position: absolute;
      visibility: hidden;
      width: 0;
      z-index: -9999;
    }      
  </style>

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
      <h1><i class="fa fa-user-md"></i>
        Empleado
        <small>Registro</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
      <form id="form_empleado" name="form_empleado" action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="bandera" id="bandera">

        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Datos Personales</h3>
            </div>
            <div class="box-body">

              <!--inicia el div para capturar la imagen -->
              <div class="form-group" align="center" >
                <label for="control-label" for="foto">Fotografía:</label>
                <div name="preview" id="preview" class="thumbnail">
                  <a href="#" id="file-select" class="btn btn-success"><span class="fa fa-camera">&nbsp;&nbsp;&nbsp;</span>Elegir archivo</a>
                  <img src="../../files/user5.png"/>
                </div>

                <div id="file-submit" >
                  <input id="file" name="file" type="file" accept="image/*" />
                  <span class="help-block" id="error"></span>
                </div> 
              </div>
              <!--finaliza el div para capturar la imagen -->

              <div class="form-group">
                <label class="control-label" for="nombre"><i class="ic"></i> Nombre</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingrese Nombre">
                </div>
                <span class="help-block"></span>
              </div>

              <div class="form-group">
                <label class="control-label" for="apellido"><i class="ic"></i> Apellido</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" id="apellido" name="apellido" class="form-control" placeholder="Ingrese Apellido">
                </div>
                <span class="help-block"></span>
              </div>

              <div class="row">
                <div class="col-xs-6 form-group">
                  <label class="control-label" for="dui"><i class="ic"></i> DUI</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-id-card-o"></i></span>
                    <input type="text" id="dui" name="dui" class="form-control" placeholder="Ingrese DUI" data-inputmask='"mask": "99999999-9"' data-mask>
                  </div>
                  <span class="help-block"></span>
                </div>

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="nit"><i class="ic"></i> NIT</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-id-card-o"></i></span>
                    <input type="text" id="nit" name="nit" class="form-control" placeholder="Ingrese NIT" data-inputmask='"mask": "9999-999999-999-9"' data-mask>
                  </div>
                  <span class="help-block"></span>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-6 form-group">
                  <label class="control-label" for="fecha_nacimiento"><i class="ic"></i> Fecha de Nacimiento</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" placeholder="Ingrese Fecha: día/mes/año">
                  </div>
                  <span class="help-block"></span>
                </div>

                <div class="col-xs-6 form-group has-success">
                  <label class="control-label" for="genero"><i class="fa fa-check"></i> G&eacute;nero</label>
                  <div class="radio">
                    <label>
                      <input type="radio" name="genero" id="masculino" value="Masculino" checked>
                      <i class="fa fa-male"></i> Masculino
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="genero" id="femenino" value="Femenino">
                      <i class="fa fa-female"></i> Femenino
                    </label>
                  </div>
                </div>
              </div>

            </div>
            <!-- /.box-body -->     
          </div>
          <!-- /.box -->

        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">

          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Datos Laborales</h3>
            </div>
            <div class="box-body">

              <div class="form-group">
                <label class="control-label" for="puesto"><i class="ic"></i> Puesto</label>
                <select class="form-control" id="puesto" name="puesto">
                  <option selected="selected" value="">Seleccione Puesto...</option>
                  <option value="Administrador">Administrador</option>
                  <option value="Vendedor">Vendedor</option>
                </select>
                <span class="help-block"></span>
              </div>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- general form elements disabled -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Datos de Contacto</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                
              <div class="form-group">
                <label class="control-label" for="direccion"><i class="ic"></i> Dirección</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-truck"></i></span>
                  <input type="text" id="direccion" name="direccion" class="form-control" placeholder="Ingrese Dirección">
                </div>
                <span class="help-block"></span>
              </div>

              <div class="form-group">
                <label class="control-label" for="correo"><i class="ic"></i> Correo Electrónico</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input type="text" id="correo" name="correo" class="form-control" placeholder="Ingrese Correo Electrónico">
                </div>
                <span class="help-block"></span>
              </div>

              <div class="form-group">
                <label class="control-label" for="telefono"><i class="ic"></i> Teléfono</label>
                <div class="input-group col-xs-6">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Ingrese Teléfono" data-inputmask='"mask": "9999-9999"' data-mask>
                </div>
                <span class="help-block"></span>
              </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer" align="right">
              <button type="button" id="btnguardar" name="btnguardar" class="btn btn-round btn-success">
                <span class="fa fa-floppy-o">&nbsp;&nbsp;&nbsp;</span>Guardar Empleado
              </button>
                        
              <button type="button" class="btn btn-round btn-default" onclick="location.href='../../pages/empleado/empleado_add.php'">
                <span class="fa fa-ban">&nbsp;&nbsp;&nbsp;</span>Cancelar Proceso
              </button>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
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
<script src="../../build/validaciones/empleado/empleado_add.js"></script>
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