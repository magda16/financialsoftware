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
      <h1><i class="fa fa-cart-plus"></i>
        Compra
        <small>Mantenimiento</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
    
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Lista de Compras Realizadas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
            </br>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th>#</th>
                      <th>Fecha</th>
                      <th>Tipo de Pago</th>
                      <th>Monto</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include ("../../build/controladores/conexion.php");
                    $contador=1;
                                
                    $stmt1= $pdo->prepare("SELECT id_compra, tipo_pago, monto, DATE_FORMAT(fecha, '%d/%m/%Y') AS fecha, estado FROM compra ORDER BY fecha");
                    $stmt1->bindParam(":estado",$estado_list,PDO::PARAM_STR);
                    $stmt1->execute();
                    $result=$stmt1->fetchAll(PDO::FETCH_ASSOC);
                    foreach($result as $lista_compra){
                        echo "<tr>";
                            echo "<td>" .$contador. "</td>";
                            echo "<td>" . $lista_compra['fecha'] . "</td>";
                            echo "<td>" . $lista_compra['tipo_pago'] . "</td>";
                            echo "<td> $ " . $lista_compra[ 'monto'] ."</td>";
                            echo "<td>" . $lista_compra[ 'estado'] ."</td>";
                            echo "<td>";
                            echo "<a class='btn bg-purple' onclick='detalle_compra(".$lista_compra['id_compra'].")' data-toggle='tooltip' data-placement='top' title='Detalle de Compra'><i class='fa fa-calendar-plus-o'></i>&nbsp;&nbsp;Detalle</a>";
                            echo "</td>";
                        echo "</tr>";
                        $contador++;
                    }
                ?>
         
                </tfoot>
              </table>

              <form id="from_detalle_compra" name="from_detalle_compra" action="detalle_compra_list.php" method="POST">
                <input type="hidden" id="id" name="id">
              </form>
              
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
<script src="../../build/validaciones/compra/compra_list.js"></script>
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
