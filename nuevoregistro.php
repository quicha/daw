<!DOCTYPE HTML>


<html lang="ES">
<?php
	$title= "PICSY-Registro correcto";
  
 require_once("inc/head.inc.php"); 
 
 
 
 
?>
	<body>
	
	
		
	<?php
	// llamamos al pie de página
		if(isset($_SESSION["usuario"])){
		
			require_once("inc/header2.inc.php");

		}else{
			require_once("inc/header.inc.php");
		}
	?>
	
	
	
	<?php
	
		$link =mysqli_connect('localhost', 'root', '', 'picsy');
				mysqli_set_charset($link, "utf8");
	        	if(!mysqli_ping($link)){//Error al conectar con la base de datos
	            die('<p>No pudo conectarse:'.mysqli_connect_error().'</p>');
	        	}

		$nombre=$_POST['nombre'];
		$contra=$_POST['contra'];
		$contra2=$_POST['contra2'];
		$email=$_POST['email'];
		$sexo=$_POST['sexo'];
		$fecha=$_POST['fecha'];
		$ciudad=$_POST['ciudad'];
		$pais=$_POST['pais'];
		$foto="miimagen.jpg";
		$hora = date ("Y-m-d H:i:s"); // para la fecha de registro
		
		$validado=true;
		$msg="";
		
						//lo tiene que introducir por cojones
		if($sexo== "Hombre"){
			$sexo=1;
		}else{
			$sexo=0;
		}
						
						
						
	// Filtrando el nombre de usuario 
		if(preg_match("/^[A-Za-z0-9]{3,15}$/",$nombre)==false){
			$validado=false;
			$msg = $msg. "Formato de nombre incorrecto <br>";
		}
	
	// Controlamos que el nombre de usuario no esté repetido en nuestra base de datos
	
				//nombre repetido
		$consulta = "SELECT count(IdUsuario) FROM usuario WHERE NomUsuario='" .$nombre. "'";
		
		
		$resultado = mysqli_query($link, $consulta);

		$fila=mysqli_fetch_assoc($resultado);
		
						
		if(($fila['count(IdUsuario)'])>0){
			$validado=false;
			$msg=$msg . "El nombre está repetido <br>";
			
			
		}
		
		

		
		
	// Filtrando la contraseña
							
			
		if(preg_match("/(?!^[0-9]*$)(?!^[a-z]*$)(?!^[A-Z]*$)^([\w]{6,15})$/",$contra)==false){
			$validado=false;
			$msg=$msg . "Formato de contraseña incorrecto <br>";
		}
		
		
		
	//Comprobando que al repetir contraseña, coinciden
	
	
		if($contra2!=$contra){
			$validado=false;
			$msg=$msg . "Las contraseñas no coinciden <br>";
		}
		
		
	//Filtrando el email
	
	
		if(filter_var($email, FILTER_VALIDATE_EMAIL)==false){
			$validado=false;
			$msg=$msg . "Formato de email incorrecto <br>";
		}
		
		
	//Comprobando que el email no esté siendo utilizado ya 	
		
		$consulta2="SELECT count(IdUsuario) FROM usuario WHERE email='".$email."'";
		$resultado2 = mysqli_query($link, $consulta2);
		$fila=mysqli_fetch_assoc($resultado2);
		
						
		if(($fila['count(IdUsuario)'])>0){
			$validado=false;
			$msg=$msg . "Este email ya está siendo utilizado<br>";
		}
		
		
		
		
	//Aquí filtramos la fecha de nacimiento del usuario y la ordenamos para poder manipularla
		$fechaAux=$fecha;
        $arrayFecha = explode('/', $fechaAux);
        if(count($arrayFecha)==1){
            $arrayFecha = explode('-', $fechaAux);
            if(count($arrayFecha)==3){//Reorganizamos la fecha para ponerla en el formato de españa
                $aux = $arrayFecha[0];
                $arrayFecha[0] = $arrayFecha[2];
                $arrayFecha[2] = $aux;
                      
                $fechaConvertida = "$arrayFecha[2]/$arrayFecha[1]/$arrayFecha[0]";
               
                if(checkdate($arrayFecha[1], $arrayFecha[0], $arrayFecha[2])!=true){
                    $validado=false;
					$msg=$msg . "Valores incorrectos de día o mes <br>";
                }
            }else{
                $validado=false;
				$msg=$msg . "Formato incorrecto de la fecha<br>";
            }
        }else if(count($arrayFecha)==3){
            $fechaConvertida = "$arrayFecha[2]-$arrayFecha[1]-$arrayFecha[0]";
            if(checkdate($arrayFecha[1], $arrayFecha[0], $arrayFecha[2])!=true){
                $validado=false;
				$msg=$msg . "Valores incorrectos de día o mes<br>";
            }
        }else{
            $validado=false;
			$msg=$msg . "Formato incorrecto de la fecha<br>";
        }	
		
		if($arrayFecha[2]>1999){
			
			$validado =false;
			
			$msg=$msg . "Revisa tu año de nacimiento<br>";
		}
	
	//aquí ya hacemos el insert en la base de datos 
	
		if($validado){
			//aqui hago la sentencia insert
			$sentencia="INSERT INTO usuario(NomUsuario, Clave, Email, Sexo, FNacimiento, Ciudad, Pais, FRegistro, Foto)
						VALUES ('".$nombre."','" .$contra. "','" .$email. "','" .$sexo. "','" .$fechaConvertida. "','" .$ciudad. "','" .$pais. "','" .$hora. "','" .$foto."')";
			if($resultado = $link->query($sentencia)) {
					?>
		<div class="detalle">
	
		<fieldset>
		<legend>Registrado con éxito </legend>
		<div class="datos">
		<?php
			if($nombre!=""){ echo "<b>Nombre de usuario:</b> " . $nombre . "<br>";}
			if($contra!=""){ echo "<b>Contraseña: </b>" . $contra . "<br>";}
			if($email!=""){ echo "<b>E-mail: </b>" . $email . "<br>";}
			if($fecha!=""){ echo "<b>Fecha de nacimiento: </b> " . $fecha . "<br>";}
			if($_POST['sexo']!=""){ echo "<b>Sexo:</b> " . $_POST['sexo'] . "<br>";}
			if($_POST['ciudad']!=""){ echo "<b>Localidad: </b>" . $_POST['ciudad'] . "<br>";}
			
			
			$consulta3 = 'SELECT * FROM paises WHERE IdPais="' . $_POST['pais'] . '"';
			$resultado3 = mysqli_query($link, $consulta3);
			$fila=mysqli_fetch_assoc($resultado3);
			
			
			if($_POST['pais']!=""){ echo "<b>Pais: </b>" . $fila['NomPais']. "<br>";}
			
			
			
			
			

		?>
			
			
		<br><a href='index.php'>Volver al inicio</a><br><br>
		</div></div>
		</fieldset>
		
		</form>
	<?php
			}else{
				//error de sentencia
				echo "<p>Error al ejecutar la sentencia <b>" .$sentencia. "</b>: " . $link->error;
				echo "</p>";
				exit;
			}
		}else{
			//campos incorrectos
			echo "<div class='detalle'><div class='datos'>" . $msg . "<br>";
			echo "<a href='registro.php'>Volver al registro</a></div></div><br><br>";
		}
	
?>
		
		
							



	
	
	
	
		
	<?php
	// llamamos al pie de página
		require_once("inc/footer.inc.php");
	?>
	
	
	
	</body>
	
</html>

