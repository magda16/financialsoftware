  
<?php

    if(isset($_REQUEST['estado'])){
        $estado_list= $_REQUEST['estado'];
       // $user = $_REQUEST['user'];
      //  $id_user = $_REQUEST['id_user'];
    }

?>
    </br>
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
              <th>#</th>
              <th>DUI</th>
              <th>NIT</th>
              <th>Nombre</th>
              <th>Teléfono</th>
              <th>Puesto</th>
              <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php
            include ("../../build/controladores/conexion.php");
            $contador=1;
                        
            $stmt1= $pdo->prepare("SELECT * FROM empleado WHERE estado=:estado");
            $stmt1->bindParam(":estado",$estado_list,PDO::PARAM_STR);
            $stmt1->execute();
            $result=$stmt1->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $lista_empleado){
                echo "<tr>";
                    echo "<td>" .$contador. "</td>";
                    echo "<td>" . $lista_empleado['dui'] . "</td>";
                    echo "<td>" . $lista_empleado['nit'] . "</td>";
                    echo "<td>" . $lista_empleado[ 'nombre'] ." ". $lista_empleado[ 'apellido'] . "</td>";
                    echo "<td>" . $lista_empleado['telefono'] . "</td>";
                    echo "<td>" . $lista_empleado['puesto'] . "</td>";
                    echo "<td>";
                              
                            //echo "<a class='btn btn-success' onclick='mostrar_empleado(".$lista_empleado['id_empleado'].")' data-toggle='tooltip' data-placement='top' title='Mostrar Empleado'><i class='fa fa-eye'></i></a>";
                                
                            if($estado_list=="Activo"){
                                echo "<a class='btn btn-primary' onclick='editar_empleado(".$lista_empleado['id_empleado'].")' data-toggle='tooltip' data-placement='top' title='Actualizar Empleado'><i class='fa fa-refresh'></i></a>";
                                echo "<a class='btn btn-danger' onclick='dar_baja_empleado(".$lista_empleado['id_empleado'].")' data-toggle='tooltip' data-placement='top' title='Dar Baja Empleado'><i class='fa fa-long-arrow-down'></i></a>";
                            }else if($estado_list=="Inactivo"){
                                echo "<a class='btn bg-orange' onclick='dar_alta_empleado(".$lista_empleado['id_empleado'].")' data-toggle='tooltip' data-placement='top' title='Activar Empleado'><i class='fa fa-long-arrow-up'></i></a>";
                            }  
                            
                    echo "</td>";
                echo "</tr>";
                $contador++;
            }
        ?>
         
        </tfoot>
    </table>