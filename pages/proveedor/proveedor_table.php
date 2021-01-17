  
<?php

    if(isset($_REQUEST['estado'])){
        $estado_list= $_REQUEST['estado'];
       // $user = $_REQUEST['user'];
      //  $id_user = $_REQUEST['id_user'];
    }

?>
    </br></br>
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
              <th>#</th>
              <th>Proveedor</th>
              <th>NIT</th>
              <th>Responsable</th>
              <th>Teléfono</th>
              <th>Correo</th>
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
                    echo "<td>" . $lista_proveedor['nombre_responsable'] ." ". $lista_proveedor['apellido_responsable'] . "</td>";
                    echo "<td>" . $lista_proveedor['telefono'] . "</td>";
                    echo "<td>" . $lista_proveedor['correo'] . "</td>";
                    echo "<td>";
                              
                           
                                
                            if($estado_list=="Activo"){
                                echo "<a class='btn btn-primary' onclick='editar_proveedor(".$lista_proveedor['id_proveedor'].")' data-toggle='tooltip' data-placement='top' title='Actualizar Proveedor'><i class='fa fa-refresh'></i></a>";
                                echo "<a class='btn btn-danger' onclick='dar_baja_proveedor(".$lista_proveedor['id_proveedor'].")' data-toggle='tooltip' data-placement='top' title='Dar Baja Proveedor'><i class='fa fa-long-arrow-down'></i></a>";
                            }else if($estado_list=="Inactivo"){
                                echo "<a class='btn bg-orange' onclick='dar_alta_proveedor(".$lista_proveedor['id_proveedor'].")' data-toggle='tooltip' data-placement='top' title='Activar Proveedor'><i class='fa fa-long-arrow-up'></i></a>";
                            }  
                            
                    echo "</td>";
                echo "</tr>";
                $contador++;
            }
        ?>
         
        </tfoot>
    </table>