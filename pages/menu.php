<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Conectado</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENÚ PRINCIPAL</li>
       
        <li>
          <a href="../../pages/acceso/inicio.php">
            <i class="fa fa-th"></i> <span>Inicio</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-olive">Bienvenido</small>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user-md"></i>
            <span>Empleado</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../../pages/empleado/empleado_add.php"><i class="fa fa-plus-circle"></i> Agregar</a></li>
            <li><a href="../../pages/empleado/empleado_list.php"><i class="fa fa-wrench"></i> Mantenimiento</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-building-o"></i>
            <span>Proveedor</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../../pages/proveedor/proveedor_add.php"><i class="fa fa-plus-circle"></i> Agregar</a></li>
            <li><a href="../../pages/proveedor/proveedor_list.php"><i class="fa fa-wrench"></i> Mantenimiento</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-linode"></i>
            <span>Departamento</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../../pages/departamento/departamento_add.php"><i class="fa fa-plus-circle"></i> Agregar</a></li>
            <li><a href="../../pages/departamento/departamento_list.php"><i class="fa fa-wrench"></i> Mantenimiento</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-ravelry"></i>
            <span>Activo Fijo</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <a href="#"><i class="fa fa-book"></i> Catálogo
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="../../pages/catalogo_activos/catalogo_categoria_add.php"><i class="fa fa-plus-circle"></i> Agregar</a></li>
                <li><a href="../../pages/catalogo_activos/catalogo_activos_list.php"><i class="fa fa-wrench"></i> Mantenimiento</a></li>
              </ul>
            </li>
            <li><a href="../../pages/activo_fijo/activo_fijo_add.php"><i class="fa fa-plus-circle"></i> Agregar</a></li>
            <li><a href="../../pages/activo_fijo/activo_fijo_list.php"><i class="fa fa-wrench"></i> Mantenimiento</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-bookmark"></i>
            <span>Depreciación</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../../pages/depreciacion/depreciacion_add.php"><i class="fa fa-calculator"></i> Calcular Depreciación</a></li>
          </ul>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Cliente</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../../pages/cliente/cliente_add.php"><i class="fa fa-plus-circle"></i> Agregar</a></li>
            <li><a href="../../pages/cliente/cliente_list.php"><i class="fa fa-wrench"></i> Mantenimiento Persona</a></li>
            <li><a href="../../pages/cliente/cliente_institucion_list.php"><i class="fa fa-wrench"></i> Mantenimiento Institución</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cubes"></i>
            <span>Producto</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../../pages/producto/producto_add.php"><i class="fa fa-plus-circle"></i> Agregar</a></li>
            <li><a href="../../pages/producto/producto_list.php"><i class="fa fa-wrench"></i> Mantenimiento</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cart-plus"></i>
            <span>Compra</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../../pages/compra/compra_add.php"><i class="fa fa-plus-circle"></i> Agregar</a></li>
            <li><a href="../../pages/compra/compra_list.php"><i class="fa fa-wrench"></i> Mantenimiento</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-archive"></i>
            <span>Inventario</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../../pages/inventario/kardex_list.php"><i class="fa fa-table"></i> Kardex</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cart-arrow-down"></i>
            <span>Venta Contado</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../../pages/venta/venta_add.php"><i class="fa fa-plus-circle"></i> Agregar</a></li>
            <li><a href="../../pages/venta/venta_list.php"><i class="fa fa-wrench"></i> Mantenimiento</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-gears"></i>
            <span>Configuración</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../../pages/sucursal/sucursal_edit.php"><i class="fa fa-institution"></i> Sucursal</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder-open"></i>
            <span>Reportes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../../pdf/repProv.php" target="_blank"><i class="fa fa-file-pdf-o"></i> Reportes de Proveedores</a></li>
            <li><a href="../../pdf/repProd.php" target="_blank"><i class="fa fa-file-pdf-o"></i> Reportes de Productos</a></li>
            <li><a href="../../pdf/repProdStock.php" target="_blank"><i class="fa fa-file-pdf-o"></i> Productos en Stock</a></li>
            <li><a href="../../pdf/repVentCont.php" target="_blank"><i class="fa fa-file-pdf-o"></i> Ventas al Contado</a></li>
          </ul>
        </li>
        
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Multilevel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Level One
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> Level Two
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
          </ul>
        </li>
        <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>