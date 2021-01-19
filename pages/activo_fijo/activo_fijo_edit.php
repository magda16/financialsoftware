<?php
session_start();
$logueo=$_SESSION['acceso'];
if($logueo=='si'){

  include ("../../build/controladores/conexion.php");

  if(isset($_POST['id'])){
    $id_activo_fijo=$_POST['id'];
   // $id_activo_fijo=1;

    $stmt= $pdo->prepare("SELECT codigo, descripcion, observacion, calidad, marca, modelo, num_serie, lote, DATE_FORMAT(fecha_adquisicion, '%d/%m/%Y') AS fecha_adquisicion, financiamiento, anios_uso, valor_adquisicion, valor_estimado, valor_residual, vida_util, doc_adquisicion, id_categoria, id_subcategoria, id_proveedor FROM activo_fijo WHERE id_activo_fijo=:id_activo_fijo");
    $stmt->bindParam(":id_activo_fijo",$id_activo_fijo,PDO::PARAM_INT);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $lista_activo_fijo){ 
      $codigo_r=$lista_activo_fijo['codigo'];
      $descripcion_r=$lista_activo_fijo['descripcion'];
      $observacion_r=$lista_activo_fijo['observacion'];
      $calidad_r=$lista_activo_fijo['calidad'];
      $marca_r=$lista_activo_fijo['marca'];
      $modelo_r=$lista_activo_fijo['modelo'];
      $num_serie_r=$lista_activo_fijo['num_serie'];
      $lote_r=$lista_activo_fijo['lote'];
      $fecha_adquisicion_r=$lista_activo_fijo['fecha_adquisicion'];
      $financiamiento_r=$lista_activo_fijo['financiamiento'];
      $anios_uso_r=$lista_activo_fijo['anios_uso'];
      $valor_adquisicion_r=$lista_activo_fijo['valor_adquisicion'];
      $valor_estimado_r=$lista_activo_fijo['valor_estimado'];
      $valor_residual_r=$lista_activo_fijo['valor_residual'];
      $vida_util_r=$lista_activo_fijo['vida_util'];
      $doc_adquisicion_r=$lista_activo_fijo['doc_adquisicion'];
      $id_categoria_r=$lista_activo_fijo['id_categoria'];
      $id_subcategoria_r=$lista_activo_fijo['id_subcategoria'];
      $id_proveedor_r=$lista_activo_fijo['id_proveedor'];
      
    }
    $resultado_cod_inv = substr($codigo_r, 0 , -7);
    $resultado_co = substr($codigo_r, -6 , 6);
    
  }else{
    header('location: activo_fijo_list.php');
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
        <small>Mantenimiento</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
      <form id="form_activo_fijo" name="form_activo_fijo" action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="bandera" id="bandera">
        <input type="hidden" name="id_activo_fijo" id="id_activo_fijo" value="<?php echo $id_activo_fijo; ?>" >
        <input type="hidden" name="doc_adquisicion_r" id="doc_adquisicion_r" value="<?php echo $doc_adquisicion_r; ?>" >
        <input type="hidden" name="id_categoria" id="id_categoria" value="<?php echo $id_categoria_r; ?>" >
        <input type="hidden" name="id_subcategoria" id="id_subcategoria" value="<?php echo $id_subcategoria_r; ?>" >
        <input type="hidden" name="id_proveedor" id="id_proveedor" value="<?php echo $id_proveedor_r; ?>" >
        <input type="hidden" name="nserie" id="nserie" value="<?php echo $num_serie_r; ?>" >
        <input type="hidden" name="anios_u" id="anios_u" value="<?php echo $anios_uso_r; ?>" >


        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Datos Generales</h3>
            </div>
            <div class="box-body">

              <div class="form-group">
                <label class="control-label" for="categoria"><i class="ic"></i> Categoría</label>
                <select class="form-control" id="categoria" name="categoria" disabled>
                </select>
                <span class="help-block"></span>
              </div>

              <div class="form-group">
                <label class="control-label" for="tipo_bien"><i class="ic"></i> Tipo de Bien</label>
                <select class="form-control" id="tipo_bien" name="tipo_bien" disabled>
                </select>
                <span class="help-block"></span>
              </div>

              <div class="row">

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="codigo_inv"><i class="ic"></i> Código Inventario</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                    <input type="text" id="codigo_inv" name="codigo_inv" class="form-control" value="<?php echo $resultado_cod_inv; ?>" readonly>
                  </div>
                  <span class="help-block"></span>
                </div>

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="correlativo"><i class="ic"></i> Correlativo</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-hashtag"></i></span>
                    <input type="text" id="correlativo" name="correlativo" class="form-control" value="<?php echo $resultado_co; ?>" readonly>
                  </div>
                  <span class="help-block"></span>
                </div>

              </div>
              <div class="row">
                <div class="col-xs-6 form-group">
                  <label class="control-label" for="descripcion"><i class="ic"></i> Descripción</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
                    <textarea id="descripcion" name="descripcion" class="form-control" rows="2" placeholder="Ingrese Descripción"><?php echo $descripcion_r; ?></textarea>
                  </div>
                  <span class="help-block"></span>
                </div>

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="observacion"><i class="ic"></i> Observación</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
                    <textarea id="observacion" name="observacion" class="form-control" rows="2" placeholder="Ingrese Observación"><?php echo $observacion_r; ?></textarea>
                  </div>
                  <span class="help-block"></span>
                </div>
              </div>
              <div class="form-group has-success">
                <label class="control-label" for="calidad"><i class="fa fa-check"></i> Calidad</label>
                <div class="radio">
                  <label>
                    <input type="radio" name="calidad" id="bueno" value="Bueno" <?php if($calidad_r=="Bueno") echo "checked"; ?> >
                    Bueno
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="calidad" id="regular" value="Regular" <?php if($calidad_r=="Regular") echo "checked"; ?> >
                    Regular
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="calidad" id="malo" value="Malo" <?php if($calidad_r=="Malo") echo "checked"; ?>>
                    Malo
                  </label>
                </div>
              </div>

            </div>
            <!-- /.box-body -->     
          </div>
          <!-- /.box -->

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Datos del Activo Fijo</h3>
            </div>
            <div class="box-body">

              <div class="row">

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="marca"><i class="ic"></i> Marca</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                    <input type="text" id="marca" name="marca" class="form-control" placeholder="Ingrese Marca" value="<?php echo $marca_r; ?>">
                  </div>
                  <span class="help-block"></span>
                </div>

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="modelo"><i class="ic"></i> Modelo</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-tasks"></i></span>
                    <input type="text" id="modelo" name="modelo" class="form-control" placeholder="Ingrese Modelo" value="<?php echo $modelo_r; ?>">
                  </div>
                  <span class="help-block"></span>
                </div>

              </div>

              <div class="row">

                <?php if($num_serie_r != ""){ ?>
              
                <div class="col-xs-6 form-group">
                  <label class="control-label" for="nserie"><i class="ic"></i> Número de Serie</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-qrcode"></i></span>
                    <input type="text" id="nserie" name="nserie" class="form-control" placeholder="Ingrese Número de Serie" value="<?php echo $num_serie_r; ?>">
                  </div>
                  <span class="help-block"></span>
                </div>

                <?php }else{ ?>

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="lote"><i class="ic"></i> Lote</label>
                  <div class="input-group">
                    <span class="input-group-addon"> L</span>
                    <input type="text" id="lote" name="lote" class="form-control" value="<?php echo $lote_r; ?>" readonly>
                  </div>
                  <span class="help-block"></span>
                </div>

                <?php } ?>

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
                    <input type="text" id="fecha_adquisicion" name="fecha_adquisicion" class="form-control" placeholder="Ingrese Fecha: día/mes/año" data-date-end-date = "0d" value="<?php echo $fecha_adquisicion_r; ?>">
                  </div>
                  <span class="help-block"></span>
                </div>

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="financiamiento"><i class="ic"></i> Financiamiento</label>
                  <select class="form-control" id="financiamiento" name="financiamiento">
                    <option selected="selected" value="">Seleccione Financiamiento...</option>
                    <option value="Nuevo" <?php if($financiamiento_r=="Nuevo") echo "selected"; ?> >Nuevo</option>
                    <option value="Donado" <?php if($financiamiento_r=="Donado") echo "selected"; ?> >Donado</option>
                    <option value="Usado" <?php if($financiamiento_r=="Usado") echo "selected"; ?> >Usado</option>
                  </select>
                  <span class="help-block"></span>
                </div>

              </div>
                      
              <div class="row">

                <div class="col-xs-6 form-group" id="div_anios_uso">
                  <label class="control-label" for="anios_uso"><i class="ic"></i> Años de Uso</label>
                  <div class="input-group">
                    <input type="text" id="anios_uso" name="anios_uso" class="form-control" placeholder="Ingrese Años de Uso" value="<?php echo $anios_uso_r; ?>">
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
                    <input type="text" id="valor_adquisicion" name="valor_adquisicion" class="form-control" placeholder="Ingrese Valor de Adquisición" value="<?php echo $valor_adquisicion_r; ?>">
                  </div>
                  <span class="help-block"></span>
                </div>    

                <div class="col-xs-6 form-group has-success">
                  <label class="control-label" for="valor_estimado"><i class="fa fa-check"></i> Valor Estimado</label>
                  <div class="radio">
                    <label>
                      <input type="radio" name="valor_estimado" id="si" value="Si" <?php if($valor_estimado_r=="Si") echo "checked"; ?> >
                      Si
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="valor_estimado" id="no" value="No" <?php if($valor_estimado_r=="No") echo "checked"; ?> >
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
                    <input type="text" id="valor_residual" name="valor_residual" class="form-control" placeholder="Ingrese Valor Residual" value="<?php echo $valor_residual_r; ?>">
                  </div>
                  <span class="help-block"></span>
                </div>  

                <div class="col-xs-6 form-group">
                  <label class="control-label" for="vida_util"><i class="ic"></i> Vida Útil</label>
                  <div class="input-group">
                    
                    <input type="text" id="vida_util" name="vida_util" class="form-control" placeholder="Ingrese Vida Útil" value="<?php echo $vida_util_r; ?>">
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
              <button type="button" id="btneditar" name="btneditar" class="btn btn-round btn-primary">
                <span class="fa fa-refresh">&nbsp;&nbsp;&nbsp;</span>Actualizar Activo Fijo
              </button>
                        
              <button type="button" class="btn btn-round btn-default" onclick="location.href='../../pages/activo_fijo/activo_fijo_list.php'">
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
<script src="../../build/validaciones/activo_fijo/activo_fijo_edit.js"></script>
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