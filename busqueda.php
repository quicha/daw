<!DOCTYPE HTML>

<html lang="es">


		<?php
		$title= "PICSY-Búsqueda";
		
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
			<h2 class="titulos">Búsqueda avanzada</h2>

			<form name="busqueda" action="resultadobusqueda.php" method="POST">
				<fieldset title="Formulario de búsqueda" class="buscar">
					<legend id="iniciarsesion">Datos de búsqueda</legend>
						<p>
							<label for="titulo">Título:</label> <input type="text" id="titulo" name="titulo"  >
						</p>
						<p>
							<label for="desde">Fecha entre:</label> <input type="date" name="fechadesde" id="desde"/> 
							<label for="hasta">y:</label><input type="date" name="fechahasta" id="hasta" />
						</p>
						<p>
							<label class="labelForm" for="paisReg">País</label>
				<select name= "pais">
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
							<input title="Buscar foto" type="submit" value= "Buscar" class="centrado">
						</p>
				</fieldset>
			</form>
		
			<?php
		
		require_once("inc/footer.inc.php");
		?>

	</body>

</html>