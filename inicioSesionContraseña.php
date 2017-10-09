<?php

	if(isset($_POST["email"]) && isset($_POST["password"])){

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

			if($r==2){
			//echo "El usuario es un administrador<br>";
			session_start();
			$_SESSION['Admin']=$_POST["email"];
			//echo $_SESSION['Admin'];
			?>
			<script type="text/javascript">
				window.location="indexAdmin.php";
			</script>
			<?php

			}
			else{
				session_start();
				$_SESSION['email']=$_POST["email"];
				?>
				<script type="text/javascript">
					window.location="index2.php";
				</script>
				<?php
			}
		}
		else{
			echo "Error en inicio de sesion";
		} 
	}



?>