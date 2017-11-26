<?php session_start(); ?>

<!DOCTYPE HTML>

<html lang="es">

<?php
	$title= "PICSY-Página principal";

 require_once("inc/head.inc.php");




?>

	<body>

		<?php
		if(isset($_SESSION["usuario"])){
			$host = $_SERVER['HTTP_HOST'];
			$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			$pag = 'index-registrado.php';
			header("Location: http://$host$uri/$pag");
		}
		?>

		<?php
			if(isset($_SESSION["usuario"])){

			require_once("inc/header2.inc.php");

		}else{
			require_once("inc/header.inc.php");
		}

			/*

			//hay que hacer está página

			<button title="Formulario iniciar sesión" id="ini" onclick="window.location.href='iniciarsesion.php">Iniciar sesión</button>

				<?php

					require_once("login.inc");      //sólo llamará aquí cuando esté la pantalla en modo tableta
			*/

			?>



		<section class="navegando">

			<ul class="navegacion">

				<li id="importante">


				<form id="contenedorb">
					<input title="Introducir nombre de foto" type="text" name="search" placeholder="Buscar...">
					<input title="Buscar foto" type="submit" name="buscar" value="Buscar" >
				</form>


				</li>
				<li title="Formulario de registro nuevos usuarios" id="registrate"><a href="registro.php">Regístrate</a></li>
				<li title="Formulario búsqueda avanzada" id="busqueda"><a href="busqueda.php">Búsqueda avanzada</a></li>
			</ul>

			<?php
			if(!isset($_COOKIE["usuario"])){
				require_once("inc/login.inc.php");

				if(isset($_GET["incorrecto"])==true&&isset($_GET["incorrecto"])=="true"){
					echo '<span id="error">';
					echo "Usuario y/o contraseña incorrectos";
					echo '</span>';
				}

			}else{
				echo "<form id='mensajesesion'>";
				echo "<fieldset id='campo'>
						<p> ¡Hola " . $_COOKIE["usuario"] . "!</p>";
				echo	"Su última conexión fue el " . $_COOKIE["fecha"] . " a las " . $_COOKIE["hora"] . " </p>";


				echo "<a href='acceder.php' id='accedo'> Acceder </a> ";
				echo "<a href='salir.php' id='salgo'> Salir </a> ";

				echo	"</fieldset>";

				echo "</form>";

			}

			?>

		</section>

		<section class="formulario">
			<h2 class="titulos">¡Entra y comparte tus fotos!</h2>

			<ul>
			    <?php
			    $link =mysqli_connect('localhost', 'root', '', 'picsy');
				mysqli_set_charset($link, "utf8");
	        	if(!mysqli_ping($link)){//Error al conectar con la base de datos
	            die('<p>No pudo conectarse:'.mysqli_connect_error().'</p>');
	        	}

	            $sentencia= 'SELECT * FROM fotos,paises WHERE fotos.pais=paises.IdPais GROUP BY Fecha DESC limit 5';
	            $resultado = mysqli_query($link, $sentencia);
				while($fila=mysqli_fetch_assoc($resultado)){
					echo "<li>
								<a href=";
								if(isset($_SESSION["nombre"])){
									echo "detalle.php?id=".$fila['IdFoto'];
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
