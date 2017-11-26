<?php session_start(); ?>
	

<!DOCTYPE HTML>

<html lang="es">

<?php

  $title=" PICSY- Página principal registrado";
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
		<section>

			<ul class="navegacion">
			
				<li>
				
				
				<form id="contenedorb">
					<input title="Introduzca nombre de la foto" type="text" name="search" placeholder="Buscar...">
					<input title="Buscar imagen" type="submit" type="submit" name="buscar" value="Buscar" >
				</form>

				
				</li>
				<li title="Desconectar tu usuario de la página" id="registrate"><a href="cerrarsesion.php">Cerrar sesión</a></li>
				<li title="Datos del usuario y acciones de usuario" id="menudelusuario"><a href="menuusuarioregistrado.php">Menú del usuario</a></li>
				<li title="Formulario de búsqueda avanzada" id="busqueda"><a href="busqueda.php">Búsqueda avanzada</a></li>
			</ul>

		</section>

		<section class="formulario">
		

	 	<ul>
			<?php
			    $link =mysqli_connect('localhost', 'root', '', 'picsy');
				mysqli_set_charset($link, "utf8");
	        	if(!mysqli_ping($link)){//Error al conectar con la base de datos
	            die('<p>No pudo conectarse:'.mysqli_connect_error().'</p>');
	        	}

	            $sentencia= 'SELECT * FROM fotos,paises WHERE fotos.pais=paises.IdPais GROUP BY FRegistro ASC limit 5';
	            $resultado = mysqli_query($link, $sentencia);
				while($fila=mysqli_fetch_assoc($resultado)){
					echo "<li>
								<a href=";
								if(isset($_SESSION["usuario"])){
									echo "detallefoto.php?id=".$fila['IdFoto'];
								}else{
									echo "";
								}
					echo "		><img alt=".$fila['Titulo']." src='".$fila['Fichero']."'/></a>
							<p>
								<b>Título: ".$fila['Titulo']."</b>
							</p>
							<p>
								<b>País: ".$fila['NomPais']."</b>
							</p>
							<p>
								<b>Fecha: ".$fila['Fecha']."</b>
							</p></li>";
				}
				mysqli_free_result($resultado);
	        
			    ?>
		 </ul>
		</section>
	
<?php

  
 require_once("inc/footer.inc.php"); 
 
 
 
 
?>

	</body>

</html>