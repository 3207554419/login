<?php
include "../conexion.php";

// Consulta para obtener la lista de productos
$query = mysqli_query($conection, "SELECT * FROM productos");
$productos = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Lista de Productos</title>
</head>
<body>
    <?php include "includes/header.php"; ?>
    <section id="container">
        
        <div class="form_register">
            <h1>Lista de Productos</h1>
            <a href="registro_producto.php" class="btn_new">Crear usuario</a>
            <table>
                <thead>
                    <tr>
                        <th>ID Producto</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Talla</th>
                        <th>Color</th>
                        <th>Diseño</th>
                        <th>Material</th>
                        <th>Cantidad</th>
                        <th>ID Compra</th>
                        <th>Precio Venta</th>
                        <th>Imagen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($productos as $producto) {
                        echo "<tr>";
                        echo "<td>{$producto['idProducto']}</td>";
                        echo "<td>{$producto['nombre']}</td>";
                        echo "<td>{$producto['categoria']}</td>";
                        echo "<td>{$producto['talla']}</td>";
                        echo "<td>{$producto['color']}</td>";
                        echo "<td>{$producto['diseño']}</td>";
                        echo "<td>{$producto['material']}</td>";
                        echo "<td>{$producto['cantidad']}</td>";
                        echo "<td>{$producto['idCompra']}</td>";
                        echo "<td>{$producto['PrecioVenta']}</td>";
                        echo "<td><img src='{$producto['imagen']}' alt='Imagen del Producto' style='width: 50px; height: 50px;'></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
    <?php include "includes/footer.php"; ?>  
</body>
</html>
