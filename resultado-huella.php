<?php
  session_start();
  if(!isset($_SESSION["Admin"])){

    if(isset($_SESSION["User"])){
      header("Location: indexUser.php");
    }else{
      header("Location: index.php");
    }   
  }
?>
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
    <script type="text/javascript">
  <script type="text/javascript">
    function redireccionarPagina() {
      window.location = "registro-huella.php";
    }
  </script>

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


    $conMoodle = mysqli_connect("localhost", "root", "", "moodle")or die("Problemas al conectar");
    if ($conMoodle->connect_error) {
      die("Conexión Moodle fallida: " . $con->connect_error);
    }
    $acentos2 = $conMoodle->query("SET NAMES 'utf8'");


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $email=  $_POST["email"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM usuarios WHERE email='$email'";//Query en la DB biofacvoz para revisar si hay un email igual
        $result= mysqli_query($con,$sql);
        $checkuser=mysqli_num_rows($result);

        if($checkuser>0){//correo registraro?

          $info = mysqli_fetch_assoc($result);
        
          if($password==$info['Password']){//contraseña db es correcta?

            $sql = "SELECT * FROM mdl_user WHERE email='$email'";//Query en la DB moodle para revisar si hay un email igual
            $result= mysqli_query($conMoodle,$sql);
            $checkuser=mysqli_num_rows($result);

            if($checkuser>0){
              $info = mysqli_fetch_assoc($result);
              if(password_verify($password, $info['password'])){//contraseña moodle es igual?
                //inicio metodo facial
                $id_img=  $_POST["email"];
                $path="saved_images/{$id_img}.jpg";
                $response = $s3->doesObjectExist($config['s3']['bucket'], "uploads/{$path}");
                if(!$response){
                  $encoded_data = $_POST['mydata4'];
                  $binary_data = base64_decode( $encoded_data );
                  $result = file_put_contents( $path, $binary_data );
                  if (!$result) die("Could not save image!  Check file permissions.");
                  $final_name=$path;
                  $gestor=fopen($path, 'rb');
                  try {
                    $s3->putObject([
                      'Bucket' => $config['s3']['bucket'],
                      'Key' => "uploads/{$final_name}",
                      'Body' =>  $gestor,
                      'ACL' => 'public-read'
                    ]);
                    $result = $s3->getObject([
                      'Bucket' => $config['s3']['bucket'],
                      'Key' => "uploads/{$final_name}",
                    ]);
                    $enlace=$result["@metadata"]["effectiveUri"];
                    $imageData = base64_encode(file_get_contents($enlace));
                    $face=$rek->detectFaces([
                      'Image' => [
                        'S3Object' => [
                          'Bucket' => $config['s3']['bucket'],
                          'Name' => "uploads/{$final_name}",
                        ],     
                      ],
                      'Attributes'=>["ALL"],
                    ]);
                    $c=$face['FaceDetails'];
                    $caras=count($c);
                    $d=json_encode($c);
                    if($caras==1)
                    {
                      $a=$face['FaceDetails'][0]['Confidence'];
                    }
                    else{
                      $a=null;
                    }
                    $b=json_encode($a);
                    $file='json/FaceDetails.json';
                    file_put_contents($file, $d);
                    $labels = $rek->detectLabels([
                      'Image' => [
                        'S3Object' => [
                          'Bucket' => $config['s3']['bucket'],
                          'Name' => "uploads/{$final_name}",
                        ],
                      ],
                    ]);
                    $l=json_encode($labels['Labels']);
                    $file='json/Labels.json';
                    file_put_contents($file, $l);
                    fclose($gestor);
                    if($caras==1){
                      $validarpose=false;
                      $valMin=-10;
                      $valMax=10;
                      if($face['FaceDetails'][0]['Pose']['Yaw']>=$valMin && $face['FaceDetails'][0]['Pose']['Pitch']>=$valMin &&  $face['FaceDetails'][0]['Pose']['Roll']>=$valMin && $face['FaceDetails'][0]['Pose']['Yaw']<=$valMax && $face['FaceDetails'][0]['Pose']['Pitch']<=$valMax &&  $face['FaceDetails'][0]['Pose']['Roll']<=$valMax){
                        $validarpose=true;
                          echo'<script type="text/javascript">
                          var newsrc = "0";
                          function changeImage() {
                            if ( newsrc == "0" ) {
                              document.getElementById("my_image").src = document.getElementById("df-img").src;
                              newsrc  = "1";
                            }else
                            {
                              document.getElementById("my_image").src= "data:image/jpeg;base64,'.$imageData.'";
                              newsrc  = "0";
                            }
                          }
                          </script>';
                          echo '<section class="aboutContent">
                          <div id="tarjeta" class="container row" style="display:none">
                          <div class="col s12 m2 l2">
                          </div>
                          <div class="col s12 m6 l8">
                          <div class="card">
                          <div class="card-image">
                          <img id="my_image" class="responsive-img materialboxed" data-caption="'.$b." %".' de precisión" src="data:image/jpeg;base64,'.$imageData.'">
                          </div>
                          <div class="card-content">
                          <span class="card-title activator grey-text text-darken-4">'.$id_img.'</span>
                          <a onClick="changeImage()" class="btn-floating btn-large halfway-fab waves-effect waves-light red right tooltipped" data-position="top" data-delay="50" data-tooltip="Marcadores"><i class="material-icons">mood</i></a>
                          <p>Rostro detectado exitosamente.</p>
                          </div>
                          <div class="card-tabs">
                          <ul class="tabs tabs-fixed-width">
                          <li class="tab"><a class="active" href="#test4">Detección Facial</a></li>
                          <li class="tab"><a href="#test5">Detalles Faciales</a></li>
                          <li class="tab"><a href="#test6">Etiquetas</a></li>
                          </ul>
                          </div>
                          <div class="card-content blue-grey lighten-4">
                          <div class="center-align" id="test4">Confidencialidad de detección: '.$b." %".'</div>
                          <div class="center-align" id="test5">
                          <img style="display:none" id="df-img" class="responsive-img materialboxed" data-caption="se muestran los landmarks" width="150" src="" style="margin: auto;position: relative;top:0;bottom:0;left:0;right:0;">
                          <a href="json/FaceDetails.json" target="_blank" >Detalles faciales</a></div>
                          <div class="center-align" id="test6"><a href="json/Labels.json" target="_blank" >Etiquetas</a></div>
                          </div>
                          </div>
                          </div>
                          </div> 
                          </div>    
                          </section>';
                        }
                        else{
                          unlink($path);
                          $s3->deleteMatchingObjects($config['s3']['bucket'],"uploads/{$final_name}");
                          echo "<script language='javascript'>
                          swal({
                          title: 'El rostro no está centrado',
                          imageUrl: 'data:image/jpeg;base64,".$imageData."',
                          type: 'error',
                          confirmButtonColor: '#47A6AC',
                          confirmButtonText: 'intentar de nuevo!',
                          allowOutsideClick: false}).then(function () {
                          redireccionarPagina();})
                          </script>";
                        }
                      }
                      else
                      {
                        unlink($path);
                        $s3->deleteMatchingObjects($config['s3']['bucket'],"uploads/{$final_name}");
                        if($caras>1)
                        {
                          echo "<script language='javascript'>
                          swal({
                          title: 'Hay más de un rostro',
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
                        else
                        {
                         echo "<script language='javascript'>
                         swal({
                          title: 'No se reconoció algun rostro',
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
                    catch (S3Exception $e) {
                      echo $e->getMessage() . "\n";
                    }
                    if($caras==1 && $validarpose)
                    {
                      echo '
                      <canvas id="myCanvas" width="600" height="460" style="display:none">
                      </canvas>
                      <script>
                      window.onload = function() {
                        var c=document.getElementById("myCanvas");
                        var ctx=c.getContext("2d");
                        var img=document.getElementById("my_image");
                        ctx.drawImage(img,0,0);
                        //ojo1
                        ctx.beginPath();
                        ctx.lineWidth = "3";
                        ctx.strokeStyle = "#1565c0";
                        ctx.arc(600*'.json_encode($face['FaceDetails'][0]['Landmarks'][0]['X']).', 460*'.json_encode($face['FaceDetails'][0]['Landmarks'][0]['Y']).', 1, 0, 2 * Math.PI);
                        ctx.stroke();

                        //ojo2
                        ctx.beginPath();
                        ctx.lineWidth = "3";
                        ctx.strokeStyle = "#1565c0";
                        ctx.arc(600*'.json_encode($face['FaceDetails'][0]['Landmarks'][1]['X']).', 460*'.json_encode($face['FaceDetails'][0]['Landmarks'][1]['Y']).', 1, 0, 2 * Math.PI);
                        ctx.stroke();
                        //nariz
                        ctx.beginPath();
                        ctx.lineWidth = "3";
                        ctx.strokeStyle = "#1976d2";
                        ctx.arc(600*'.json_encode($face['FaceDetails'][0]['Landmarks'][2]['X']).', 460*'.json_encode($face['FaceDetails'][0]['Landmarks'][2]['Y']).', 1, 0, 2 * Math.PI);
                        ctx.stroke();

                        //boca1
                        ctx.beginPath();
                        ctx.lineWidth = "3";
                        ctx.strokeStyle = "#1e88e5";
                        ctx.arc(600*'.json_encode($face['FaceDetails'][0]['Landmarks'][3]['X']).', 460*'.json_encode($face['FaceDetails'][0]['Landmarks'][3]['Y']).', 1, 0, 2 * Math.PI);
                        ctx.stroke();

                        //boca2
                        ctx.beginPath();
                        ctx.lineWidth = "3";
                        ctx.strokeStyle = "#1e88e5";
                        ctx.arc(600*'.json_encode($face['FaceDetails'][0]['Landmarks'][4]['X']).', 460*'.json_encode($face['FaceDetails'][0]['Landmarks'][4]['Y']).', 1, 0, 2 * Math.PI);
                        ctx.stroke();

                      
                        //boca2
                        ctx.beginPath();
                        ctx.lineWidth = "3";
                        ctx.strokeStyle = "#1e88e5";
                        ctx.arc(600*'.json_encode($face['FaceDetails'][0]['Landmarks'][7]['X']).', 460*'.json_encode($face['FaceDetails'][0]['Landmarks'][7]['Y']).', 1, 0, 2 * Math.PI);
                        ctx.stroke();

                        //boca2
                        ctx.beginPath();
                        ctx.lineWidth = "3";
                        ctx.strokeStyle = "#1e88e5";
                        ctx.arc(600*'.json_encode($face['FaceDetails'][0]['Landmarks'][8]['X']).', 460*'.json_encode($face['FaceDetails'][0]['Landmarks'][8]['Y']).', 1, 0, 2 * Math.PI);
                        ctx.stroke();

                        //boca2
                        ctx.beginPath();
                        ctx.lineWidth = "3";
                        ctx.strokeStyle = "#1e88e5";
                        ctx.arc(600*'.json_encode($face['FaceDetails'][0]['Landmarks'][9]['X']).', 460*'.json_encode($face['FaceDetails'][0]['Landmarks'][9]['Y']).', 1, 0, 2 * Math.PI);
                        ctx.stroke();

                        //boca2
                        ctx.beginPath();
                        ctx.lineWidth = "3";
                        ctx.strokeStyle = "#1e88e5";
                        ctx.arc(600*'.json_encode($face['FaceDetails'][0]['Landmarks'][10]['X']).', 460*'.json_encode($face['FaceDetails'][0]['Landmarks'][10]['Y']).', 1, 0, 2 * Math.PI);
                        ctx.stroke();

                        //boca2
                        ctx.beginPath();
                        ctx.lineWidth = "3";
                        ctx.strokeStyle = "#1e88e5";
                        ctx.arc(600*'.json_encode($face['FaceDetails'][0]['Landmarks'][11]['X']).', 460*'.json_encode($face['FaceDetails'][0]['Landmarks'][11]['Y']).', 1, 0, 2 * Math.PI);
                        ctx.stroke();

                        //boca2
                        ctx.beginPath();
                        ctx.lineWidth = "3";
                        ctx.strokeStyle = "#1e88e5";
                        ctx.arc(600*'.json_encode($face['FaceDetails'][0]['Landmarks'][12]['X']).', 460*'.json_encode($face['FaceDetails'][0]['Landmarks'][12]['Y']).', 1, 0, 2 * Math.PI);
                        ctx.stroke();

                        //boca2
                        ctx.beginPath();
                        ctx.lineWidth = "3";
                        ctx.strokeStyle = "#1e88e5";
                        ctx.arc(600*'.json_encode($face['FaceDetails'][0]['Landmarks'][13]['X']).', 460*'.json_encode($face['FaceDetails'][0]['Landmarks'][13]['Y']).', 1, 0, 2 * Math.PI);
                        ctx.stroke();

                        //boca2
                        ctx.beginPath();
                        ctx.lineWidth = "3";
                        ctx.strokeStyle = "#1e88e5";
                        ctx.arc(600*'.json_encode($face['FaceDetails'][0]['Landmarks'][14]['X']).', 460*'.json_encode($face['FaceDetails'][0]['Landmarks'][14]['Y']).', 1, 0, 2 * Math.PI);
                        ctx.stroke();

                        //boca2
                        ctx.beginPath();
                        ctx.lineWidth = "3";
                        ctx.strokeStyle = "#1e88e5";
                        ctx.arc(600*'.json_encode($face['FaceDetails'][0]['Landmarks'][15]['X']).', 460*'.json_encode($face['FaceDetails'][0]['Landmarks'][15]['Y']).', 1, 0, 2 * Math.PI);
                        ctx.stroke();

                         //boca2
                        ctx.beginPath();
                        ctx.lineWidth = "3";
                        ctx.strokeStyle = "#1e88e5";
                        ctx.arc(600*'.json_encode($face['FaceDetails'][0]['Landmarks'][16]['X']).', 460*'.json_encode($face['FaceDetails'][0]['Landmarks'][16]['Y']).', 1, 0, 2 * Math.PI);
                        ctx.stroke();

                        ctx.beginPath();
                        ctx.lineWidth = "3";
                        ctx.strokeStyle = "#1e88e5";
                        ctx.arc(600*'.json_encode($face['FaceDetails'][0]['Landmarks'][17]['X']).', 460*'.json_encode($face['FaceDetails'][0]['Landmarks'][17]['Y']).', 1, 0, 2 * Math.PI);
                        ctx.stroke();

                        ctx.beginPath();
                        ctx.lineWidth = "3";
                        ctx.strokeStyle = "#1e88e5";
                        ctx.arc(600*'.json_encode($face['FaceDetails'][0]['Landmarks'][18]['X']).', 460*'.json_encode($face['FaceDetails'][0]['Landmarks'][18]['Y']).', 1, 0, 2 * Math.PI);
                        ctx.stroke();

                        ctx.beginPath();
                        ctx.lineWidth = "3";
                        ctx.strokeStyle = "#1e88e5";
                        ctx.arc(600*'.json_encode($face['FaceDetails'][0]['Landmarks'][19]['X']).', 460*'.json_encode($face['FaceDetails'][0]['Landmarks'][19]['Y']).', 1, 0, 2 * Math.PI);
                        ctx.stroke();

                        ctx.beginPath();
                        ctx.lineWidth = "3";
                        ctx.strokeStyle = "#1e88e5";
                        ctx.arc(600*'.json_encode($face['FaceDetails'][0]['Landmarks'][20]['X']).', 460*'.json_encode($face['FaceDetails'][0]['Landmarks'][20]['Y']).', 1, 0, 2 * Math.PI);
                        ctx.stroke();

                        ctx.beginPath();
                        ctx.lineWidth = "3";
                        ctx.strokeStyle = "#1e88e5";
                        ctx.arc(600*'.json_encode($face['FaceDetails'][0]['Landmarks'][21]['X']).', 460*'.json_encode($face['FaceDetails'][0]['Landmarks'][21]['Y']).', 1, 0, 2 * Math.PI);
                        ctx.stroke();

                        ctx.beginPath();
                        ctx.lineWidth = "3";
                        ctx.strokeStyle = "#1e88e5";
                        ctx.arc(600*'.json_encode($face['FaceDetails'][0]['Landmarks'][22]['X']).', 460*'.json_encode($face['FaceDetails'][0]['Landmarks'][22]['Y']).', 1, 0, 2 * Math.PI);
                        ctx.stroke();

                        ctx.beginPath();
                        ctx.lineWidth = "3";
                        ctx.strokeStyle = "#1e88e5";
                        ctx.arc(600*'.json_encode($face['FaceDetails'][0]['Landmarks'][23]['X']).', 460*'.json_encode($face['FaceDetails'][0]['Landmarks'][23]['Y']).', 1, 0, 2 * Math.PI);
                        ctx.stroke();

                        ctx.beginPath();
                        ctx.lineWidth = "3";
                        ctx.strokeStyle = "#1e88e5";
                        ctx.arc(600*'.json_encode($face['FaceDetails'][0]['Landmarks'][24]['X']).', 460*'.json_encode($face['FaceDetails'][0]['Landmarks'][24]['Y']).', 1, 0, 2 * Math.PI);
                        ctx.stroke();

                        //caja
                        ctx.beginPath();
                        ctx.lineWidth = "3";
                        ctx.strokeStyle = "#ef5350";
                        ctx.rect(600*'.json_encode($face['FaceDetails'][0]['BoundingBox']['Left']).', 460*'.json_encode($face['FaceDetails'][0]['BoundingBox']['Top']).'-5, 600*'.json_encode($face['FaceDetails'][0]['BoundingBox']['Width']).', 460*'.json_encode($face['FaceDetails'][0]['BoundingBox']['Height']).');
                        ctx.stroke();

                        var img = new Image();
                        img.src = c.toDataURL();
                        document.getElementById("df-img").src=img.src;
                      };
                      </script> ';
                      }
                    }
                    else{
                       echo "<script language='javascript'>
                       swal({
                        title: 'Ha ocurrido un error',
                        text: 'El correo ingresado ya posee una huella facial',
                        type: 'error',
                        confirmButtonColor: '#47A6AC',
                        confirmButtonText: 'intentar de nuevo!',
                        allowOutsideClick: false
                      })
                      </script>";
                    }
              //fin metodo facial
              //inicio metodo vocal
                $encoded_data1 = $_POST['mydata1'];
                $encoded_data2 = $_POST['mydata2'];
                $encoded_data3 = $_POST['mydata3'];

                $binary_data1 = base64_decode( $encoded_data1 );
                $binary_data2 = base64_decode( $encoded_data2 );
                $binary_data3 = base64_decode( $encoded_data3 );

                $path1="saved_audios/{$email}1.wav";
                $path2="saved_audios/{$email}2.wav";
                $path3="saved_audios/{$email}3.wav";

                $result1 = file_put_contents( $path1, $binary_data1 );
                $result2 = file_put_contents( $path2, $binary_data2 );
                $result3 = file_put_contents( $path3, $binary_data3 );
                $idioma = $_POST["idioma"];

                $response1 = $myVoiceIt->createEnrollment("$email", "$password", "$path1", "$idioma");
                $response2 = $myVoiceIt->createEnrollment("$email", "$password", "$path2", "$idioma");
                $response3 = $myVoiceIt->createEnrollment("$email", "$password", "$path3", "$idioma");

                $text1 = guardarJson($response1);
                $r1 = $text1["Result"];
   
                    $r12 = $text1["DetectedVoiceprintText"];
                    $r13 = $text1["DetectedTextConfidence"];

                $text2 = guardarJson($response2);
                $r2 = $text2["Result"];

                    $r22 = $text2["DetectedVoiceprintText"];
                    $r23 = $text2["DetectedTextConfidence"]; 

                $text3 = guardarJson($response3);
                $r3 = $text3["Result"];

                    $r32 = $text3["DetectedVoiceprintText"];
                    $r33 = $text3["DetectedTextConfidence"]; 


                    if($text1["Result"] != "Success"){
                      echo'
                      <div class="row">
                        <div class="col s12 m2 l3">
                        </div>
                        <div class="col s12 m6 l6">
                          <div class="card red">
                            <div class="card-content white-text">
                              <span class="card-title">'.$r1.'</span>
                              <p>Resultado incorrecto para huella vocal 1.</p>
                              <audio controls>
                                <source src="'.$path1.'" type="audio/wav">
                              </audio>
                            </div>
                          <div class="card-action">
                            <a href="#">Administrar</a>
                          </div>
                        </div>
                      </div>
                    <div class="col s12 m2 l3">
                  </div>
                  </div>';
                    }
                    else{
                      echo'
                      <div class="row">
                        <div class="col s12 m2 l3">
                        </div>
                        <div class="col s12 m6 l6">
                          <div class="card">
                            <div class="card-content white-text">
                              <span class="card-title black-text">Creacion de huella 1 exitosa, frase detectada '.$r12.' con una confidencialidad de '.$r13.' %</span>
                              <audio controls>
                                <source src="'.$path1.'" type="audio/wav">
                              </audio>
                            </div>
                          <div class="card-action">
                            <a href="#">Administrar</a>
                          </div>
                        </div>
                      </div>
                    <div class="col s12 m2 l3">
                  </div>
                  </div>';
                    }
                    if($text2["Result"] != "Success"){
                      echo'
                      <div class="row">
                        <div class="col s12 m2 l3">
                        </div>
                        <div class="col s12 m6 l6">
                          <div class="card red">
                            <div class="card-content white-text">
                              <span class="card-title">'.$r2.'</span>
                              <p>Resultado incorrecto para huella vocal 2.</p>
                              <audio controls>
                                <source src="'.$path2.'" type="audio/wav">
                              </audio>
                            </div>
                          <div class="card-action">
                            <a href="#">Administrar</a>
                          </div>
                        </div>
                      </div>
                    <div class="col s12 m2 l3">
                  </div>
                  </div>';
                    }
                    else{
                      echo'
                      <div class="row">
                        <div class="col s12 m2 l3">
                        </div>
                        <div class="col s12 m6 l6">
                          <div class="card">
                            <div class="card-content white-text">
                            <span class="card-title black-text">Creacion de huella 2 exitosa, frase detectada '.$r22.' con una confidencialidad de '.$r23.' %</span>
                              <audio controls>
                                <source src="'.$path2.'" type="audio/wav">
                              </audio>
                            </div>
                          <div class="card-action">
                            <a href="#">Administrar</a>
                          </div>
                        </div>
                      </div>
                    <div class="col s12 m2 l3">
                  </div>
                  </div>';
                    }
                    if($text3["Result"] != "Success"){
                      echo'
                      <div class="row">
                        <div class="col s12 m2 l3">
                        </div>
                        <div class="col s12 m6 l6">
                          <div class="card red">
                            <div class="card-content white-text">
                              <span class="card-title">'.$r3.'</span>
                              <p>Resultado incorrecto para huella vocal 3.</p>
                              <audio controls>
                                <source src="'.$path3.'" type="audio/wav">
                              </audio>
                            </div>
                          <div class="card-action">
                            <a href="#">Administrar</a>
                          </div>
                        </div>
                      </div>
                    <div class="col s12 m2 l3">
                  </div>
                  </div>';
                    }else{
                      echo'
                      <div class="row">
                        <div class="col s12 m2 l3">
                        </div>
                        <div class="col s12 m6 l6">
                          <div class="card">
                            <div class="card-content white-text">
                            <span class="card-title black-text">Creacion de huella 3 exitosa, frase detectada '.$r32.' con una confidencialidad de '.$r33.' %</span>
                              <audio controls>
                                <source src="'.$path3.'" type="audio/wav">
                              </audio>
                            </div>
                          <div class="card-action">
                            <a href="#">Administrar</a>
                          </div>
                        </div>
                      </div>
                    <div class="col s12 m2 l3">
                  </div>
                  </div>';
                    }           
                //fin metodo vocal

                    if($caras==1 && $validarpose && $text1["Result"] == "Success" && $text2["Result"] == "Success" && $text3["Result"] == "Success"){
                        echo "<script language='javascript'>
                        document.getElementById('carga').style.display = 'none';
                        document.getElementById('tarjeta').style.display = 'block';
                        swal(
                          'Huellas registradas correctamente',
                          'A continiación se muestran los resultados',
                          'success')
                          </script>";

                          //guardar el base de datos

                          //huella facial
                          $sqlf = "INSERT INTO huellas_faciales (HuellaFacial) VALUES ('$path')";
                          mysqli_query($con,$sqlf);

                          $sqlfq = "SELECT * FROM huellas_faciales WHERE HuellaFacial='$path'";
                          $resultf=mysqli_query($con,$sqlfq);
                          $infof = mysqli_fetch_assoc($resultf);
                          $idf=$infof['HF_ID'];
                          //huella vocal1
                          $sqlv1 = "INSERT INTO huellas_vocales (HuellaVocal) VALUES ('$path1')";
                          mysqli_query($con,$sqlv1);

                          $sqlv1q = "SELECT * FROM huellas_vocales WHERE HuellaVocal='$path1'";
                          $resultv1=mysqli_query($con,$sqlv1q);
                          $infov1 = mysqli_fetch_assoc($resultv1);
                          $idv1=$infov1['HV_ID'];
                          //huella vocal2
                          $sqlv2 = "INSERT INTO huellas_vocales (HuellaVocal) VALUES ('$path2')";
                          mysqli_query($con,$sqlv2);

                          $sqlv2q = "SELECT * FROM huellas_vocales WHERE HuellaVocal='$path2'";
                          $resultv2=mysqli_query($con,$sqlv2q);
                          $infov2 = mysqli_fetch_assoc($resultv2);
                          $idv2=$infov2['HV_ID'];
                          //huella vocal3
                          $sqlv3 = "INSERT INTO huellas_vocales (HuellaVocal) VALUES ('$path3')";
                          mysqli_query($con,$sqlv3);

                          $sqlv3q = "SELECT * FROM huellas_vocales WHERE HuellaVocal='$path3'";
                          $resultv3=mysqli_query($con,$sqlv3q);
                          $infov3 = mysqli_fetch_assoc($resultv3);
                          $idv3=$infov3['HV_ID'];

                          //usuario_huella
                          $sql = "SELECT * FROM usuarios WHERE email='$email'";
                          $result= mysqli_query($con,$sql);
                          $info=mysqli_fetch_assoc($result);
                          $userid=$info['UserID'];

                          $sqlus = "INSERT INTO usuario_huella (UserID, HF_ID, HV1_ID, HV2_ID,  HV3_ID) VALUES ('$userid', '$idf', '$idv1', '$idv2', $idv3)";
                          mysqli_query($con,$sqlus);


                    }else{
                      echo "<script>swal({ title: 'Error!',  text: 'Ha ocurrido un error al registrar las huellas',  type: 'error',  confirmButtonText: 'OK'})</script>";
                    }
              }else{
                echo "<script type='text/javascript'>
                swal({ title: 'Error!',  text: 'Contraseña en Moodle incorrecta',  type: 'error',  confirmButtonText: 'OK', allowOutsideClick: false}).then(function () {      redireccionarPagina();})
          </script>";
              }
            }else{
              echo "<script type='text/javascript'>
              swal({ title: 'Error!',  text: 'El Correo no está registrado en Moodle',  type: 'error',  confirmButtonText: 'OK', allowOutsideClick: false}).then(function () {      redireccionarPagina();})
          </script>";
            }
    
          }else{
            echo "<script type='text/javascript'>
            swal({ title: 'Error!',  text: 'Contraseña incorrecta',  type: 'error',  confirmButtonText: 'OK', allowOutsideClick: false}).then(function () {      redireccionarPagina();})
          </script>";
          }

        }else{
          echo "<script type='text/javascript'>
          swal({ title: 'Error!',  text: 'El Correo no está registrado',  type: 'error',  confirmButtonText: 'OK', allowOutsideClick: false}).then(function () {      redireccionarPagina();})
          </script>";
        }


     }

                  function guardarJson($response) {
                  $file = 'json/datos.json';
                  file_put_contents($file, $response);

                  $data = file_get_contents("json/datos.json");
                  $text = json_decode($data, true);

                  return $text;
                  }

    ?>
