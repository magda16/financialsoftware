  
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
              <th>Código</th>
              <th>Nombre</th>
              <th>Descripción</th>
              <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php
            include ("../../build/controladores/conexion.php");
            $contador=1;
                        
            $stmt1= $pdo->prepare("SELECT * FROM departamento WHERE estado=:estado");
            $stmt1->bindParam(":estado",$estado_list,PDO::PARAM_STR);
            $stmt1->execute();
            $result=$stmt1->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $lista_departamento){
                echo "<tr>";
                    echo "<td>" .$contador. "</td>";
                    echo "<td>" . $lista_departamento['codigo'] . "</td>";
                    echo "<td>" . $lista_departamento['nombre'] . "</td>";
                    echo "<td>" . $lista_departamento[ 'descripcion'] ."</td>";
                    echo "<td>";
            
                            if($estado_list=="Activo"){
                                echo "<a class='btn btn-primary' onclick='editar_departamento(".$lista_departamento['id_departamento'].")' data-toggle='tooltip' data-placement='top' title='Actualizar Departamento'><i class='fa fa-refresh'></i></a>";
                                echo "<a class='btn btn-danger' onclick='dar_baja_departamento(".$lista_departamento['id_departamento'].")' data-toggle='tooltip' data-placement='top' title='Dar Baja Departamento'><i class='fa fa-long-arrow-down'></i></a>";
                            }else if($estado_list=="Inactivo"){
                                echo "<a class='btn bg-orange' onclick='dar_alta_departamento(".$lista_departamento['id_departamento'].")' data-toggle='tooltip' data-placement='top' title='Activar Departamento'><i class='fa fa-long-arrow-up'></i></a>";
                            }  
                            
                    echo "</td>";
                echo "</tr>";
                $contador++;
            }
        ?>
         
        </tfoot>
    </table>