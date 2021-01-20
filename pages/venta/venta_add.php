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
      <h1><i class="fa fa-cart-arrow-down"></i>
        Venta
        <small>Registro</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
      

      <form id="form_agregar_venta" name="form_agregar_venta" action="" method="POST">
        <input type="hidden" name="id_producto" id="id_producto">

        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Carrito de Venta</h3>
            </div>
            <div class="box-body">
              
             
              <span class="label label-info fa fa-search">&nbsp;&nbsp;Buscar por Nombre: &nbsp;</span>
              <div class="row">
                <div class="col-xs-6 form-group">
                  <label class="control-label" for="categoria"><i class="ic"></i> Categoría</label>
                  <select class="form-control" id="categoria" name="categoria">
                  </select>
                  <span class="help-block"></span>
                </div> 

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="s_producto"><i class="ic"></i> Producto</label>
                  <select class="form-control" id="s_producto" name="s_producto">
                  </select>
                  <span class="help-block"></span>
                </div>     

              </div>

              <span class="label label-info fa fa-search">&nbsp;&nbsp;Buscar por Código: &nbsp;</span>
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
                  <label class="control-label" for="existencias"><i class="ic"></i> Existencias</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-quora"></i></span>
                    <input type="text" id="existencias" name="existencias" class="form-control" readonly>
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

              <div class="row">

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="precio_venta"><i class="ic"></i> Precio de Venta Unitario</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                    <input type="text" id="precio_venta" name="precio_venta" class="form-control" readonly>
                  </div>
                  <span class="help-block"></span>
                </div>

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="cantidad"><i class="ic"></i> Cantidad a Vender</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-quora"></i></span>
                    <input type="text" id="cantidad" name="cantidad" class="form-control" placeholder="Ingrese Cantidad">
                  </div>
                  <span class="help-block"></span>
                </div>

              </div>

            </div>
            <!-- /.box-body -->  
            <div class="box-footer" align="right">
              <button type="button" id="btnagregar" name="btnagregar" class="btn btn-round btn-info">
                <span class="fa fa-plus-circle">&nbsp;&nbsp;&nbsp;</span>Agregar Venta
              </button>
                        
            </div>
          </div>
          <!-- /.box -->

        </div>
        <!--/.col (left) -->
      </form>

      <form id="form_venta" name="form_venta" action="../../report/venta/ticket.php" method="POST" target="_blank">
        <input type="hidden" name="bandera" id="bandera">
          
        <!-- right column -->
        <div class="col-md-6">

          <!-- general form elements disabled -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Datos Comprobante</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

 <!--
              <div class="row">

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="fecha"><i class="ic"></i> Fecha</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" id="fecha" name="fecha" class="form-control" placeholder="Ingrese Fecha" data-date-end-date = "0d">
                  </div>
                  <span class="help-block"></span>
                </div>     

              </div>
-->
              <div class="row">

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="tipo_comprobante"><i class="ic"></i> Tipo de Comprobante</label>
                  <select class="form-control" id="tipo_comprobante" name="tipo_comprobante">
                    <option selected="selected" value="">Seleccione Tipo Comprobante...</option>
                    <option value="Ticket">Ticket</option>
                    <option value="Consumidor Final">Consumidor Final</option>
                  </select>
                  <span class="help-block"></span>
                </div>

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="correlativo"><i class="ic"></i> No:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-hashtag"></i></span>
                    <input type="text" id="correlativo" name="correlativo" class="form-control" readonly>
                  </div>
                  <span class="help-block"></span>
                </div>

              </div>

              <div class="form-group">
                <label class="control-label" for="cliente"><i class="ic"></i> Cliente</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" id="cliente" name="cliente" class="form-control" placeholder="Ingrese Cliente">
                </div>
                <span class="help-block"></span>
              </div>

              <div class="row">

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="productos"><i class="ic"></i> Productos</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-quora"></i></span>
                    <input type="text" id="productos" name="productos" class="form-control" readonly>
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

              <div class="row">

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="efectivo"><i class="ic"></i> Efectivo</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                    <input type="text" id="efectivo" name="efectivo" class="form-control" placeholder="Ingrese Efectivo">
                  </div>
                  <span class="help-block"></span>
                </div>   

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="cambio"><i class="ic"></i> Cambio</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                    <input type="text" id="cambio" name="cambio" class="form-control" readonly>
                  </div>
                  <span class="help-block"></span>
                </div>

              </div>
            
            </div>
            <!-- /.box-body -->
            <div class="box-footer" align="right">
              <button type="button" id="btnguardar" name="btnguardar" class="btn btn-round btn-success">
                <span class="fa fa-floppy-o">&nbsp;&nbsp;&nbsp;</span>Guardar Venta
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
              <h3 class="box-title">Lista de Ventas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                  <tr>
                    <th>cantidad</th>
                    <th>Detalle</th>
                    <th>Precio por unidad</th>
                    <th>Total</th>
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
<script src="../../build/validaciones/venta/venta_add.js"></script>
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