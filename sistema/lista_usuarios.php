<?php 
    include "../conexion.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
	<title>Lista de usuarios</title>
</head>
<body>
    <style>

   /* ========= paginador ==========*/

    .paginador ul {
	padding: 15px;
	list-style: none;
	background: #fff;
	margin-top: 15px;
	display: -webkit-flex;
	display: -moz-flex;
	display: -ms-flex;
	display: -o-flex;
	display: flex;
    justify-content: flex-end;
}
.paginador a, pageSelected{
    color: #428bca;
    border: 1px solid #ddd;
    padding: 5px;
    display: inline-block;
    font-size: 14px;
    text-align: center;
    width: 35px;
}
.paginador a:hover{
    background: #ddd;
}
.pageSelected{
    color: #fff;
    background: #428bca;
    border: 1px solid #428bca;
}
/* buscador */

.form_search{
    display: -webkit-flex;
	display: -moz-flex;
	display: -ms-flex;
	display: -o-flex;
	display: flex;
    float: right;
    background: initial;
    padding: 10px;
    border-radius: 10px;
}

.form_search .btn_search{
    background: #1faac8;
    color: #fff;
    padding: 0 20px;
    border: 0;
    cursor: pointer;
    margin-left: 10px;
}

</style>
    <?php include "includes/header.php"; ?>
	<section id="container">
		
    <h1>Lista de Usuarios</h1>
    <a href="registro_usuario.php" class="btn_new">Crear usuario</a>

    <form action="buscar_usuario.php" method="get" class="form_search">
       <input type="text" name="busqueda" id="busqueda" placeholder="Buscar"> 
       <input type="submit" value="Buscar" class="btn_search">
    </form>

    <table>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Usuario</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>

        <?php 
           //paginador 
           $sql_registe = mysqli_query($conection, "SELECT COUNT(*) AS total_registro FROM usuarios WHERE estatus = 1;");
           $result_register = mysqli_fetch_array($sql_registe);
        
           $total_registro = $result_register['total_registro'];

           $por_pagina = 6;

           if(empty($_GET ['pagina']))
           {
            $pagina = 1;
           }else{
            $pagina = $_GET['pagina'];
           }

           $desde = ($pagina-1) * $por_pagina;
           $total_paginas = ceil($total_registro / $por_pagina);




            $query = mysqli_query($conection, "SELECT u.idusuario, u.nombre, u.correo, u.usuario, r.rol FROM usuarios u INNER JOIN roles r ON u.rol = r.IdRol WHERE estatus = 1 LIMIT $desde,$por_pagina;");

            mysqli_close($conection);

            $result = mysqli_num_rows($query);
            if ($result > 0) {

                while ($data = mysqli_fetch_array($query)) {
                    

        ?>

        <tr>
            <td><?php echo $data["idusuario"] ?></td>
            <td><?php echo $data["nombre"] ?></td>
            <td><?php echo $data["correo"] ?></td>
            <td><?php echo $data["usuario"] ?></td>
            <td><?php echo $data["rol"] ?></td>
            <td>
                <a class="link_edit" href="editar_usuario.php?id=<?php echo $data["idusuario"] ?>">Editar
            </a>

        <?php if(["idusuario"] !=32456244){ ?>
                |
                <a class="link_delete" href="eliminar_confirmar_usuario.php?id=<?php echo $data["idusuario"] ?>">Eliminar</a>
        <?php } ?>
            </td>
        </tr>
       <?php
                }
            }
        ?>   

    </table>

    <div class="paginador">
        <ul>
            <?php
               if($pagina != 1) 
               {
            ?>
                <li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
                <li><a href="?pagina=<?php echo $pagina-1; ?>"><<</a></li>
            <?php
               }
                for($i=1; $i <= $total_paginas; $i++){

                   if($i == $pagina)
                   {
                   echo '<li class = "pageSelected">'.$i.'</li>';
                   }else{
                    echo '<li><a href ="?pagina='.$i.'">'.$i.'</a></li>';
                   }
                }
                if($pagina != $total_paginas)
                {
            ?>
           
            <li><a href="?pagina=<?php echo $pagina+1; ?>">>></a></li>
            <li><a href="?pagina=<?php echo $total_paginas; ?>">>|</a></li>
        <?php
                }
        ?>
        </ul>
    </div>



	</section>
    <?php include "includes/footer.php"; ?>  
</body>
</html>