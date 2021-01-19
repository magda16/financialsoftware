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
      <h1><i class="fa fa-book"></i>
        Catálogo de Activo Fijo
        <small>Mantenimiento</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
      <form id="form_proveedor" name="form_proveedor" action="" method="POST">
        <input type="hidden" name="bandera" id="bandera">

        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Lista Catálogo de Activo Fijo</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
              <?php

                echo "<table id='datatable-responsive1' class='table table-striped table-bordered dt-responsive nowrap' cellspacing='0' width='100%'>";

                  include ("../../build/controladores/conexion.php");
                  $stmt= $pdo->prepare("SELECT * FROM activo_categoria ORDER BY categoria");
                  $stmt->execute();
                  $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
                  foreach($result as $lista_activo_categoria){
                    $id_activo_categoria=$lista_activo_categoria['id_activo_categoria'];

                    echo "<input type='hidden' name='bandera' id='bandera'>";
                    echo "<input type='hidden' name='baccion' id='baccion'>";

                    echo "<thead>";
                    echo "<tr>";
                    echo "<th colspan='2'> <h4 style='color: #00c0ef;'><strong>".$lista_activo_categoria['categoria'].".</strong></h4></th>";                    
                    echo "<th ><div align='center'><a id='paso4' href='../../pages/catalogo_activos/catalogo_subcategoria_add.php' class='btn btn-info' type='button' onclick='imprecepciondocumentos(".$id_activo_categoria.")' data-toggle='tooltip' data-placement='top' title='Agregar Tipo de Bien'><i class='fa fa-plus'></i></a>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<th color: RGB(0, 0, 128);'>No.</th>";
                    echo "<th color: RGB(0, 0, 128);'>C&oacute;digo</th>";
                    echo "<th color: RGB(0, 0, 128);'>Tipo de Bien</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";

                    $contador=1;
                    $stmt1= $pdo->prepare("SELECT id_activo_subcategoria, codigo, subcategoria FROM activo_subcategoria WHERE id_activo_categoria=:id_activo_categoria ORDER BY subcategoria");
                    $stmt1->bindParam(":id_activo_categoria",$id_activo_categoria,PDO::PARAM_INT);
                    $stmt1->execute();
                    $result1=$stmt1->fetchAll(PDO::FETCH_ASSOC);
                    foreach($result1 as $lista_activo_subcategoria){
                            
                      echo "<tr>";
                      echo "<td>" .$contador. "</td>";
                      echo "<td>" . $lista_activo_subcategoria['codigo'] . "</td>";
                      echo "<td>" . $lista_activo_subcategoria['subcategoria'] . "</td>";
                      echo "</tr>";
                
                      $contador++;
                    }
        
                  }

                  echo "</tbody>";
                  echo "</table>";
                ?>
              
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
<script src="../../build/validaciones/proveedor/proveedor_list.js"></script>
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