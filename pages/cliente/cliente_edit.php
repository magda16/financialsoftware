<?php
session_start();
$logueo=$_SESSION['acceso'];
if($logueo=='si'){

  include ("../../build/controladores/conexion.php");
//$id_cliente=1;
  if(isset($_POST["id"])){
    
    $id_cliente=$_POST["id"];

    $tipo_r=$_POST["tipo"];
    if ($tipo_r=="Persona") {
      $stmt= $pdo->prepare("SELECT * FROM cliente WHERE id_cliente=:id_cliente");
      $stmt->bindParam(":id_cliente",$id_cliente,PDO::PARAM_INT);
      $stmt->execute();
      $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($result as $lista_cliente){ 
        $nombre_r=$lista_cliente['nombre'];
        $apellido_r=$lista_cliente['apellido'];
        $dui_r=$lista_cliente['dui'];
        $nit_r=$lista_cliente['nit'];
        $fechanac_r=$lista_cliente['fecha_nac'];
        $genero_r=$lista_cliente['genero'];
        $direccion_r=$lista_cliente['direccion'];
        $correo_r=$lista_cliente['correo'];
        $telefono_r=$lista_cliente['telefono'];
        $fotografia_r=$lista_cliente['fotografia'];
      }

    }else {
      $stmt= $pdo->prepare("SELECT * FROM cliente_institucion WHERE id_cliente_institucion=:id_cliente");
      $stmt->bindParam(":id_cliente",$id_cliente,PDO::PARAM_INT);
      $stmt->execute();
      $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($result as $lista_cliente){ 
        $nombrei_r=$lista_cliente['nombre'];
        $niti_r=$lista_cliente['nit'];
        $nrci_r=$lista_cliente['nrc'];
        $direccioni_r=$lista_cliente['direccion'];
        $correoi_r=$lista_cliente['correo'];
        $telefonoi_r=$lista_cliente['telefono'];
        $fotografia_r=$lista_cliente['fotografia'];
      }
    }
    
 }else{
   header('location: cliente_list.php');
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
      <h1><i class="fa fa-user-plus"></i>
        Cliente
        <small>Mantenimiento</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
      <form id="form_cliente" name="form_cliente" action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="bandera" id="bandera">
        <input type="hidden" name="id_cliente" id="id_cliente" value="<?php echo $id_cliente; ?>" >
        <input type="hidden" name="foto" id="foto" value="<?php echo $fotografia_r; ?>" >

        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Datos Generales</h3>
            </div>
            <div class="box-body">

              <!--inicia el div para capturar la imagen -->
              <div class="form-group" align="center" >
                <label for="control-label" for="foto">Fotografía:</label>
                <div name="preview" id="preview" class="thumbnail">
                  <a href="#" id="file-select" class="btn btn-success"><span class="fa fa-camera">&nbsp;&nbsp;&nbsp;</span>Elegir archivo</a>
                  <img src="<?php  if($fotografia_r != ""){ echo "../../".$fotografia_r; }else{ echo "../../files/user2.png"; } ?>"/>
                </div>

                <div id="file-submit" >
                  <input id="file" name="file" type="file" accept="image/*" />
                  <span class="help-block" id="error"></span>
                </div> 
              </div>
              <!--finaliza el div para capturar la imagen -->

              <div class="form-group">
                <label class="control-label" for="tipo_cliente"><i class="ic"></i> Tipo de Cliente </label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" id="tipo" name="tipo" class="form-control" placeholder="Ingrese Nombre" value="<?php echo $tipo_r; ?>" readonly>
                  </div>
                <span class="help-block"></span>
              </div>

              <div id="div_cliente_natural">
                <div class="form-group">
                  <label class="control-label" for="nombre"><i class="ic"></i> Nombre</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingrese Nombre" value="<?php if($tipo_r=='Persona'){echo $nombre_r;}else{echo '';} ?>">
                  </div>
                  <span class="help-block"></span>
                </div>

                <div class="form-group">
                  <label class="control-label" for="apellido"><i class="ic"></i> Apellido</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" id="apellido" name="apellido" class="form-control" placeholder="Ingrese Apellido" value="<?php if($tipo_r=='Persona'){echo $apellido_r;}else{echo '';} ?>">
                  </div>
                  <span class="help-block"></span>
                </div>

                <div class="row">
                  <div class="col-xs-6 form-group">
                    <label class="control-label" for="dui"><i class="ic"></i> DUI</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-id-card-o"></i></span>
                      <input type="text" id="dui" name="dui" class="form-control" placeholder="Ingrese DUI" data-inputmask='"mask": "99999999-9"' data-mask value="<?php if($tipo_r=='Persona'){echo $dui_r;}else{echo '';} ?>">
                    </div>
                    <span class="help-block"></span>
                  </div>

                  <div class="col-xs-6 form-group">
                    <label class="control-label" for="nit"><i class="ic"></i> NIT</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-id-card-o"></i></span>
                      <input type="text" id="nit" name="nit" class="form-control" placeholder="Ingrese NIT" data-inputmask='"mask": "9999-999999-999-9"' data-mask value="<?php if($tipo_r=='Persona'){echo $nit_r;}else{echo '';} ?>">
                    </div>
                    <span class="help-block"></span>
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-6 form-group">
                    <label class="control-label" for="fecha_nacimiento"><i class="ic"></i> Fecha Nacimiento</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      <input type="text" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" placeholder="Ingrese Fecha Nacimiento" value="<?php if($tipo_r=='Persona'){echo $fechanac_r;}else{echo '';} ?>">
                    </div>
                    <span class="help-block"></span>
                  </div>

                  <div class="col-xs-6 form-group has-success">
                  <label class="control-label" for="genero"><i class="fa fa-check"></i> G&eacute;nero</label>
                  <div class="radio">
                    <label>
                      <input type="radio" name="genero" id="masculino" value="Masculino" <?php if($genero_r=="Masculino") echo "checked"; ?> >
                      <i class="fa fa-male"></i> Masculino
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="genero" id="femenino" value="Femenino" <?php if($genero_r=="Femenino") echo "checked"; ?> >
                      <i class="fa fa-female"></i> Femenino
                    </label>
                  </div>
                </div>
                </div>
              </div>

              <div id="div_cliente_juridico">
                <div class="form-group">
                  <label class="control-label" for="nombre_institucion"><i class="ic"></i> Nombre</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-institution"></i></span>
                    <input type="text" id="nombre_institucion" name="nombre_institucion" class="form-control" placeholder="Ingrese Nombre" value="<?php if($tipo_r=='Institucion'){echo $nombrei_r;}else{echo '';} ?>">
                  </div>
                  <span class="help-block"></span>
                </div>

                <div class="row">
                  <div class="col-xs-6 form-group">
                    <label class="control-label" for="nit"><i class="ic"></i> NIT</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-id-card-o"></i></span>
                      <input type="text" id="niti" name="niti" class="form-control" placeholder="Ingrese NIT" data-inputmask='"mask": "9999-999999-999-9"' data-mask value="<?php if($tipo_r=='Institucion'){echo $niti_r;}else{echo '';} ?>">
                    </div>
                    <span class="help-block"></span>
                  </div>

                  <div class="col-xs-6 form-group">
                    <label class="control-label" for="nrc"><i class="ic"></i> NRC</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-id-card-o"></i></span>
                      <input type="text" id="nrc" name="nrc" class="form-control" placeholder="Ingrese NRC" data-inputmask='"mask": "999999-9"' data-mask value="<?php if($tipo_r=='Institucion'){echo $nrci_r;}else{echo '';} ?>">
                    </div>
                    <span class="help-block"></span>
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
                  <input type="text" id="direccion" name="direccion" class="form-control" placeholder="Ingrese Dirección" value="<?php if($tipo_r=='Persona'){echo $direccion_r;}else{echo $direccioni_r;} ?>">
                </div>
                <span class="help-block"></span>
              </div>

              <div class="form-group">
                <label class="control-label" for="correo"><i class="ic"></i> Correo Electrónico</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input type="text" id="correo" name="correo" class="form-control" placeholder="Ingrese Correo Electrónico" value="<?php if($tipo_r=='Persona'){echo $correo_r;}else{echo $correoi_r;} ?>">
                </div>
                <span class="help-block"></span>
              </div>

              <div class="form-group">
                <label class="control-label" for="telefono"><i class="ic"></i> Teléfono</label>
                <div class="input-group col-xs-6">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Ingrese Teléfono" data-inputmask='"mask": "9999-9999"' data-mask value="<?php if($tipo_r=='Persona'){echo $telefono_r;}else{echo $telefonoi_r;} ?>">
                </div>
                <span class="help-block"></span>
              </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer" align="right">
              <button type="button" id="btneditar" name="btneditar" class="btn btn-round btn-primary">
                <span class="fa fa-refresh">&nbsp;&nbsp;&nbsp;</span>Actualizar Cliente
              </button>
                        
              <button type="button" class="btn btn-round btn-default" onclick="location.href='../../pages/cliente/cliente_list.php'">
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
<script src="../../build/validaciones/cliente/cliente_edit.js"></script>
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