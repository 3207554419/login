<?php
include "../sistema/conexion.php";

if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['nombre']) || empty($_POST['Apellidos']) || empty($_POST['NombreUsuario']) || empty($_POST['Correo']) || empty($_POST['clave']) || empty($_POST['Fecha_Nacimiento']) || empty($_POST['genero']) || empty($_POST['Direccion'])) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios</p>';
    } else {
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['Apellidos'];
        $nombre_usuario = $_POST['NombreUsuario'];
        $correo = $_POST['Correo'];
        $clave =  md5($_POST['clave']);
        $fecha_nacimiento = $_POST['Fecha_Nacimiento'];
        $genero = $_POST['genero'];
        $direccion = $_POST['Direccion'];

        $query_insert = mysqli_query($conection, "INSERT INTO clientes (Nombre, Apellidos, NombreUsuario, correo, clave, FechaNacimiento, Genero, Direccion)
                                                VALUES ('$nombre', '$apellidos', '$nombre_usuario', '$correo', '$clave', '$fecha_nacimiento', '$genero', '$direccion')");

        if ($query_insert) {
            $alert = '<p class="msg_save">Cliente registrado correctamente.</p>';
        } else {
            $alert = '<p class="msg_error">Error al registrar el cliente.</p>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/sistema/css/style.css">
    <title>Registro Cliente</title>
</head>
<body>
    <?php include "includes/header.php"; ?>
    <section id="container">
        <div class="form_register">
            <h1>Registro Cliente</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
            <form action="" method="post">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre completo" required>
                <label for="Apellidos">Apellidos:</label>
                <input type="text" name="Apellidos" id="Apellidos" placeholder="Apellidos" required>
                <label for="NombreUsuario">Nombre Usuario:</label>
                <input type="text" name="NombreUsuario" id="NombreUsuario" placeholder="Nombre Usuario" required>
                <label for="Correo">Correo electrónico:</label>
                <input type="email" name="Correo" id="Correo" placeholder="Correo electrónico" required>
                <label for="clave">Clave:</label>
                <input type="password" name="clave" id="clave" placeholder="Clave de acceso" required>
                <label for="Fecha_Nacimiento">Fecha Nacimiento:</label>
                <input type="date" name="Fecha_Nacimiento" id="Fecha_Nacimiento" required>
                <label for="genero">Género:</label>
                <select name="genero" id="genero" required>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Otro">Otro</option>
                </select>
                <label for="Direccion">Dirección:</label>
                <input type="text" name="Direccion" id="Direccion" placeholder="Dirección" required>
                <input type="submit" value="Registrar Cliente" class="btn_save">
            </form>
        </div>
    </section>
    <?php include "includes/footer.php"; ?>  
</body>
</html>
