<?php
session_start();
if(!isset($_SESSION['ContadorError'])){
  $_SESSION['ContadorError']=3;
}else{
  if($_SESSION['ContadorError']==0){
        header("Location: ingresoConContraseña.php");
      }
}

if(!isset($_SESSION["Admin"])){

if(isset($_SESSION["User"])){
  header("Location: indexUser.php");
}    
}else{
header("Location: indexAdmin.php");
}
?>

<!DOCTYPE html>
<html>
<head>
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
   <div class="navbar-fixed"><!--Barra de navegacion-->
      <nav class="white" role="navigation">
        <div class="nav-wrapper container">
          <ul id="slide-out" class="side-nav">
            <li><a href="indexAdmin.php">Home</a></li>
            <li class="active"><a href="registro-huella.php">Registro huella</a></li>
            <li><a href="cerrarSesion.php">Cerrar sesión</a></li>
          </ul>
          <a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>
          <a id="logo-container" href="indexAdmin.php" class="brand-logo center"><i class="medium material-icons">fingerprint</i></a>
          <ul class="right hide-on-med-and-down">
            <li class="active"><a href="registro-huella.php">Registro huella</a></li>
            <li><a href="cerrarSesion.php">Cerrar sesión</a></li>
          </ul>
          <ul id="nav-mobile" class="side-nav">
            <li class="active"><a href="registro-huella.php">Registro huella</a></li>
            <li><a href="cerrarSesion.php">Cerrar sesión</a></li>
          </ul>
        </div>
      </nav>
  </div>
    <div id="carga" class="progress" style="display:block">
      <div  class="indeterminate"></div>
    </div>
    

  <form id="moodle" method="post" action="../moodle/login/index.php">
  	<input id="username" type="hidden" name="username" value=""/>
  	<input id="password" type="hidden" name="password" value=""/>
  </form>




<?php

require_once("VoiceIt.php");
$myVoiceIt = new VoiceIt();
require './app/start.php';
use Aws\S3\Exception\S3Exception;
error_reporting(E_ERROR | E_WARNING | E_PARSE);

