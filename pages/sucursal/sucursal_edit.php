<?php
session_start();
$logueo=$_SESSION['acceso'];
if($logueo=='si'){

  include ("../../build/controladores/conexion.php");

  $stmt= $pdo->prepare("SELECT * FROM sucursal WHERE id_sucursal=1");
  $stmt->execute();
  $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
  foreach($result as $lista_sucursal){ 
    $nombre_r=$lista_sucursal['nombre'];
    $codigo_r=$lista_sucursal['codigo'];
    $nit_r=$lista_sucursal['nit'];
    $nrc_r=$lista_sucursal['nrc'];
    $giro_r=$lista_sucursal['giro'];
    $iva_r=$lista_sucursal['iva'];
    $direccion_r=$lista_sucursal['direccion'];
    $correo_r=$lista_sucursal['correo'];
    $telefono_r=$lista_sucursal['telefono'];
    $logo_r=$lista_sucursal['logo'];
  }
 /* }else{
    header('location: lista_actividades.php');
  }*/
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
      <h1><i class="fa fa-institution text-orange"></i>
        Sucursal
        <small>Mantenimiento</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
      <form id="form_sucursal" name="form_sucursal" action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="bandera" id="bandera">
        <input type="hidden" name="logo_r" id="logo_r" value="<?php echo $logo_r; ?>">


        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Datos Sucursal</h3>
            </div>
            <div class="box-body">

              <!--inicia el div para capturar la imagen -->
              <div class="form-group" align="center" >
                <label for="control-label" for="foto">Logo:</label>
                <div name="preview" id="preview" class="thumbnail">
                  <a href="#" id="file-select" class="btn btn-primary"><span class="fa fa-camera">&nbsp;&nbsp;&nbsp;</span>Elegir archivo</a>
                  <img src="<?php echo "../../".$logo_r; ?>"/>
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
                  <span class="input-group-addon"><i class="fa fa-institution"></i></span>
                  <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingrese Nombre" value="<?php echo $nombre_r; ?>">
                </div>
                <span class="help-block"></span>
              </div>

              <div class="row">

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="codigo"><i class="ic"></i> Código</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                    <input type="text" id="codigo" name="codigo" class="form-control" placeholder="Ingrese Código" value="<?php echo $codigo_r; ?>">
                  </div>
                  <span class="help-block"></span>
                </div>

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="nit"><i class="ic"></i> NIT</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-id-card-o"></i></span>
                    <input type="text" id="nit" name="nit" class="form-control" placeholder="Ingrese NIT" data-inputmask='"mask": "9999-999999-999-9"' data-mask value="<?php echo $nit_r; ?>">
                  </div>
                  <span class="help-block"></span>
                </div>      

              </div>

              <div class="row">

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="nrc"><i class="ic"></i> NRC</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-id-card-o"></i></span>
                    <input type="text" id="nrc" name="nrc" class="form-control" placeholder="Ingrese NRC" data-inputmask='"mask": "999999-9"' data-mask value="<?php echo $nrc_r; ?>">
                  </div>
                  <span class="help-block"></span>
                </div>      

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="iva"><i class="ic"></i> Impuesto Iva</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                    <input type="text" id="iva" name="iva" class="form-control" placeholder="Ingrese Impuesto Iva" value="<?php echo $iva_r; ?>">
                  </div>
                  <span class="help-block"></span>
                </div>

              </div>

              <div class="form-group">
                <label class="control-label" for="giro"><i class="ic"></i> Giro</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-bullseye"></i></span>
                  <input type="text" id="giro" name="giro" class="form-control" placeholder="Ingrese Giro" value="<?php echo $giro_r; ?>">
                </div>
                <span class="help-block"></span>
              </div>

            </div>
            <!-- /.box-body -->     
          </div>
          <!-- /.box -->

        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">

          <!-- general form elements disabled -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Datos de Contacto</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                
              <div class="form-group">
                <label class="control-label" for="direccion"><i class="ic"></i> Dirección</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-truck"></i></span>
                  <input type="text" id="direccion" name="direccion" class="form-control" placeholder="Ingrese Dirección" value="<?php echo $direccion_r; ?>">
                </div>
                <span class="help-block"></span>
              </div>

              <div class="form-group">
                <label class="control-label" for="correo"><i class="ic"></i> Correo Electrónico</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input type="text" id="correo" name="correo" class="form-control" placeholder="Ingrese Correo Electrónico" value="<?php echo $correo_r; ?>">
                </div>
                <span class="help-block"></span>
              </div>

              <div class="form-group">
                <label class="control-label" for="telefono"><i class="ic"></i> Teléfono</label>
                <div class="input-group col-xs-6">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Ingrese Teléfono" data-inputmask='"mask": "9999-9999"' data-mask value="<?php echo $telefono_r; ?>">
                </div>
                <span class="help-block"></span>
              </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer" align="right">
              <button type="button" id="btneditar" name="btneditar" class="btn btn-round btn-primary">
                <span class="fa fa-refresh">&nbsp;&nbsp;&nbsp;</span>Actualizar Sucursal
              </button>
                        
              <button type="button" class="btn btn-round btn-default" onclick="location.href='../../pages/sucursal/sucursal_edit.php'">
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
<script src="../../build/validaciones/sucursal/sucursal_edit.js"></script>
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