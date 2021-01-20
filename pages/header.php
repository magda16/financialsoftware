    <!-- Logo -->
    <a href="../../index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>FS</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Financial Software</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <?php
              include ("../../build/controladores/conexion.php");
                        
              $stmt1= $pdo->prepare("SELECT COUNT(id_producto) AS contador FROM producto WHERE cantidad < stock_minimo");
              $stmt1->execute();
              $result=$stmt1->fetchAll(PDO::FETCH_ASSOC);
              
              foreach($result as $cont){ 
              $contador_prod=$cont['contador'];
              }
            
        ?>

              <span class="label label-warning"><?php echo $contador_prod; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Tienes <?php echo $contador_prod; ?> notificaciones</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <?php      
                  $stmt1= $pdo->prepare("SELECT nombre, cantidad, stock_minimo FROM producto WHERE cantidad < stock_minimo ORDER BY cantidad");
                  $stmt1->execute();
                  $result=$stmt1->fetchAll(PDO::FETCH_ASSOC);
                  
                  foreach($result as $lista_productos){  
                   ?>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> <?php echo $lista_productos['nombre']."</br>Existencias: ".$lista_productos['cantidad'] ; ?>
                    </a>
                  </li>
              <?php
                $contador_prod++;
                }
              ?>
                </ul>
              </li>
              <li class="footer"><a href="../../pages/compra/compra_add.php">Agregar Productos</a></li>
            </ul>
          </li>
         
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../../dist/img/user2.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['usuario']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../../dist/img/user2.png" class="img-circle" alt="User Image">

                <p>
                  <?php echo $_SESSION['usuario']; ?>
                  <small><?php echo $_SESSION['nivel']; ?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                <button type="button" onclick="location.href='../../pages/acceso/salir.php'" class="btn bg-blue">
                  <span class="fa fa-sign-out">&nbsp;&nbsp;&nbsp;</span>Salir
                </button>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-question-circle"></i></a>
          </li>
        </ul>
      </div>
    </nav>