$con = mysqli_connect("localhost", "root", "", "biofacvoz")or die("Problemas al conectar");
if ($con->connect_error) {
  die("Conexión biofacvoz fallida: " . $con->connect_error);
} 
$acentos = $con->query("SET NAMES 'utf8'");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$filenamef =  time();
	$filenamev =  time();

	$email=  $_POST["email"];
	$idioma = $_POST["idioma"];

	$encoded_dataf = $_POST['mydataf'];
	$encoded_datav = $_POST['mydatav'];

	$binary_dataf = base64_decode( $encoded_dataf );
	$binary_datav = base64_decode( $encoded_datav );

	$pathf = "saved_images/{$filenamef}.jpg";
	$pathv = "saved_audios/{$filenamev}.wav";

  $resultf = file_put_contents( $pathf, $binary_dataf );
  $resultv = file_put_contents( $pathv, $binary_datav );

	$sql = "SELECT * FROM usuarios WHERE email='$email'";
    $result= mysqli_query($con,$sql);
    $checkuser=mysqli_num_rows($result);

    if($checkuser>0){//el correo si está registrado?
    	$info = mysqli_fetch_assoc($result);
        $UserID=$info['UserID'];
        $password=$info['Password'];
        $Rol=$info['Rol'];

        $sqlUH = "SELECT * FROM usuario_huella WHERE UserID='$UserID'";//Query en la DB biofacvoz en la tabla usuario_huella para verificar que hay huellas guardadas que hagan referencia al correo de la busqueda

        $resultUH= mysqli_query($con,$sqlUH);
        $num=mysqli_num_rows($resultUH);

        if($num>0){

        	$msgf="";
            $msgv="";

        	//autenticación en voiceit
        	$response = $myVoiceIt->authentication("$email", "$password", "$pathv", "80", "$idioma");

	       	$text = guardarJson($response);
	        $r = $text["Result"];
	        if ($text["ResponseCode"] == "SUC") {
	        	$confidencialidadv = $text["Confidence"];
	        	$msgv="Reconocimiento vocal exitoso";
	        } else {
	        	$confidencialidadv=null;
	        	$msgv="Reconocimiento vocal fallido";
	        }

	        //autenticación facial
	        $imageData = base64_encode(file_get_contents($pathf));
		    $id_target="saved_images/{$email}.jpg";
		    $response = $s3->doesObjectExist($config['s3']['bucket'], "uploads/{$id_target}");
		    if($response)
		    {
    			$gestor=fopen($pathf, 'rb');
    			try { 
    				$s3->putObject([
    					'Bucket' => $config['s3']['bucket'],
    					'Key' => "uploads/{$pathf}",
    					'Body' =>  $gestor,
    					'ACL' => 'public-read']);

    				$face=$rek->detectFaces([
    					'Image' => [
    						'S3Object' => [ 
    							'Bucket' => $config['s3']['bucket'],
    							'Name' => "uploads/{$pathf}",
    						],     
    					],
    				]);

            $detallesf=$face['FaceDetails'];
            $caras=count($detallesf);
            $detallesfjson=json_encode($detallesf);
            $jsonfile1='json/FaceDetails.json';
            file_put_contents($jsonfile1, $detallesfjson);

            if($caras==1)
            {
	            	$comparation = $rek->compareFaces([
	            		'SourceImage' => [
	            			'S3Object' => [
	            				'Bucket' => $config['s3']['bucket'],
	            				'Name' => "uploads/{$pathf}",
	            			],
	            		],
	            		'TargetImage' => [
	            			'S3Object' => [
	            				'Bucket' => $config['s3']['bucket'],
	            				'Name' => "uploads/{$id_target}",
	            			],
	            		],
	            	]);
	            	$coincidencias=$comparation['FaceMatches'];
	            	$nCoincidencias=json_encode($coincidencias);
                $filejson2='json/FaceDetails_target.json';
                file_put_contents($filejson2, $nCoincidencias);
	            	if(strlen($nCoincidencias)>2)
	            	{
	            		$confidencialidadf=$comparation['FaceMatches'][0]['Similarity'];
	            		$msgf="Reconocimiento facial exitoso";
	            	}
	            	else
	        		{
	        			$confidencialidadf=null;
	        			$msgf="La imagen no corresponde a la misma persona";
	        		}
	        		$porcentajef=json_encode($confidencialidadf);

	              
	           if(!is_null($confidencialidadf) && !is_null($confidencialidadv))
	           {

            	$conm = mysqli_connect("localhost", "root", "", "moodle")or die("Problemas al conectar");
					    if ($conm->connect_error) {
					      die("Connection failed: " . $conm->connect_error);
					    }
					    $sqlm = "SELECT * FROM mdl_user WHERE email='$email'";
  						$resultm= mysqli_query($conm,$sqlm);
  						$infom = mysqli_fetch_assoc($resultm);
  						$username= $infom['username'];

              if($Rol==2){
                //echo "El usuario es un administrador<br>";
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
                //$_SESSION['User']=$_POST["email"];
                $_SESSION["User"]=array();
                $_SESSION["Admin"]=array();
                $_SESSION["Contador"]=array();
                $_SESSION['ContadorError']=array();
                session_destroy();  

                echo "<script language='javascript'>
                swal({
                    title: '¡Ingreso Exitoso!',
                    html: 'Autenticación facial exitosa con una confidencialidad de <b>$confidencialidadf %</b> <br> autenticación vocal exitosa con una confidencialidad de <b>$confidencialidadv %</b> ',
                    type: 'success',
                    confirmButtonColor: '#47A6AC',
                    confirmButtonText: 'ir a moodle',
                    allowOutsideClick: false
                }).then(function () {
                    ingresarMoodle('$username','$password');
                })
                </script>";                
              }

	           }
	                else
	                {
                      $_SESSION['ContadorError']=$_SESSION['ContadorError']-1;
                      if($_SESSION['ContadorError']==0){
                        echo "<script language='javascript'> 
                        swal({
                            title: 'Error',
                            html: 'Haz completato el numero maximo de intentos<br> seras redirigido a la pagina de ingreso por contrseña <br> Recuerda comunicarte con el administrador para la revision de las heullas vocales',
                            imageUrl: 'data:image/jpeg;base64,".$imageData."',
                            type: 'error',
                            confirmButtonColor: '#47A6AC',                            
                            confirmButtonText: 'Ingresar por contraseña',
                            allowOutsideClick: false
                        }).then(function () {
                            window.location = 'ingresoConContraseña.php';
                        }) 
                        </script>";
                      }
                      else{
                        //Error en el inicio de sesion;
                        echo "<script language='javascript'>
                        swal({
                            title: 'Error en inicio de sesión',
                            html: '".$msgf." <br> ".$msgv."<br> Intentos restantes: <b>".$_SESSION['ContadorError']." </b>',
                            imageUrl: 'data:image/jpeg;base64,".$imageData."',
                            type: 'error',
                            confirmButtonColor: '#47A6AC',                           
                            confirmButtonText: 'intentar de nuevo!',
                            allowOutsideClick: false
                        }).then(function () {
                            redireccionarPagina();
                        }) 
                        </script>";
                      }
                      
	                }
                }
                else
                {
                  if($caras>1)
                  {
                     echo "<script language='javascript'>"; 
                    echo "swal({
                        title: 'Se ha reconocido más de un rostro',
                        text: '".$msgv."',
                        imageUrl: 'data:image/jpeg;base64,".$imageData."',
                        type: 'error',
                        confirmButtonColor: '#47A6AC',";
                        echo "
                        confirmButtonText: 'intentar de nuevo!',
                        allowOutsideClick: false
                    }).then(function () {
                        redireccionarPagina();
                    })"; 
                    echo "</script>";
                  }
                  else
                  {
                    echo "<script language='javascript'>"; 
                    echo "swal({
                        title: 'No se reconoció algun rostro',
                        text: '".$msgv."',
                        imageUrl: 'data:image/jpeg;base64,".$imageData."',
                        type: 'error',
                        confirmButtonColor: '#47A6AC',";
                        echo "
                        confirmButtonText: 'intentar de nuevo!',
                        allowOutsideClick: false
                    }).then(function () {
                        redireccionarPagina();
                    })"; 
                    echo "</script>";
                  }
                }
                fclose($gestor);
                $s3->deleteMatchingObjects($config['s3']['bucket'],"uploads/{$pathf}");//elimina foto en amazon
                }
                catch (S3Exception $e) {
                    echo $e->getMessage() . "\n";
                }


    		}else
    		{
    		echo "<script language='javascript'>
        	swal({
        		title: 'Error',
                html: 'Error en <b>AWS: </b> la imagen no existe',
                type: 'error',
                confirmButtonColor: '#47A6AC',
                confirmButtonText: 'Salir',
                allowOutsideClick: false
                }).then(function () {
                    redireccionarPagina();
                })
                </script>";
    		}


        }else{
        	echo "<script language='javascript'>
        	swal({
        		title: 'El usuario no tiene huellas registradas',
                html: 'por favor contacte al siguente numero <b>3174837626</b> o al correo <b>jdkdhd@jdjd.com</b> para la creacion de las huellas biometricas correspondientes',
                type: 'error',
                confirmButtonColor: '#47A6AC',
                confirmButtonText: 'Salir',
                allowOutsideClick: false
                }).then(function () {
                    redireccionarPagina();
                })
                </script>";
        }



    }else{
    	echo "<script language='javascript'>
        	swal({
        		title: 'Error',
                text: 'El correo no está registrado',
                type: 'error',
                confirmButtonColor: '#47A6AC',
                confirmButtonText: 'Salir',
                allowOutsideClick: false
                }).then(function () {
                    redireccionarPagina();
                })
                </script>";
    }

    unlink($pathf);
    unlink($pathv);

 }else{
 	header("Location: ingreso.php");
 }

    function guardarJson($response) {
    $file = 'json/datos.json';
    file_put_contents($file, $response);

    $data = file_get_contents("json/datos.json");
    $text = json_decode($data, true);

    return $text;
    }
echo "<script language='javascript'>
document.getElementById('carga').style.display = 'none';
</script>";
?>

<script type="text/javascript">
    function redireccionarPagina() {
      window.location = "ingreso.php";
    }

    function ingresarMoodle(username,password) {
    	document.getElementById('username').value = username;
    	document.getElementById('password').value = password;
		  document.getElementById('moodle').submit();
    }
  </script>
</body>
</html>