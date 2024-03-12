<?php
include "../conexion.php";

     if (!empty($_POST)) {
       $alert = "";
       if (empty($_POST['idProducto']) || empty($_POST['nombre']) || empty($_POST['categoria']) || empty($_POST['talla']) || empty($_POST['color']) || empty($_POST['diseño']) || empty($_POST['material']) || empty($_POST['cantidad']) || empty($_POST['idCompra']) || empty($_POST['PrecioVenta'])) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios</p>';
    } else {

   
    
        $idProducto = $_POST['idProducto'];
        $nombre = $_POST['nombre'];
        $categoria = $_POST['categoria'];
        $talla = $_POST['talla'];
        $color = $_POST['color'];
        $diseño = $_POST['diseño'];
        $material = $_POST['material'];
        $cantidad = $_POST['cantidad'];
        $idcompra = $_POST['idCompra'];
        $precioVenta = $_POST['PrecioVenta'];

        // Procesamiento de la imagen
        $imagen = $_FILES['imagen']['name'];
        $ruta_temporal = $_FILES['imagen']['tmp_name'];
        $ruta_destino = "images/productos/" . $imagen;
        move_uploaded_file($ruta_temporal, $ruta_destino);

        $query = mysqli_query($conection, "SELECT * FROM productos WHERE nombre = '$nombre' AND talla = '$talla'");

        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            $alert = '<p class="msg_error">El producto ya existe.</p>';
        } else {
            $query_insert = mysqli_query($conection, "INSERT INTO productos (idProducto, nombre, categoria, talla, color, diseño, material, cantidad, idCompra, PrecioVenta) 
            VALUES ('$idProducto', '$nombre', '$categoria', '$talla', '$color', '$diseño', '$material', '$cantidad', '$idcompra', '$Precioventa','$ruta_destino')");

            if ($query_insert) {
                $alert = '<p class="msg_save">Producto creado correctamente.</p>';
            } else {
                $alert = '<p class="msg_error">Error al crear el producto.</p>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Registro Producto</title>
</head>
<body>
    <?php include "includes/header.php"; ?>
    <section id="container">
        
        <div class="form_register">
            <h1>Registro Producto</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

            <form action="" method="post" enctype="multipart/form-data">
                <label for="nombre">id producto</label>
                <input type="text" name="nombre" id="nombre" placeholder="id del producto">
                <label for="descripcion">nombre</label>
                <textarea name="descripcion" id="descripcion" placeholder="nombre del producto"></textarea>
                <label for="precio">categoria</label>
                <input type="number" name="precio" id="precio" placeholder="categoria del producto">
                <label for="stock">talla</label>
                <input type="number" name="stock" id="stock" placeholder="tallas disponibles">
                <label for="talla">color</label>
                <input type="text" name="talla" id="talla" placeholder="color del producto">
                <label for="talla">diseño</label>
                <input type="text" name="talla" id="talla" placeholder="diseño del producto">
                <label for="talla">material</label>
                <input type="text" name="talla" id="talla" placeholder="material del producto">
                <label for="talla">cantidad</label>
                <input type="text" name="talla" id="talla" placeholder="cantidad del producto">
                <label for="talla">idcompra</label>
                <input type="text" name="talla" id="talla" placeholder="idcompra del producto">
                <label for="talla">precio venta</label>
                <input type="text" name="talla" id="talla" placeholder="precio venta del producto">
                <label for="imagen">imagen</label>
                <input type="file" name="imagen" accept="image/*">
                <input type="submit" value="Crear Producto" class="btn_save">
            </form>
        </div>
    </section>
    <?php include "includes/footer.php"; ?>  
</body>
</html>
