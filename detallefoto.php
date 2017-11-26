<?php session_start(); ?>



<!DOCTYPE HTML>
<html lang="es">
		<?php
		$title= "PICSY-Detalle fotografía";
		require_once("inc/head.inc.php");
		?>
		
<?php

if(!isset($_SESSION["usuario"])){
	
	$host = $_SERVER['HTTP_HOST'];
				$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
				$pag = 'index.php';
				header("Location: http://$host$uri/$pag");	
}

?>


	<body>
		
			<?php
		
		if(isset($_SESSION["usuario"])){
		
			require_once("inc/header2.inc.php");

		}else{
			require_once("inc/header.inc.php");
		}

		?>

		<?php 



		if(isset($_SESSION["usuario"])){
			// Conecta con el servidor de MySQL 
 			$link =mysqli_connect('localhost', 'root', '', 'picsy');
			mysqli_set_charset($link, "utf8");
	        if(!mysqli_ping($link)){//Error al conectar con la base de datos
	            die('<p>No pudo conectarse:'.mysqli_connect_error().'</p>');
	        }

 			// Ejecuta una sentencia SQL 
 			$sentencia = 'SELECT * FROM fotos,paises,albumes,usuarios
 							 WHERE fotos.IdFoto="' . $_GET['id'] . '"
							AND fotos.pais=paises.IdPais
							AND fotos.album=albumes.IdAlbum
							AND albumes.Usuario=usuarios.IdUsuario'; //Select de la foto que corresponde con ese id

							if(!($resultado = @mysqli_query($link,$sentencia))) { 
					   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link); 
					   echo '</p>'; 
					   exit; 
					 } 
 			
 			$resultado = mysqli_query($link, $sentencia);
				while($fila=mysqli_fetch_assoc($resultado)){
					echo "<h1><img  src='" . $fila['Fichero'] . "' alt='" . $fila['Descripcion'] . "'></h1>";
			        echo "<p><b>País:</b> " . $fila['NomPais'] . "</p>"; 
			        echo "<p><b>Autor:</b> <a href='perfil.php?nombre=" . $fila['NomUsuario'] . "'>" . $fila['NomUsuario'] . "</a></p>"; 
			        echo "<p><b>Título:</b> " . $fila['Titulo'] . "</p>"; 
			        echo "<p><b>Fecha de publicación:</b> " . $fila['FRegistro'] . "</p>"; 
				}



		}else{

			echo "<h1 class=titulos>Necesitas estar logueado para ver el contenido de esta página</h1>";
		}

		?>
		


		
		<?php
		
		require_once("inc/footer.inc.php");
		?>
		
	</body>
</html>