<?php

    if(isset($_POST['producto'])){
        $id_producto = $_POST['producto'];

        include ("../../build/controladores/conexion.php");

        $stmt= $pdo->prepare("SELECT * FROM producto WHERE id_producto=:id_producto");
        $stmt->bindParam(":id_producto",$id_producto,PDO::PARAM_STR);
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $lista_producto){ 
            $nombre_r=$lista_producto['nombre'];
            $stock_minimo_r=$lista_producto['stock_minimo'];
        }

    }
?>

<table class="table table-bordered">
        <tr>
            <th colspan="4">Producto</th>
            <td colspan="3"><?php echo $nombre_r; ?></td>
            <th colspan="3">Stock Mínimo</th>
            <td colspan="3"><?php echo $stock_minimo_r; ?></td>
        </tr>
        <tr align="center">
            <td style="width: 10px" colspan="3"><strong>Fecha</strong></td>
            <td rowspan="2"><strong>Detalle</strong></td>
            <td colspan="3"><strong>Entradas</strong></td>
            <td colspan="3"><strong>Salidas</strong></td>
            <td colspan="3"><strong>Existencias</strong></td>
        </tr>
        <tr>
            <td><strong>D</strong></td>
            <td><strong>M</strong></td>
            <td><strong>A</strong></td>
            <td><strong>Cantidad</strong></td>
            <td><strong>V/ Unitario</strong></td>
            <td><strong>V/ Total</strong></td>
            <td><strong>Cantidad</strong></td>
            <td><strong>V/ Unitario</strong></td>
            <td><strong>V/ Total</strong></td>
            <td><strong>Cantidad</strong></td>
            <td><strong>V/ Unitario</strong></td>
            <td><strong>V/ Total</strong></td>
        </tr>
        <?php

            $stmt1= $pdo->prepare("SELECT DATE_FORMAT(c.fecha, '%d') AS dia, DATE_FORMAT(c.fecha, '%m') AS mes, DATE_FORMAT(c.fecha, '%Y') AS anio, c.fecha, dc.cantidad, dc.precio FROM detalle_compra AS dc INNER JOIN compra AS c ON (dc.id_compra=c.id_compra) WHERE dc.id_producto=:id_producto ORDER BY c.fecha");
            $stmt1->bindParam(":id_producto",$id_producto,PDO::PARAM_STR);
            $stmt1->execute();
            $result=$stmt1->fetchAll(PDO::FETCH_ASSOC);
            $contador=0;
            foreach($result as $lista_compras){
                $cantidad_compra=$lista_compras['cantidad'];
                $precio_compra=$lista_compras['precio'];
                $total_compra=$cantidad_compra * $precio_compra;
                if($contador==0){
                    $detalle_compra="Inventario Inicial";
                }else{
                    $detalle_compra="Compra";
                }
                echo "<tr>";
                    echo "<td>" . $lista_compras['dia'] . "</td>";
                    echo "<td>" . $lista_compras['mes'] . "</td>";
                    echo "<td>" . $lista_compras['anio'] . "</td>";
                    echo "<td>" . $detalle_compra . "</td>";
                    echo "<td>" . $cantidad_compra . "</td>";
                    echo "<td>" . $precio_compra . "</td>";
                    echo "<td>" . $total_compra . "</td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td>" . $cantidad_compra . "</td>";
                    echo "<td>" . $precio_calculado=$total_compra/$cantidad_compra . "</td>";
                    echo "<td>" . $total_compra . "</td>";
                echo "</tr>";
                $contador++;
            }       
        ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><strong>Inventario Final</strong></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><strong>Cantidad</strong></td>
            <td><strong>V/ Unitario</strong></td>
            <td><strong>V/ Total</strong></td>
        </tr>
    </table>