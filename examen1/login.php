<?php
//activar variable de sesion
session_start();

$_SESSION['autorizado'] = false;
$_SESSION['ci'] = 0;

$mensaje="";
$usuario="";
$contra="";
if(isset($_POST['usuario']) && isset($_POST['pass'])){
	if ($_POST['usuario']==""){
		$mensaje.="Ingrese su usuario<br>";
	}else if($_POST['pass']==""){
		$mensaje.="Ingrese su contraseña<br>";
		//echo $usuario." ".$
	}else{
		$usuario= strip_tags($_POST['usuario']);
		$contra=strip_tags($_POST['pass']);
		#cadena de conexion
		include "conexion.inc.php";

		$query="SELECT * FROM usuario WHERE usuario = '".$usuario."' AND password_u ='".$contra."';";
		
		$resultado = $conn->query($query);
		$usuarios = $resultado->fetch_all(MYSQLI_ASSOC);
		/*echo "<pre>";
		print_r($usuarios);
		echo "</pre>";
		*/
		//Contamos la cantidad 
		$cantidad= count($usuarios);
		if ($cantidad == 1){
			$mensaje.="Datos correctos<br>";
			//Redireccionando a la pagina donde puede ver sus notas
			$_SESSION['autorizado']=true;
			$_SESSION['ci']=$usuarios[0]['ci'];
			$_SESSION['tipo']=false;
			if ($usuarios[0]['tipo']=='E'){
				$_SESSION['tipo']=true;
			} 
			echo '<meta http-equiv="refresh"content="1; url=perfil.php">';
		}else{
			$mensaje.="Credenciales incorrectas<br>";
		}
	}
}

?>
<html>
    <head>
        <meta charset="utf-8">
        <title>LOGIN</title>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="icon" type="image/x-icon" href="favicon.ico">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.3/TweenMax.min.js"></script>
        <link href="styles.d41d8cd98f00b204e980.bundle.css" rel="stylesheet"/>
        <link href="logcss.css" rel="stylesheet"/>
    </head>
<body>

<form method="POST" action='login.php'>
	<center>
		<img src="fcpn.png" alt="HOLA" class="imagen" width='160px'>
	</center>
	<br>	
	<div style="color: red;">
		<h2><?php echo $mensaje; ?></h2>
	</div>
	<div class="inputGroup inputGroup1">
		<label for="loginEmail" id="loginEmailLabel">Usuario</label>
		<input type="text" maxlength="254" name="usuario"/>
		<p class="helper helper1"></p>
	</div>
	<div class="inputGroup inputGroup2">
		<label>Contraseña</label>
		<input type="password" id="loginPassword" name="pass"/>
	</div>
	<div class="inputGroup inputGroup3">
		<button id="login">Log in</button>
	</div>	
</form>
</body>
</html>
