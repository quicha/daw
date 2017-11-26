<?php session_start(); ?>
<!DOCTYPE HTML>

<!--Contiene un formulario con los datos necesarios para crear un álbum (título, descripción, fecha y país).-->
<html lang="es">
	<?php
		$title= "PICSY-Mis álbumes";
		require_once("inc/head.inc.php");
		?>

	<body>

			<?php
		
		if(isset($_SESSION["usuario"])){
					
			$nombre = $_SESSION["usuario"];
			require_once("inc/header2.inc.php");
				}

		else{
			require_once("inc/header.inc.php");
		}
		?>

		<h2 class="titulos">Elige tu álbum</h2>

			<form action="veralbum.php" method="POST">
			<fieldset title="Formulario de elección de álbum">
				<legend id="album">Elige tu álbum</legend>
				<p>
					
				<p>
							<?php
					
											// Conecta con el servidor de MySQL 
					 $link = @new mysqli( 
							 'localhost',   // El servidor 
							 'root',    // El usuario 
							 '',          // La contraseña 
							 'picsy'); // La base de datos 
					 
					 if($link->connect_errno) { 
					   echo '<p>Error al conectar con la base de datos: ' . $mysqli->connect_error; 
					   echo '</p>'; 
					   exit; 
					 } 

					 
					 
					 // Ejecuta una sentencia SQL 
					 $sentencia = "SELECT * FROM albumes, usuarios WHERE usuarios.NomUsuario='$nombre' AND albumes.Usuario=usuarios.IdUsuario"; 
					 if(!($resultado = @mysqli_query($link,$sentencia))) { 
					   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link); 
					   echo '</p>'; 
					   exit; 
					 } 
					 
					  echo '<select name= "album">';
					  echo '<option value=""></option>'; 
						 
					 while($fila = mysqli_fetch_assoc($resultado)){
						
						
						echo '<option value='.$fila['Titulo'].'>'. $fila['Titulo'] . '</option>'; 
						 
						
						
						 
					 
					 }
					 echo '</select>';
					?>
				</p>

				<p>
					<input type="submit" title="ver album" id="albumnuevo" value="Ver Album" class="centrado"></input>
				</p>
			</fieldset>
		</form>
		
	<?php
		
		require_once("inc/footer.inc.php");
		?>
	</body>

</html>