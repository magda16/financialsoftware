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
      <h1><i class="fa fa-cart-plus"></i>
        Compra
        <small>Registro</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
      <form id="form_compra" name="form_compra" action="" method="POST">
        <input type="hidden" name="bandera" id="bandera">
        <input type="hidden" name="id_producto" id="id_producto">

        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Carrito de Compra</h3>
            </div>
            <div class="box-body">

              <div class="row">

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="codigo"><i class="ic"></i> Código</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                    <input type="text" id="codigo" name="codigo" class="form-control" placeholder="Ingrese Código">
                  </div>
                  <span class="help-block"></span>
                </div>

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="cantidad"><i class="ic"></i> Cantidad a Comprar</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-quora"></i></span>
                    <input type="text" id="cantidad" name="cantidad" class="form-control" placeholder="Ingrese Cantidad">
                  </div>
                  <span class="help-block"></span>
                </div>       

              </div>

              <div class="row">

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="precio_compra"><i class="ic"></i> Precio de Compra Unitario</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                    <input type="text" id="precio_compra" name="precio_compra" class="form-control" placeholder="Ingrese Precio de Compra">
                  </div>
                  <span class="help-block"></span>
                </div>

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="subtotal"><i class="ic"></i> Subtotal</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                    <input type="text" id="subtotal" name="subtotal" class="form-control" readonly>
                  </div>
                  <span class="help-block"></span>
                </div>

              </div>

              <div class="form-group">
                <label class="control-label" for="producto"><i class="ic"></i> Producto</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                  <input type="text" id="producto" name="producto" class="form-control" readonly>
                </div>
                <span class="help-block"></span>
              </div>

              <div class="form-group">
                <label class="control-label" for="proveedor"><i class="ic"></i> Proveedor</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-building-o"></i></span>
                  <input type="text" id="proveedor" name="proveedor" class="form-control" readonly>
                </div>
                <span class="help-block"></span>
              </div>

            </div>
            <!-- /.box-body -->  
            <div class="box-footer" align="right">
              <button type="button" id="btnagregar" name="btnagregar" class="btn btn-round btn-info">
                <span class="fa fa-plus-circle">&nbsp;&nbsp;&nbsp;</span>Agregar Compra
              </button>
                        
            </div>
          </div>
          <!-- /.box -->

        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">

          <!-- general form elements disabled -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Datos Generales</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <div class="form-group">
                <label class="control-label" for="tipo_pago"><i class="ic"></i> Tipo de Pago</label>
                <select class="form-control" id="tipo_pago" name="tipo_pago">
                  <option selected="selected" value="">Seleccione Tipo de Pago...</option>
                  <option value="Credito">Crédito</option>
                  <option value="Contado">Contado</option>
                </select>
                <span class="help-block"></span>
              </div>
                
              <div class="row">

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="fecha"><i class="ic"></i> Fecha</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" id="fecha" name="fecha" class="form-control" placeholder="Ingrese Fecha" data-date-end-date = "0d">
                  </div>
                  <span class="help-block"></span>
                </div>

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="total"><i class="ic"></i> Total</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                    <input type="text" id="total" name="total" class="form-control" readonly>
                  </div>
                  <span class="help-block"></span>
                </div>

                

              </div>
            
            </div>
            <!-- /.box-body -->
            <div class="box-footer" align="right">
              <button type="button" id="btnguardar" name="btnguardar" class="btn btn-round btn-success">
                <span class="fa fa-floppy-o">&nbsp;&nbsp;&nbsp;</span>Guardar Compra
              </button>
                        
              <button type="submit" class="btn btn-round btn-default" onclick="cancelar()">
                <span class="fa fa-ban">&nbsp;&nbsp;&nbsp;</span>Cancelar Proceso
              </button>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->


        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Lista de Compras</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                  <tr>
                    <th>Producto</th>
                    <th>cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                  </tr>
              </thead>
              <tbody  id="filas" name="filas">

              </tfoot>
            </table>
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>

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
<script src="../../build/validaciones/compra/compra_add.js"></script>
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