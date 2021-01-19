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
      <h1><i class="fa fa-ravelry"></i>
        Activo Fijo
        <small>Registro</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
      <form id="form_activo_fijo" name="form_activo_fijo" action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="bandera" id="bandera">

        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Datos Generales</h3>
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

              <div class="row">

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="codigo_inv"><i class="ic"></i> Código Inventario</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                    <input type="text" id="codigo_inv" name="codigo_inv" class="form-control" readonly>
                  </div>
                  <span class="help-block"></span>
                </div>

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="correlativo"><i class="ic"></i> Correlativo</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-hashtag"></i></span>
                    <input type="text" id="correlativo" name="correlativo" class="form-control" readonly>
                  </div>
                  <span class="help-block"></span>
                </div>

              </div>
              <div class="row">
                <div class="col-xs-6 form-group">
                  <label class="control-label" for="descripcion"><i class="ic"></i> Descripción</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
                    <textarea id="descripcion" name="descripcion" class="form-control" rows="2" placeholder="Ingrese Descripción"></textarea>
                  </div>
                  <span class="help-block"></span>
                </div>

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="observacion"><i class="ic"></i> Observación</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
                    <textarea id="observacion" name="observacion" class="form-control" rows="2" placeholder="Ingrese Observación"></textarea>
                  </div>
                  <span class="help-block"></span>
                </div>
              </div>
              <div class="form-group has-success">
                <label class="control-label" for="calidad"><i class="fa fa-check"></i> Calidad</label>
                <div class="radio">
                  <label>
                    <input type="radio" name="calidad" id="bueno" value="Bueno" checked>
                    Bueno
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="calidad" id="regular" value="Regular">
                    Regular
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="calidad" id="malo" value="Malo">
                    Malo
                  </label>
                </div>
              </div>

            </div>
            <!-- /.box-body -->     
          </div>
          <!-- /.box -->

          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Datos del Activo Fijo</h3>
            </div>
            <div class="box-body">

              <div class="row">

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="marca"><i class="ic"></i> Marca</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                    <input type="text" id="marca" name="marca" class="form-control" placeholder="Ingrese Marca">
                  </div>
                  <span class="help-block"></span>
                </div>

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="modelo"><i class="ic"></i> Modelo</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-tasks"></i></span>
                    <input type="text" id="modelo" name="modelo" class="form-control" placeholder="Ingrese Modelo">
                  </div>
                  <span class="help-block"></span>
                </div>

              </div>

              <div class="row">

                <div class="col-xs-6 form-group">
                  <label class="control-label">Lote &nbsp;&nbsp;</label>
                    <input type="checkbox" class="js-switch" id="switch1" name="switch1"/>
                </div>

                <div id="gruposerie">
              
                    <div class="col-xs-6 form-group" id="divserie">
                      <label class="control-label" for="nserie"><i class="ic"></i> Número de Serie</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-qrcode"></i></span>
                        <input type="text" id="nserie" name="nserie" class="form-control" placeholder="Ingrese Número de Serie">
                      </div>
                      <span class="help-block"></span>
                    </div>

                </div>

                <div class="col-xs-6 form-group" id="divcantidad_lote">
                  <label class="control-label" for="cantidad"><i class="ic"></i> Cantidad</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-quora"></i></span>
                    <input type="text" id="cantidad" name="cantidad" class="form-control" placeholder="Ingrese Cantidad">
                  </div>
                  <span class="help-block"></span>
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
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Forma de Financiamiento</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <div class="form-group">
                <label class="control-label" for="proveedor"><i class="ic"></i> Proveedor</label>
                <select class="form-control" id="proveedor" name="proveedor">
                </select>
                <span class="help-block"></span>
              </div>

              <div class="row">

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="fecha_adquisicion"><i class="ic"></i> Fecha de Adquisición</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" id="fecha_adquisicion" name="fecha_adquisicion" class="form-control" placeholder="Ingrese Fecha: día/mes/año" data-date-end-date = "0d">
                  </div>
                  <span class="help-block"></span>
                </div>

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="financiamiento"><i class="ic"></i> Financiamiento</label>
                  <select class="form-control" id="financiamiento" name="financiamiento">
                    <option selected="selected" value="">Seleccione Financiamiento...</option>
                    <option value="Nuevo">Nuevo</option>
                    <option value="Donado">Donado</option>
                    <option value="Usado">Usado</option>
                  </select>
                  <span class="help-block"></span>
                </div>

              </div>

              <div class="row">

                <div class="col-xs-6 form-group" id="div_anios_uso">
                  <label class="control-label" for="anios_uso"><i class="ic"></i> Años de Uso</label>
                  <div class="input-group">
                    <input type="text" id="anios_uso" name="anios_uso" class="form-control" placeholder="Ingrese Años de Uso">
                    <span class="input-group-addon"> años</span>
                  </div>
                  <span class="help-block"></span>
                </div> 
                
              </div>

              <div class="row">

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="valor_adquisicion"><i class="ic"></i> Valor de Adquisición</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                    <input type="text" id="valor_adquisicion" name="valor_adquisicion" class="form-control" placeholder="Ingrese Valor de Adquisición">
                  </div>
                  <span class="help-block"></span>
                </div>    

                <div class="col-xs-6 form-group has-success">
                  <label class="control-label" for="valor_estimado"><i class="fa fa-check"></i> Valor Estimado</label>
                  <div class="radio">
                    <label>
                      <input type="radio" name="valor_estimado" id="si" value="Si" checked>
                      Si
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="valor_estimado" id="no" value="No">
                      No
                    </label>
                  </div>
                </div>

              </div>

              <div class="row">

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="valor_residual"><i class="ic"></i> Valor Residual</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                    <input type="text" id="valor_residual" name="valor_residual" class="form-control" placeholder="Ingrese Valor Residual">
                  </div>
                  <span class="help-block"></span>
                </div>  

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="vida_util"><i class="ic"></i> Vida Útil</label>
                  <div class="input-group">
                    <input type="text" id="vida_util" name="vida_util" class="form-control" placeholder="Ingrese Vida Útil">
                    <span class="input-group-addon"> años</span>
                  </div>
                  <span class="help-block"></span>
                </div> 

              </div>

              <div class="form-group">
                <label class="control-label" for="doc_adquisicion"><i class="ic"></i> Documento de Adquisición</label>
                <input type="file" id="doc_adquisicion" name="doc_adquisicion" accept=".pdf,.jpg,.png"/>
                <span class="help-block"></span>
              </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer" align="right">
              <button type="button" id="btnguardar" name="btnguardar" class="btn btn-round btn-success">
                <span class="fa fa-floppy-o">&nbsp;&nbsp;&nbsp;</span>Guardar Activo Fijo
              </button>
                        
              <button type="button" class="btn btn-round btn-default" onclick="location.href='../../pages/activo_fijo/activo_fijo_add.php'">
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
<script src="../../build/validaciones/activo_fijo/activo_fijo_add.js"></script>
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