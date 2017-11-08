<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="media/fingerprint.png">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<title>Resultados</title>
	<!--Let browser know website is optimized for mobile-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">
	<!-- Compiled and minified JavaScript -->
	<link href="https://fonts.googleapis.com/css?family=Raleway|Roboto" rel="stylesheet">
	<!--  Materialize Scripts-->
	<!--  SweetAleert2-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.css">
	<!-- Include a polyfill for ES6 Promises (optional) for IE11 and Android browser -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
	<!-- First, include the Webcam.js JavaScript Library -->
	<script type="text/javascript" src="js/webcam.js"></script>
	<link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
	<script src="js/init.js"></script>
</head>
<body >
<form id="moodle" method="post" action="../moodle/login/index.php">
	<input id="username" type="hidden" name="username" value=""/>
	<input id="password" type="hidden" name="password" value=""/>
</form>
<script type="text/javascript">
	    function redireccionarPagina() {
      window.location = "ingresoConContraseña.php";
    }
    function ingresarMoodle(username,password) {
    	document.getElementById('username').value = username;
    	document.getElementById('password').value = password;
		  document.getElementById('moodle').submit();
    }
  </script>
</body>
<?php

	if(isset($_POST["email"]) && isset($_POST["password"])){
		$email=$_POST["email"];
		$password=$_POST["password"];

		$con = mysqli_connect("localhost", "root", "", "biofacvoz")or die("Problemas al conectar");
		if ($con->connect_error) {
		  die("Connection failed: " . $con->connect_error);
		}

		$sql = "SELECT * FROM usuarios WHERE Email='".$_POST["email"]."' AND Password='".$_POST["password"]."'";

		$consulta = mysqli_query($con,$sql);
		//$num = mysqli_num_rows($consulta);
		$info = mysqli_fetch_assoc($consulta);
		$r=$info['Rol'];

		if (mysqli_num_rows($consulta) > 0){
			$conm = mysqli_connect("localhost", "root", "", "moodle")or die("Problemas al conectar");
		    if ($conm->connect_error) {
		      die("Connection failed: " . $conm->connect_error);
		    }
		    $sqlm = "SELECT * FROM mdl_user WHERE email='$email'";
			$resultm= mysqli_query($conm,$sqlm);
			$infom = mysqli_fetch_assoc($resultm);
			$username= $infom['username'];

			if($r==2){
			//echo "El usuario es un administrador<br>";
			session_start();
			$_SESSION['Admin']=$_POST["email"];
			$_SESSION['Contador']="0";
			$_SESSION['username']=$username;
            $_SESSION['password']=$password;

			//echo $_SESSION['Admin'];
			?>
			<script type="text/javascript">
				window.location="indexAdmin.php";
			</script>
			<?php

			}
			else{
				session_start();
				$_SESSION["User"]=array();
				$_SESSION["Admin"]=array();
				$_SESSION["Contador"]=array();
				$_SESSION['ContadorError']=array();
				session_destroy();
				echo "<script language='javascript'>
				ingresarMoodle('$username','$password');
				 </script>";
			}
		}
		else{
			echo "<script language='javascript'>
        	swal({
        		title: 'Error',
                html: 'Credenciales incorrectas',
                type: 'error',
                confirmButtonColor: '#47A6AC',
                confirmButtonText: 'Salir',
                allowOutsideClick: false
                }).then(function () {
                    redireccionarPagina();
                })
                </script>";
		} 
	}



?>