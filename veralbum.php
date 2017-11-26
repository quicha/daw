<!DOCTYPE HTML>

<!--Contiene un formulario con los datos necesarios para crear un álbum (título, descripción, fecha y país).-->
<html lang="es">
	<?php
		$title= "PICSY-Ver álbum";
		require_once("inc/head.inc.php");
		?>

	<body>

			<?php
		
		if(isset($_SESSION["usuario"])){
					
		
			require_once("inc/header2.inc.php");
				}

		else{
			require_once("inc/header.inc.php");
		}
		?>

		<h2 class="titulos">Elige tu álbum</h2>

		
				<p>
					
				<p>
							<?php
					
											// Conecta con el servidor de MySQL 
					$link =mysqli_connect('localhost', 'root', '', 'picsy');
					mysqli_set_charset($link, "utf8");
    				if(!mysqli_ping($link)){//Error al conectar con la base de datos
    				die('<p>No pudo conectarse:'.mysqli_connect_error().'</p>');
   					 }


   					 $sentenciaIdAlbum ="SELECT * FROM fotos,albumes,paises WHERE albumes.Titulo= '".$_POST['album']."' AND fotos.Album = albumes.idAlbum AND fotos.Pais = paises.IdPais";
   		
   					
   					 $resultado = mysqli_query($link, $sentenciaIdAlbum);
					 
					$puesto=false;
					 
   					 while($fila=mysqli_fetch_assoc($resultado)){
							
							$puesto=true;
							
   					 		echo "<ul>
								<a href=";
								
									echo "detallefoto.php?id=".$fila['IdFoto'];
								
					echo "		><img alt=".$fila['Titulo']." src='".$fila['Fichero']."'/></a>
							<p>
								<b>Título: ".$fila['Titulo']."</b>
							</p>
							<p>
								<b>País: ".$fila['NomPais']."</b>
							</p>
							<p>
								<b>Fecha: ".$fila['Fregistro']."</b>
							</p></ul>";
						}
					if(!$puesto){
						echo "<p> El álbum seleccionado no tiene fotografías todavía </p>";
						echo "<a href='misalbumes.php' id='misalbumes'>Mis álbumes</a></li>";
					}
					
				
					?>
				</p>

		
	<?php
		
		require_once("inc/footer.inc.php");
		?>
	</body>

</html>
</html>