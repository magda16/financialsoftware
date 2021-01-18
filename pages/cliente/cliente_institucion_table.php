  
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
              <th>Nombre</th>
              <th>NIT</th>
              <th>NCR</th>
              <th>Teléfono</th>
              <th>Direccion</th>
              <th>Correo</th>
              <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php
            include ("../../build/controladores/conexion.php");
            $contador=1;
                        
            $stmt1= $pdo->prepare("SELECT * FROM cliente_institucion WHERE estado=:estado");
            $stmt1->bindParam(":estado",$estado_list,PDO::PARAM_STR);
            $stmt1->execute();
            $result=$stmt1->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $lista_cliente_institucion){
                echo "<tr>";
                    echo "<td>" .$contador. "</td>";
                    echo "<td>" . $lista_cliente_institucion['nombre'] . "</td>";
                    echo "<td>" . $lista_cliente_institucion['nit'] . "</td>";
                    echo "<td>" . $lista_cliente_institucion[ 'nrc'] ."</td>";
                    echo "<td>" . $lista_cliente_institucion['telefono'] . "</td>";
                    echo "<td>" . $lista_cliente_institucion['direccion'] . "</td>";
                    echo "<td>" . $lista_cliente_institucion['correo'] . "</td>";
                    echo "<td>";
                                                                 
                    if($estado_list=="Activo"){
                        echo "<a class='btn btn-primary' onclick='editar_cliente_inst(".$lista_cliente_institucion['id_cliente_institucion'].")' data-toggle='tooltip' data-placement='top' title='Actualizar Cliente'><i class='fa fa-refresh'></i></a>";
                        echo "<a class='btn btn-danger' onclick='dar_baja_cliente(".$lista_cliente_institucion['id_cliente_institucion'].")' data-toggle='tooltip' data-placement='top' title='Dar Baja Cliente'><i class='fa fa-long-arrow-down'></i></a>";
                    }else if($estado_list=="Inactivo"){
                        echo "<a class='btn bg-orange' onclick='dar_alta_cliente(".$lista_cliente_institucion['id_cliente_institucion'].")' data-toggle='tooltip' data-placement='top' title='Activar Cliente'><i class='fa fa-long-arrow-up'></i></a>";
                    }  
                            
                    echo "</td>";
                echo "</tr>";
                $contador++;
            }
        ?>
         
        </tfoot>
    </table>