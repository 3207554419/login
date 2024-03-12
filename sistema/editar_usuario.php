<?php
include "../conexion.php";

    if(!empty($_POST))
    {
        $alert = "";
        if 
        (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['rol'])) {
            
            $alert = '<p class="msg_error">Todos los campos son obligatorios</p>';
        }else{
            
            $idUsuario = $_POST['idUsuario'];
            $nombre = $_POST['nombre'];
            $correo =  $_POST['correo'];
            $user =  $_POST['usuario'];
            $clave =  md5($_POST['clave']);
            $rol =  $_POST['rol'];


            $query = mysqli_query($conection, "SELECT * FROM usuarios WHERE (usuario = '$user' AND idUsuario != idUsuario)  OR (correo = '$correo' AND idUsuario != $idUsuario)");

            $result = mysqli_fetch_array($query);

            if($result > 0) {
                $alert = '<p class="msg_error">El correo o el usuario ya existe.</p>';
            }else{

                if (empty($_POST['clave'])) 
                {
                    $sql_update = mysqli_query($conection, "UPDATE usuarios 
                                                            SET nombre = '$nombre', correo='$correo',usuario='$user',rol='$rol' 
                                                            WHERE idUsuario = $idUsuario");
                }else{
                    $sql_update = mysqli_query($conection,"UPDATE usuarios
                    SET nombre = '$nombre', correo = '$correo', usuario = 'user',clave = '$clave', rol='$rol' WHERE idUsuario = '$idUsuario' ");
                }


                if($sql_update){
                    $alert = '<p class="msg_save">Usuario Actualizado correctamente.</p>';
                }else{
                    $alert = '<p class="msg_error"> Error al Actualizar el usuario.</p>';
                }
            }
        }
    }
    mysqli_close($conection);
    //Mostrar Datos
    if (empty($_GET['id'])) 
    {
        header('location: lista_usuarios.php');  
    }

    $iduser = $_GET['id'];

    $sql = mysqli_query($conection,"SELECT u.idusuario, u.nombre, u.correo, u.usuario, (u.rol) as idrol, (r.rol) as rol FROM usuarios u INNER JOIN roles r on u.rol = r.IdRol  WHERE idUsuario=$iduser;");
    mysqli_close($conection);
    $result_sql = mysqli_num_rows($sql);

    if ($result_sql == 0) {
        header('location: lista_usuarios.php');
        mysqli_close($conection);
    }else {

        $option = '';

        while ($data = mysqli_fetch_array($sql)) {
            
        $iduser = $data['idusuario'];
        $nombre = $data['nombre'];
        $correo = $data['correo'];
        $usuario = $data['usuario'];
        $idrol= $data['idrol'];
        $rol = $data['rol'];

        if ($idrol == 1){
            $option = '<option value="'.$idrol.'" select>'.$idrol.'</option>';
        }elseif ($idrol == 2){
            $option = '<option value="'.$idrol.'" select>'.$idrol.'</option>';
        }elseif ($idrol == 3){
            $option = '<option value="'.$idrol.'" select>'.$idrol.'</option>';
        }    


        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
	<title>Actualizar Usuario</title>
</head>
<body>
    <?php include "includes/header.php"; ?>
	<section id="container">
		
    <div class="form_register">
        <h1>Actualizar Usuario</h1>
        <hr>
        <div class="alert"><?php echo isset ($alert) ? $alert : '';  ?></div>

        <form action="" method="post">
            <input type="hidden" name="idUsuario" value="<?php echo $iduser;?>">
            <label for="Nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre completo" value="<?php echo $nombre; ?>">
            <label for="correo">Correo electronico</label>
            <input type="email" name="correo" id="correo" placeholder="Correo electronico" value="<?php echo $correo; ?>">
            <label for="usuario">Usuario</label>
            <input type="text" name="usuario" id="usuario" placeholder="Usuario" value="<?php echo $usuario;?>">
            <label for="clave">Clave</label>
            <input type="password" name="clave" id="clave" placeholder="Clave de acceso">
            <label for="roles">Tipo Usuario</label>
           
           <?php
            include "../conexion.php";
              $query_rol = mysqli_query($conection,"SELECT * FROM roles");
              mysqli_close($conection);
              $result_rol = mysqli_num_rows($query_rol);
           ?>




            <select name="rol" id="rol" class="notItemOne">
                <?php

                echo $option;
                
                    if($result_rol > 0)
                    {
                    while($rol= mysqli_fetch_array($query_rol)){
                 ?>
                  <option value="<?php echo $rol["IdRol"]; ?>"> <?php echo $rol["Rol"];?> </option>

                 <?php
                     
                
                    }
                    }
                ?>
                
            </select>
            <input type="submit" value="Actualizar Usuario" class="btn_save">
        </form>

    </div>


	</section>
    <?php include "includes/footer.php"; ?>  
</body>
</html>