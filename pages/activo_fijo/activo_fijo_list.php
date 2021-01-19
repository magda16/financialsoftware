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
  <!-- DataTables -->
  <link rel="stylesheet" href="../../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
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
      
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Lista de Activos Fijos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <form id="form_activo_fijo" name="form_activo_fijo" action="" method="POST">
                <div class="row">
                  <div class="col-xs-3 form-group">
                    <label class="control-label" for="categoria"><i class="ic"></i> Categoría</label>
                    <select class="form-control" id="categoria" name="categoria">
                    </select>
                    <span class="help-block"></span>
                  </div>

                  <div class="col-xs-3 form-group">
                    <label class="control-label" for="tipo_bien"><i class="ic"></i> Tipo de Bien</label>
                    <select class="form-control" id="tipo_bien" name="tipo_bien">
                    </select>
                    <span class="help-block"></span>
                  </div>

                  </br>
                  <div class="col-xs-3">
                    <button type="button" id="btngenerar" name="btngenerar" class="btn bg-olive"><span class="fa fa-repeat">&nbsp;&nbsp;</span> Generar</button>
                  </div>

                </div>
              </form>
   
              <div class="margin">
                <div class="btn-group">
                  <button type="button" class="btn btn-info">Acciones</button>
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a onclick="mostrar_activo()">Activo</a></li>
                    <li><a onclick="mostrar_inactivo()">Inactivo</a></li>
                  </ul>
                </div>
              </div>

              <!-- /.inicio tabla -->
              <div id="div_activo_fijo_table">
              </div>

              <form id="from_activo_fijo_edit" name="from_activo_fijo_edit" action="activo_fijo_edit.php" method="POST">
                <input type="hidden" id="id" name="id">
              </form>

              <!-- Modal -->
              <form id="form_activo_fijo_baja_alta" name="form_activo_fijo_baja_alta" action="" method="POST" enctype="multipart/form-data">
              <div class="modal fade" id="darBaja" name="darBaja" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                <input type="hidden" name="bandera" id="bandera">
                <input type="hidden" name="baccion" id="baccion">
                <div class="modal-dialog ">
                  <div class="modal-content">

                    <div class="modal-header">
                      <h3 class="modal-title" id="myModalLabel"><i class="fa fa-ravelry"></i>
                        Activo Fijo
                        <small>Mantenimiento</small>
                      </h3>
                    </div>
                        
                    <div class="modal-body">
                    <br/>
                        
                      <div class="row">
                  
                        <div class="col-xs-12 form-group" >
                          <label class="control-label" for="observacion"><i class="ic"></i> Observación</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
                            <textarea id="observacion" name="observacion" class="form-control" rows="2" placeholder="Ingrese Observación"></textarea>
                          </div>
                          <span class="help-block"></span>
                        </div>

                      </div>
                          
                    </div>
                    <div class="modal-footer">
                      <p align="left" style="color:RGB(205, 92, 92);">Campo Obligatorio.</p>
                      <button type="button" id="btneditarmodal" name="btneditarmodal" class="btn btn-round btn-primary">
                        <span class="fa fa-refresh">&nbsp;&nbsp;&nbsp;</span>Actualizar Activo Fijo
                      </button>
                                
                      <button type="button" class="btn btn-round btn-default" onclick="location.href='../../pages/activo_fijo/activo_fijo_list.php'">
                        <span class="fa fa-ban">&nbsp;&nbsp;&nbsp;</span>Cancelar Proceso
                      </button>
                    </div>

                  </div>
                </div>
              </div>
              </form>
              <!-- Fin Modal -->
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        
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
  <?php include("../ayuda_lista.php"); ?>
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
<!-- DataTables -->
<script src="../../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- PNotify -->
<script src="../../plugins/PNotify/dist/iife/PNotify.js"></script>
<script src="../../plugins/PNotify/dist/iife/PNotifyButtons.js"></script>
<script src="../../plugins/PNotify/dist/iife/PNotifyConfirm.js"></script>
<script src="../../plugins/PNotify/dist/iife/PNotifyMobile.js"></script>
<!-- Validate -->
<script src="../../plugins/validar/jquery.validate.js"></script>
<script src="../../build/validaciones/activo_fijo/activo_fijo_list.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
</body>
</html>