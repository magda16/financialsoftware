  
<?php

    if(isset($_REQUEST['tipo_bien'])){
        $id_subcategoria= $_REQUEST['tipo_bien'];
        $estado= $_REQUEST['estado'];
       // $user = $_REQUEST['user'];
      //  $id_user = $_REQUEST['id_user'];
    }

?>
    </br>
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
              <th>#</th>
              <th>Código</th>
              <th>Marca</th>
              <th>Fecha Adquisición</th>
              <th>Valor Adquisición</th>
              <th>Valor Residual</th>
              <th>Vida Útil</th>
              <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php
            include ("../../build/controladores/conexion.php");
            $contador=1;
                        
            $stmt1= $pdo->prepare("SELECT id_activo_fijo, codigo, marca, DATE_FORMAT(fecha_adquisicion, '%d/%m/%Y') AS fecha_adquisicion, valor_adquisicion, valor_residual, vida_util FROM activo_fijo WHERE id_subcategoria=:id_subcategoria AND estado=:estado");
            $stmt1->bindParam(":id_subcategoria",$id_subcategoria,PDO::PARAM_STR);
            $stmt1->bindParam(":estado",$estado,PDO::PARAM_STR);
            $stmt1->execute();
            $result=$stmt1->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $lista_activo_fijo){
                echo "<tr>";
                    echo "<td>" .$contador. "</td>";
                    echo "<td>" . $lista_activo_fijo['codigo'] . "</td>";
                    echo "<td>" . $lista_activo_fijo['marca'] . "</td>";
                    echo "<td>" . $lista_activo_fijo['fecha_adquisicion'] . "</td>";
                    echo "<td> $ " . $lista_activo_fijo[ 'valor_adquisicion'] . "</td>";
                    echo "<td> $ " . $lista_activo_fijo['valor_residual'] . "</td>";
                    echo "<td>" . $lista_activo_fijo['vida_util'] . " años</td>";
                    echo "<td>";
                              
                           // echo "<a class='btn btn-success' onclick='mostrar_activo_fijo(".$lista_activo_fijo['id_activo_fijo'].")' data-toggle='tooltip' data-placement='top' title='Mostrar Activo Fijo'><i class='fa fa-eye'></i></a>";
                                
                            if($estado=="Activo"){
                                echo "<a class='btn btn-primary' onclick='editar_activo_fijo(".$lista_activo_fijo['id_activo_fijo'].")' data-toggle='tooltip' data-placement='top' title='Actualizar Activo Fijo'><i class='fa fa-refresh'></i></a>";
                                echo "<a class='btn btn-danger' onclick='dar_baja_activo_fijo(".$lista_activo_fijo['id_activo_fijo'].")' data-toggle='tooltip' data-placement='top' title='Dar Baja Activo Fijo'><i class='fa fa-long-arrow-down'></i></a>";
                            }else if($estado=="Inactivo"){
                                echo "<a class='btn bg-orange' onclick='dar_alta_activo_fijo(".$lista_activo_fijo['id_activo_fijo'].")' data-toggle='tooltip' data-placement='top' title='Activar Activo Fijo'><i class='fa fa-long-arrow-up'></i></a>";
                            }  
                            
                    echo "</td>";
                echo "</tr>";
                $contador++;
            }
        ?>
         
        </tfoot>
    </table>