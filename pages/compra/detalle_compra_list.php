<?php
/*session_start();
$logueo=$_SESSION['acceso'];
if($logueo=='si'){
include ("../build/conexion.php");
$nivel_usu=$_SESSION['nivel'];*/

  include ("../../build/controladores/conexion.php");

  if(isset($_POST['id'])){
    $id_compra=$_POST['id'];
  }else{
    header('location: compra_list.php');
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
              <button type="button" class="btn bg-blue" onclick="location.href='../../pages/compra/compra_list.php'">
                <span class="fa fa-arrow-circle-left">&nbsp;&nbsp;&nbsp;</span>Regresar
              </button>
              <h3 class="box-title">&nbsp;&nbsp;&nbsp;Detalle de Compras</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th>#</th>
                      <th>Producto</th>
                      <th>Cantidad</th>
                      <th>Precio</th>
                      <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $contador=1;
                                
                    $stmt1= $pdo->prepare("SELECT dc.cantidad, dc.precio, dc.id_producto, p.nombre, (dc.cantidad * dc.precio) AS subtotal FROM detalle_compra AS dc INNER JOIN producto AS p ON (dc.id_producto=p.id_producto) WHERE id_compra=:id_compra");
                    $stmt1->bindParam(":id_compra",$id_compra,PDO::PARAM_INT);
                    $stmt1->execute();
                    $result=$stmt1->fetchAll(PDO::FETCH_ASSOC);
                    $total=0;
                    foreach($result as $lista_detalle_compra){
                      echo "<tr>";
                        echo "<td>" .$contador. "</td>";
                        echo "<td>" . $lista_detalle_compra['nombre'] . "</td>";
                        echo "<td>" . $lista_detalle_compra['cantidad'] . "</td>";
                        echo "<td> $ " . $lista_detalle_compra[ 'precio'] ."</td>";
                        echo "<td> $ " . $lista_detalle_compra[ 'subtotal'] ."</td>";
                      echo "</tr>";
                      $contador++;
                      $total= ($total + $lista_detalle_compra[ 'subtotal']);
                    }
                ?>
                </tbody>
                </tfoot>
                <span class="label label-info fa fa-caret-right">&nbsp;&nbsp;<?php echo "TOTAL DETALLE DE COMPRA $".$total; ?> &nbsp;</span>
                </br></br>
              </table>
              
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

<script type="text/javascript">
  $(document).ready(function(){
    table=$('#example1').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
      }
    });

  });
</script>

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
