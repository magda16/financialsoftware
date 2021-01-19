<?php

  if(isset($_POST['activo_fijo'])){
    $fecha="";
    $id_activo_fijo = $_POST['activo_fijo']; 
    $fecha = $_POST['fecha'];

    include ("../../build/controladores/conexion.php");
    //$stmt= $pdo->prepare("SELECT * FROM activo_fijo WHERE id_activo_fijo=:id_activo_fijo");
    
    $stmt= $pdo->prepare("SELECT af.codigo, DATE_FORMAT(af.fecha_adquisicion, '%d/%m/%Y') AS fecha_adquisicion, af.financiamiento, af.valor_adquisicion, af.valor_residual, af.vida_util, ac.categoria, asub.subcategoria FROM activo_fijo AS af INNER JOIN activo_categoria AS ac ON (af.id_categoria=ac.id_activo_categoria) INNER JOIN activo_subcategoria AS asub ON (af.id_subcategoria=asub.id_activo_subcategoria) WHERE af.id_activo_fijo=:id_activo_fijo");
    $stmt->bindParam(":id_activo_fijo",$id_activo_fijo,PDO::PARAM_INT);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    $contador=1;
    foreach($result as $lista_activo_fijo){
      $categoria=$lista_activo_fijo['categoria'];
      $subcategoria=$lista_activo_fijo['subcategoria'];
      $codigo_activo=$lista_activo_fijo['codigo'];
      $valor_adq=$lista_activo_fijo['valor_adquisicion'];
      $valor_residual=$lista_activo_fijo['valor_residual'];
      $vida_util=$lista_activo_fijo['vida_util'];
      $financiamiento=$lista_activo_fijo['financiamiento'];
      $fecha_adquisicion=$lista_activo_fijo['fecha_adquisicion'];
    }
      date_default_timezone_set('America/El_Salvador');
      
      if($fecha != ""){
        $fecha_actual=$fecha;
      }else{
        $fecha_actual=date("d/m/Y");
      }

      $fecha_adq=$fecha_adquisicion;
      list($dia, $mes, $year)=explode("/", $fecha_adquisicion);
      $fecha_adq_anio=$year;
      $fecha_adq_mes=$mes;
      $fecha_adq_dia=$dia;

      $fecha_actuald=$fecha_actual;
      list($dia, $mes, $year)=explode("/", $fecha_actual);
      $fecha_actuald_anio=$year;
      $fecha_actuald_mes=$mes;
      $fecha_actuald_dia=$dia;

      $fecha_calculo_anio=(($fecha_actuald_anio - $fecha_adq_anio) * 360);
      $fecha_calculo_mes=(($fecha_actuald_mes - $fecha_adq_mes) * 30);
      $fecha_calculo_dia=$fecha_actuald_dia - $fecha_adq_dia;

      $dias=$fecha_calculo_anio + $fecha_calculo_mes + $fecha_calculo_dia;
      
      $anios=($dias / 360);
      $meses=($dias / 30);

      if($financiamiento == "Nuevo" || $financiamiento == "Donado"){
        $porcentaje=100;
        $costo=$valor_adq;
      }else if($financiamiento == "Usado"){
        if($anios > 0 && $anios <= 1 ){
          $porcentaje=80;
          $costo=($valor_adq * (80/100));
        }else if($anios > 1 && $anios <= 2 ){
          $porcentaje=60;
          $costo=($valor_adq * (60/100));
        }else if($anios > 2 && $anios <= 3 ){
          $porcentaje=40;
          $costo=($valor_adq * (40/100));
        }else if($anios > 3 && $anios <= $vida_util ){
          $porcentaje=20;
          $costo=($valor_adq * (20/100));
        }
      }

  }else{
    header('location: depreciacion_add.php');
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
      <h1><i class="fa fa-calculator"></i>
        Calcular Depreciación
        <small>Mantenimiento</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
      

        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Datos del Activo Fijo a Depreciar</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <?php

              echo "<table id='datatable-responsive1' class='table table-striped table-bordered dt-responsive nowrap' cellspacing='0' width='100%'>";
              echo "<tbody>";

              echo "<tr>";
              echo "<th>Categoría</th>";
              echo "<td>".$categoria."</td>";
              echo "<th>Costo</th>";
              echo "<td> $ ".$costo."</td>";
              echo "</tr>";

              echo "<tr>";
              echo "<th>Tipo de Bien</th>";
              echo "<td>".$subcategoria."</td>";
              echo "<th>Valor Residual</th>";
              echo "<td> $ ".$valor_residual."</td>";
              echo "</tr>";

              echo "<tr>";
              echo "<th>Código</th>";
              echo "<td>".$codigo_activo."</td>";
              echo "<th>Vida Útil</th>";
              echo "<td>".$vida_util." años</td>";
              echo "</tr>";

              echo "<tr>";
              echo "<th>Financiamiento</th>";
              echo "<td>".$financiamiento."</td>";
              echo "<th>Porcentaje a depreciar</th>";
              echo "<td>".$porcentaje." % </td>";
              echo "</tr>";

              echo "<tr>";
              echo "<th>Valor Adquisición</th>";
              echo "<td> $ ".$valor_adq."</td>";
              echo "<th></th>";
              echo "<td></td>";
              echo "</tr>";

              echo "</tbody>";
              echo "</table>";
              echo "</br>";

            ?>
     
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Depreciación Hasta la Fecha
                <small>Método Líneal</small>
              </h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"
                        title="Mostrar">
                  <i class="fa fa-minus"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">

            <?php

              $depreciacion_anual=(($costo - $valor_residual) / $vida_util);
              $depreciacion_acumulada_anual=$depreciacion_anual;
              $valor_libros_anual=$costo-$depreciacion_anual;
              $depre_anual=($depreciacion_anual * $anios);

              $vida_util_mes=$vida_util * 12;
              $depreciacion_mensual=(($costo - $valor_residual) / $vida_util_mes);
              $depreciacion_acumulada_mensual=$depreciacion_mensual;
              $valor_libros_mensual=$costo-$depreciacion_mensual;
              $depre_mensual= ($depreciacion_mensual * $meses);

              $vida_util_dia=$vida_util * 360;
              $depreciacion_diaria=(($costo - $valor_residual) / $vida_util_dia);
              $depreciacion_acumulada_diaria=$depreciacion_diaria;
              $valor_libros_diaria=$costo-$depreciacion_diaria;
              $depre_diaria=($depreciacion_diaria * $dias);

              echo "<table id='datatable-responsive1' class='table table-striped table-bordered dt-responsive nowrap' cellspacing='0' width='100%'>";
  
                echo "<tbody>";
                echo "<tr>";
                echo "<th>Fecha Adquisición</th>";
                echo "<td>".$fecha_adquisicion."</td>";
                echo "<th colspan='2'>Fecha a Calcular Depreciación</th>";
                echo "<td colspan='2'>".$fecha_actual."</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<th></th>";
                echo "<th>Depreciación</th>";
                echo "<th></th>";
                echo "<th>Periodo</th>";
                echo "<th></th>";
                echo "<th>Resultado</th>";
                echo "</tr>";

                echo "<tr>";
                echo "<th>Depreciación Anual</th>";
                echo "<td> $ ".$depreciacion_anual."</td>";
                echo "<th>*</th>";
                echo "<td>".$anios." año</td>";
                echo "<th>=</th>";
                echo "<th> $ ".$depre_anual."</th>";
                echo "</tr>";

                echo "<tr>";
                echo "<th>Depreciación Mensual</th>";
                echo "<td> $ ".$depreciacion_mensual."</td>";
                echo "<th>*</th>";
                echo "<td>".$meses." mes</td>";
                echo "<th>=</th>";
                echo "<th> $ ".$depre_mensual."</th>";
                echo "</tr>";

                echo "<tr>";
                echo "<th>Depreciación Diaria</th>";
                echo "<td> $ ".$depreciacion_diaria."</td>";
                echo "<th>*</th>";
                echo "<td>".$dias." día</td>";
                echo "<th>=</th>";
                echo "<th> $ ".$depre_diaria."</th>";
                echo "</tr>";
             
              echo "</tbody>";
              echo "</table>";

            ?>

            </div>
          </div>
          <!-- /.box -->

          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Depreciación Anual
                <small>Método Líneal</small>
              </h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"
                        title="Mostrar">
                  <i class="fa fa-minus"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">

            <?php

              echo "<table id='datatable-responsive1' class='table table-striped table-bordered dt-responsive nowrap' cellspacing='0' width='100%'>";
              echo "<thead>";
              echo "<th>PERIODO</th>";
              echo "<th>DEPRECIACIÓN ANUAL</th>";
              echo "<th>DEPRECIACIÓN ACUMULADA</th>";
              echo "<th>VALOR EN LIBROS</th>";
              echo "</thead>";
              echo "<tbody>";
                echo "<tr>";
                echo "<td>0</td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td> $ ".$costo."</td>";
                echo "</tr>";
              $contador_anio=1;
              
              for($i=0 ; $i <$vida_util; $i++){
                echo "<tr>";
                echo "<td>".$contador_anio."</td>";
                echo "<td> $ ".$depreciacion_anual."</td>";
                echo "<td> $ ".$depreciacion_acumulada_anual."</td>";
                echo "<td> $ ".$valor_libros_anual."</td>";
                echo "</tr>";
                $contador_anio++;
                $depreciacion_acumulada_anual=$depreciacion_acumulada_anual + $depreciacion_anual;
                $valor_libros_anual=$valor_libros_anual - $depreciacion_anual;
              }

              echo "</tbody>";
              echo "</table>";

            ?>

            </div>
          </div>
          <!-- /.box -->

          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Depreciación Mensual
                <small>Método Líneal</small>
              </h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"
                        title="Mostrar">
                  <i class="fa fa-minus"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">

            <?php

              echo "<table id='datatable-responsive1' class='table table-striped table-bordered dt-responsive nowrap' cellspacing='0' width='100%'>";
              echo "<thead>";
              echo "<th>PERIODO</th>";
              echo "<th>DEPRECIACIÓN MENSUAL</th>";
              echo "<th>DEPRECIACIÓN ACUMULADA</th>";
              echo "<th>VALOR EN LIBROS</th>";
              echo "</thead>";
              echo "<tbody>";
                echo "<tr>";
                echo "<td>0</td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td> $ ".$costo."</td>";
                echo "</tr>";
              $contador_mes=1;
             
              for($i=0 ; $i <$vida_util_mes; $i++){
                echo "<tr>";
                echo "<td>".$contador_mes."</td>";
                echo "<td> $ ".$depreciacion_mensual."</td>";
                echo "<td> $ ".$depreciacion_acumulada_mensual."</td>";
                echo "<td> $ ".$valor_libros_mensual."</td>";
                echo "</tr>";
                $contador_mes++;
                $depreciacion_acumulada_mensual=$depreciacion_acumulada_mensual + $depreciacion_mensual;
                $valor_libros_mensual=$valor_libros_mensual- $depreciacion_mensual;
              }

              echo "</tbody>";
              echo "</table>";

            ?>

            </div>
          </div>
          <!-- /.box -->

          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Depreciación Diaria
                <small>Método Líneal</small>
              </h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"
                        title="Mostrar">
                  <i class="fa fa-minus"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">

            <?php

              echo "<table id='datatable-responsive1' class='table table-striped table-bordered dt-responsive nowrap' cellspacing='0' width='100%'>";
              echo "<thead>";
              echo "<th>PERIODO</th>";
              echo "<th>DEPRECIACIÓN DIARIA</th>";
              echo "<th>DEPRECIACIÓN ACUMULADA</th>";
              echo "<th>VALOR EN LIBROS</th>";
              echo "</thead>";
              echo "<tbody>";
                echo "<tr>";
                echo "<td>0</td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td> $ ".$costo."</td>";
                echo "</tr>";
              $contador_dia=1;
              
              for($i=0 ; $i <$vida_util_dia; $i++){
                echo "<tr>";
                echo "<td>".$contador_dia."</td>";
                echo "<td> $ ".$depreciacion_diaria."</td>";
                echo "<td> $ ".$depreciacion_acumulada_diaria."</td>";
                echo "<td> $ ".$valor_libros_diaria."</td>";
                echo "</tr>";
                $contador_dia++;
                $depreciacion_acumulada_diaria=$depreciacion_acumulada_diaria + $depreciacion_diaria;
                $valor_libros_diaria=$valor_libros_diaria- $depreciacion_diaria;
              }

              echo "</tbody>";
              echo "</table>";

            ?>
              
            </div>
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
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
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
<!-- Validate 
<script src="../../plugins/validar/jquery.validate.js"></script>
<script src="../../build/validaciones/depreciacion/depreciacion_list.js"></script> -->
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
</body>
</html>