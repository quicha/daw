<!DOCTYPE HTML>
<html lang="es">

	<?php
		$title= "PICSY- Añadir foto";
		require_once("inc/head.inc.php");
		?>

	<body>
	
	<main>
		<?php
		
			if(isset($_SESSION["usuario"])){
			
				require_once("inc/header2.inc.php");

			}else{
				require_once("inc/header.inc.php");
			}
			?>
			<br>

			<h2 class='titulos'>Añade una foto</h2>

			<form method="post" enctype="multipart/form-data" action="respuesta_añadirfoto.php" >
			<fieldset>
			
				<legend>Rellena los datos</legend>
				
							
							<p><label for="titulo">Título:</label> <input type="text" name="titulo" accept="image/*" id="titulo" required ></p>
							<p><label for="titulo">Descripción:</label> <input type="text" name="descripcion" accept="image/*" id="titulo" required ></p>
							<p>
								<label for="fecha">Fecha:</label> <input type="date" name="fecha" id="fecha" required />
							</p>
							
							<label class="labelForm" for="pais">País</label>
							<select name="pais" id="pais">
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
							<p><label>Álbum:</label>




								<?php 

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
									 $sentencia = 'SELECT * FROM albumes'; 
									 if(!($resultado = @mysqli_query($link,$sentencia))) { 
									   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link); 
									   echo '</p>'; 
									   exit; 
									 } 
									 
									  echo '<select name="album">';
									  
									  echo '<option name="album" value=""></option>'; 
									 while($fila = mysqli_fetch_assoc($resultado)){
										
										
										echo '<option name="album" value='.$fila['Titulo'].'>'. $fila['Titulo'] . '</option>'; 
										 
										
										
										 
									 
									 }
									echo '</select>';
									
							?>
							</p>
		<p><label><b>Foto:</b></label></p> <!--Hay que centrarlo en la pagina con CSS-->
    	<input type="file" name="imagen">

		</fieldset>

		
    	<input title="Añadir foto" value="Añadir foto" type="submit" class="centrado" >
		</form>

		
	</main>
	
		<?php
		
		require_once("inc/footer.inc.php");
		?>
		
	</body>

</html>