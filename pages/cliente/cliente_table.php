  
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
              <th>Dui</th>
              <th>NIT</th>
              <th>Nombre</th>
              <th>Teléfono</th>
              <th>Dirección </th>
              <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php
            include ("../../build/controladores/conexion.php");
            $contador=1;
                        
            $stmt1= $pdo->prepare("SELECT * FROM cliente WHERE estado=:estado");
            $stmt1->bindParam(":estado",$estado_list,PDO::PARAM_STR);
            $stmt1->execute();
            $result=$stmt1->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $lista_cliente){
                echo "<tr>";
                    echo "<td>" .$contador. "</td>";
                    echo "<td>" . $lista_cliente['dui'] . "</td>";
                    echo "<td>" . $lista_cliente['nit'] . "</td>";
                    echo "<td>" . $lista_cliente[ 'nombre'] ." ". $lista_cliente[ 'apellido'] . "</td>";
                    echo "<td>" . $lista_cliente['telefono'] . "</td>";
                    echo "<td>" . $lista_cliente['direccion'] . "</td>";
                    echo "<td>";
                              
                            echo "<a class='btn btn-success' onclick='mostrar_cliente(".$lista_cliente['id_cliente'].")' data-toggle='tooltip' data-placement='top' title='Mostrar Cliente'><i class='fa fa-eye'></i></a>";
                                
                            if($estado_list=="Activo"){
                                echo "<a class='btn btn-info' onclick='editar_cliente(".$lista_cliente['id_cliente'].")' data-toggle='tooltip' data-placement='top' title='Editar Cliente'><i class='fa fa-edit'></i></a>";
                                echo "<a class='btn btn-danger' onclick='dar_baja_cliente(".$lista_cliente['id_cliente'].")' data-toggle='tooltip' data-placement='top' title='Dar Baja Cliente'><i class='fa fa-long-arrow-down'></i></a>";
                            }else if($estado_list=="Inactivo"){
                                echo "<a class='btn btn-primary' onclick='dar_alta_cliente(".$lista_cliente['id_cliente'].")' data-toggle='tooltip' data-placement='top' title='Activar Cliente'><i class='fa fa-long-arrow-up'></i></a>";
                            }  
                            
                    echo "</td>";
                echo "</tr>";
                $contador++;
            }
        ?>
         
        </tfoot>
    </table>