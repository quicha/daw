<!DOCTYPE HTML>

<!--Contiene un formulario con los datos necesarios para crear un álbum (título, descripción, fecha y país).-->
<html lang="es">
	<?php
		$title= "PICSY-Crear álbum";
		require_once("inc/head.inc.php");
		?>

	<body>

			<?php
		
		if(isset($_SESSION["usuario"])){
		
			require_once("inc/header2.inc.php");

		}else{
			require_once("inc/header.inc.php");
		}
		?>

		<h2 class="titulos">Crea tu álbum</h2>

		<form id="creacionAlbum" action="respuesta_crearalbum.php" method="post">
			<fieldset title="Formulario de creacción">
				<legend id="album">Datos del álbum</legend>
				<p>
					<label for="titulo">Título:</label> <input type="text" id="titulo" name="titulo" required  >
				</p>
				<p> <!-- tiene tope de escritura, 200 caracteres -->
					<label for="descripcion">Descripcion:</label> <textarea rows="4" cols="50" name="descripcion" id="descripcion" maxlength="4000" placeholder="dedicatoria, descripción de su contenido, etc,..."></textarea> <!-- tengo que añadir fucking mierda aquí-->
				</p>

				<p>
					<label for="nacimiento">Fecha:</label> <input type="date" name="fecha" id="nacimiento" required />
				</p>

				<p>
					<label class="labelForm" for="paisReg">País</label>
				<select name="pais" >
					<?php
					$link =mysqli_connect('localhost', 'root', '', 'picsy');
					mysqli_set_charset($link, "utf8");
	        		if(!mysqli_ping($link)){//Error al conectar con la base de datos
	            	die('<p>No pudo conectarse:'.mysqli_connect_error().'</p>');
	            	}

	            	$sentencia= 'SELECT * FROM paises';

	            	$resultado = mysqli_query($link, $sentencia);
						echo "<option value=''></option>";
						while($fila=mysqli_fetch_assoc($resultado)){
							echo "<option value=".$fila['IdPais'].">".$fila['NomPais']."</option>";
						}

						mysqli_free_result($resultado);
					?>
				</select>
				</p>

				<p>
					<input title="Añadir álbum" value="Crear álbum" type="submit" class="centrado" >
				</p>
			</fieldset>
		</form>
		
	<?php
		
		require_once("inc/footer.inc.php");
		?>
	</body>

</html>