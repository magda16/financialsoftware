<?php
session_start();
$logueo=$_SESSION['acceso'];
if($logueo=='si'){

  include ("../../build/controladores/conexion.php");

  if(isset($_POST['id'])){
    $id_producto=$_POST['id'];

    $stmt= $pdo->prepare("SELECT nombre, marca, modelo, margen_ganancia, stock_minimo, cantidad, precio, descripcion, fotografia, categoria, proveedor FROM producto WHERE id_producto=:id_producto");
    $stmt->bindParam(":id_producto",$id_producto,PDO::PARAM_INT);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $lista_producto){ 
      $nombre_r=$lista_producto['nombre'];
      $marca_r=$lista_producto['marca'];
      $modelo_r=$lista_producto['modelo'];
      $margen_ganancia_r=$lista_producto['margen_ganancia'];
      $stock_minimo_r=$lista_producto['stock_minimo'];
      $cantidad_r=$lista_producto['cantidad'];
      $precio_r=$lista_producto['precio'];
      $descripcion_r=$lista_producto['descripcion'];
      $fotografia_r=$lista_producto['fotografia'];
      $categoria_r=$lista_producto['categoria'];
      $proveedor_r=$lista_producto['proveedor'];
    }
  }else{
    header('location: producto_list.php');
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
      <h1><i class="fa fa-cubes"></i>
        Producto
        <small>Mantenimiento</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
      <form id="form_producto" name="form_producto" action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="bandera" id="bandera">

        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Datos Producto</h3>
            </div>
            <div class="box-body">
            <input type="hidden" name="id_producto" id="id_producto" value="<?php echo $id_producto; ?>" >
            <input type="hidden" name="id_proveedor" id="id_proveedor" value="<?php echo $proveedor_r; ?>" >
            <input type="hidden" name="foto" id="foto" value="<?php echo $fotografia_r; ?>" >


              <!--inicia el div para capturar la imagen -->
              <div class="form-group" align="center" >
                <label for="control-label" for="foto">Fotografía:</label>
                <div name="preview" id="preview" class="thumbnail">
                  <a href="#" id="file-select" class="btn btn-primary"><span class="fa fa-camera">&nbsp;&nbsp;&nbsp;</span>Elegir archivo</a>
                  <img src="<?php  if($fotografia_r != ""){ echo "../../".$fotografia_r; }else{ echo "../../files/producto.png"; } ?>"/>
                </div>

                <div id="file-submit" >
                  <input id="file" name="file" type="file" accept="image/*" />
                  <span class="help-block" id="error"></span>
                </div> 
              </div>
              <!--finaliza el div para capturar la imagen -->

              <div class="form-group">
                <label class="control-label" for="nombre"><i class="ic"></i> Producto</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                  <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingrese Producto" value="<?php echo $nombre_r; ?>">
                </div>
                <span class="help-block"></span>
              </div>

              <div class="form-group">
                <label class="control-label" for="categoria"><i class="ic"></i> Categoría</label>
                <select class="form-control" id="categoria" name="categoria">
                  <option selected="selected" value="">Seleccione Categoría...</option>
                  <option value="Hogar" <?php if($categoria_r=="Hogar") echo "selected"; ?> >Hogar</option>
                  <option value="Muebles" <?php if($categoria_r=="Muebles") echo "selected"; ?> >Muebles</option>
                  <option value="Cocinas" <?php if($categoria_r=="Cocinas") echo "selected"; ?> >Cocinas</option>
                  <option value="Lavadoras" <?php if($categoria_r=="Lavadoras") echo "selected"; ?> >Lavadoras</option>
                  <option value="Computo" <?php if($categoria_r=="Computo") echo "selected"; ?> >Computo</option>
                </select>
                <span class="help-block"></span>
              </div>

              <div class="form-group">
                <label class="control-label" for="marca"><i class="ic"></i> Marca</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                  <input type="text" id="marca" name="marca" class="form-control" placeholder="Ingrese Marca" value="<?php echo $marca_r; ?>">
                </div>
                <span class="help-block"></span>
              </div>

              <div class="form-group">
                <label class="control-label" for="modelo"><i class="ic"></i> Modelo</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-tasks"></i></span>
                  <input type="text" id="modelo" name="modelo" class="form-control" placeholder="Ingrese Modelo" value="<?php echo $modelo_r; ?>">
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

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Datos Generales</h3>
            </div>
            <div class="box-body">

              <div class="form-group">
                <label class="control-label" for="proveedor"><i class="ic"></i> Proveedor</label>
                <select class="form-control" id="proveedor" name="proveedor">
                </select>
                <span class="help-block"></span>
              </div>

              <div class="row">

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="margen_ganancia"><i class="ic"></i> Margen de Ganancia</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                    <input type="text" id="margen_ganancia" name="margen_ganancia" class="form-control" placeholder="Ingrese Margen Ganancia" value="<?php echo $margen_ganancia_r; ?>">
                  </div>
                  <span class="help-block"></span>
                </div>

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="stock_minimo"><i class="ic"></i> Stock Mínimo</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-stop"></i></span>
                    <input type="text" id="stock_minimo" name="stock_minimo" class="form-control" placeholder="Ingrese Stock Mínimo" value="<?php echo $stock_minimo_r; ?>">
                  </div>
                  <span class="help-block"></span>
                </div>

              </div>
              
              <div class="form-group">
                <label class="control-label" for="descripcion"><i class="ic"></i> Descripción</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
                  <textarea id="descripcion" name="descripcion" class="form-control" rows="2" placeholder="Ingrese Descripción"><?php echo $descripcion_r; ?></textarea>
                </div>
                <span class="help-block"></span>
              </div>
            
              <!-- /.box-body -->
              <div class="box-footer" align="right">
                <button type="button" id="btneditar" name="btneditar" class="btn btn-round btn-primary">
                  <span class="fa fa-refresh">&nbsp;&nbsp;&nbsp;</span>Actualizar Producto
                </button>
                          
                <button type="button" class="btn btn-round btn-default" onclick="location.href='../../pages/producto/producto_list.php'">
                  <span class="fa fa-ban">&nbsp;&nbsp;&nbsp;</span>Cancelar Proceso
                </button>
              </div>
            </div>
            <!-- /.box-body -->
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
<script src="../../build/validaciones/producto/producto_edit.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
</body>
</html>
<?php 

}else{
  header('location: ../../index.php');
}

?>