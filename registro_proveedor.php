<<?php
include "../conexion.php";

if (!empty($_POST)) {
    $alert = "";

    if (empty($_POST['Idcliente']) || empty($_POST['Nombre']) || empty($_POST['Apellidos']) || empty($_POST['NombreUsuario']) || empty($_POST['Correo'])  || empty($_POST['Clave']) || empty($_POST['FechaNacimiento']) || empty($_POST['Genero']) || empty($_POST['Direccion']) || empty($_POST['Usuario_id']) || empty($_POST['telefono'])) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios</p>';
    } else {
    
        $Idcliente = $_POST['Idcliente'];
        $Nombre = $_POST['Nombre'];
        $Apellidos = $_POST['Apellidos'];
        $NombreUsuario = $_POST['NombreUsuario'];
        $Correo = $_POST['Correo'];
        $Clave = md5($_POST['Clave']); 
        $FechaNacimiento = $_POST['FechaNacimiento'];
        $Genero = $_POST['Genero'];
        $Direccion = $_POST['Direccion'];
        $usuario_id = $_POST['usuario_id'];
        $telefono = $_POST['telefono'];


        $query = mysqli_query($conection, "SELECT * FROM clientes WHERE Idcliente = '$Idcliente'");
        $result = mysqli_num_rows($query);

        if ($result > 0) {
            $alert = '<p class="msg_error">El ID del cliente ya existe.</p>';
        } else {
           
            $query_insert = mysqli_query($conection, "INSERT INTO clientes(Idcliente, Nombre, Apellidos, NombreUsuario, correo, clave, FechaNacimiento, Genero, Direccion, usuario_id, telefono)
                VALUES('$Idcliente', '$Nombre', '$Apellidos', '$NombreUsuario', '$Correo', '$Clave', '$FechaNacimiento', '$Genero', '$Direccion', '$Usuario_id', '$telefono')");

            if ($query_insert) {
                $alert = '<p class="msg_save">Cliente guardado correctamente.</p>';
            } else {
                $alert = '<p class="msg_error">Error al guardar el cliente.</p>';
            }
        }
    }
    mysqli_close($conection);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
	<title>Registro Cliente</title>
</head>
<body>
    <?php include "includes/header.php"; ?>
	<section id="container">
		
    <div class="form_register">
        <H1>Registro Proveedor</H1>
        <hr>
        <div class="alert"><?php echo isset ($alert) ? $alert : '';  ?></div>

        <form action="" method="post">
    <label for="id">Id</label>
    <input type="text" name="id" id="id" placeholder="Id">
    
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" placeholder="Nombre">
    
    <label for="contacto">Contacto</label>
    <input type="text" name="contacto" id="contacto" placeholder="contacto">
    
    <label for="telefono">Telefono</label>
    <input type="text" name="usuario" id="usuario" placeholder="Nombre Usuario">
    
    <label for="correo">Correo electrónico</label>
    <input type="email" name="correo" id="correo" placeholder="Correo electrónico">
            <input type="submit" value="Guardar Cliente" class="btn_save">
        </form>

    </div>


	</section>
    <?php include "includes/footer.php"; ?>  
</body>
</html> 