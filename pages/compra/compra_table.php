  
<?php
    $estado_list="Activo";
 /*   if(isset($_REQUEST['estado_list'])){
        $estado_list= $_REQUEST['estado_list'];
       // $user = $_REQUEST['user'];
      //  $id_user = $_REQUEST['id_user'];
    }

    if($estado_list=="Activo"){
        echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'> Activos </label>";
    }else if($estado_list=="Inactivo"){
        echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'> Inactivos </label>";
    }*/
?>
    
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>NIT</th>
              <th>Teléfono</th>
              <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php
            include ("../../build/controladores/conexion.php");
            $contador=1;
                        
            $stmt1= $pdo->prepare("SELECT * FROM proveedor WHERE estado=:estado");
            $stmt1->bindParam(":estado",$estado_list,PDO::PARAM_STR);
            $stmt1->execute();
            $result=$stmt1->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $lista_proveedor){
                echo "<tr>";
                    echo "<td>" .$contador. "</td>";
                    echo "<td>" . $lista_proveedor['nombre'] . "</td>";
                    echo "<td>" . $lista_proveedor['nit'] . "</td>";
                    echo "<td>" . $lista_proveedor['telefono'] . "</td>";
                    echo "<td>";
                              
                            echo "<a class='btn btn-success' onclick='mostrar_emprendedor(".$lista_proveedor['id_proveedor'].")' data-toggle='tooltip' data-placement='top' title='Mostrar Emprendedor'><i class='fa fa-eye'></i></a>";
                                
                            if($estado_list=="Activo"){
                                echo "<a class='btn btn-info' onclick='editar_emprendedor(".$lista_proveedor['id_proveedor'].")' data-toggle='tooltip' data-placement='top' title='Editar Emprendedor'><i class='fa fa-edit'></i></a>";
                                echo "<a class='btn btn-danger' onclick='dar_baja_emprendedor(".$lista_proveedor['id_proveedor'].")' data-toggle='tooltip' data-placement='top' title='Dar Baja Emprendedor'><i class='fa fa-long-arrow-down'></i></a>";
                            }else if($estado_list=="Inactivo"){
                                echo "<a class='btn btn-primary' onclick='dar_alta_emprendedor(".$lista_proveedor['id_proveedor'].")' data-toggle='tooltip' data-placement='top' title='Activar Emprendedor'><i class='fa fa-long-arrow-up'></i></a>";
                            }  
                            
                    echo "</td>";
                echo "</tr>";
                $contador++;
            }
        ?>
         
        </tfoot>
    </table>