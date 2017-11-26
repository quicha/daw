<!DOCTYPE HTML>
<html lang="es">

	<?php
		$title= "PICSY- Álbum solicitado";
		require_once("inc/head.inc.php");
		?>

	<body>
		<?php


		if(isset($_SESSION["usuario"])){
					if(($_POST["usuario"]=="usuario1" && $_POST["password"]=="uno")
				|| ($_POST["usuario"]=="usuario2" && $_POST["password"]=="dos")
				|| ($_POST["usuario"]=="usuario3" && $_POST["password"]=="tres")){
		
			require_once("inc/header2.inc.php");
			
				}

		}else{
			require_once("inc/header.inc.php");
		}
		?>
		<br>

		

		
		
	<main>

		<?php
		$multiplicador=0;
		$resol=0;
		$text ="";
		//blanco y negro
		
		if(isset($_POST["tipo"]) && $_POST["tipo"] == 'Blanco y negro'){
			
				$text = $_POST["tipo"];
				

			}
			else{
				$text = $_POST["tipo"];
				$multiplicador=0.5;


			}
		
		//a color

		if(isset($_POST["resolution_control"])){
			if($_POST["resolution_control"] > 300){
				$resol=0.02;
			}
		}		
		//$price = 2 + $_POST["copias"] * $multiplicador * $_POST["resolution_control"]/150*0.20;
		$price = (20 * 0.07 + ($multiplicador * 50) + (50 * $resol)) * $_POST["copias"];
		echo "
				<h2 class='titulos'>¡Solicitud de álbum registrada!</h2>

		<fieldset>
			<legend><h3 id='iniciarsesion'>Datos del álbum</h3></legend>
			<p><b>Nombre:</b>"; 
		?>
		<?php
			if(isset($_POST['nombre'])){
				echo $_POST['nombre'];
			}else{
				echo "no";
			}

		?>
		<?php
			echo "</p>
			<p><b>Título del álbum:</b>". $_POST['titulo']."</p>
			<p><b>Texto adicional:</b>". $_POST['adicional']."</p>
			<p><b>Color de portada:</b> </p>
			<input type='color' name='color-confirmacion' value='".$_POST['tipocolor']."'/>
			<p><b>Número de copias:</b>". $_POST['copias']."</p>
			<p><b>Resolución:</b>". $_POST['resolution_control']."</p>
			<p><b>Impresión a:</b>". $text."
			</p>

			
			<p><b>Precio final:</b>". $price ."€</p>
			<p><a type='submit'href='menuusuarioregistrado.php' id='albumnuevo' class='centrado'>Volver a la página principal<a></p>

		</fieldset>";
		?>		
	</main>
	
		<?php
		
		require_once("inc/footer.inc.php");
		?>
		
	</body>

</html>