<?php
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

<!DOCTYPE html>
  <html>
  <script language='javascript'>
  var sound;
  var beep;
  var cameraSound;
function cargaAudio(){
  sound = new Audio('media/grabacion.wav');
  beep = new Audio('media/beep.wav');
  cameraSound = new Audio('media/camera.wav');
}
</script>
  <head>
  <meta http-equiv="Expires" content="Mon, 26 Jul 1997 05:00:00 GMT">
  <meta http-equiv="Pragma" content="no-cache">
  <meta HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE" />
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
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.css">
  <!-- Include a polyfill for ES6 Promises (optional) for IE11 and Android browser -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <!-- First, include the Webcam.js JavaScript Library -->
  <script type="text/javascript" src="js/webcam.js"></script>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
  <script src="js/init.js"></script>

  </head>

  <body >

  <div class="navbar-fixed"><!--Barra de navegacion-->
    <nav class="white" role="navigation">
      <div class="nav-wrapper container">
        <ul id="slide-out" class="side-nav">                                       
          <li><a href="registro-huella.php">Registrar huella</a></li>
          <li class="active"><a href="busqueda.php">Buscar</a></li>
          <li><a href="cerrarSesion.php">Cerrar sesión</a></li>
        </ul>
        <a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>
        <a id="logo-container" href="indexAdmin.php" class="brand-logo center"><i class="medium material-icons">fingerprint</i></a>
        <ul class="right hide-on-med-and-down">                              
          <li><a href="registro-huella.php">Registrar huella</a></li>
          <li class="active"><a href="busqueda.php">Buscar</a></li>
          <li><a href="cerrarSesion.php">Cerrar sesión</a></li>
        </ul>
        <ul id="nav-mobile" class="side-nav">                              
          <li><a href="registro-huella.php">Registrar huella</a></li>
          <li class="active"><a href="busqueda.php">Buscar</a></li>
          <li><a href="cerrarSesion.php">Cerrar sesión</a></li>
        </ul>
      </div>
    </nav>
  </div>


  

  <script type="text/javascript">
    function redireccionarPagina() {
      window.location = "busqueda.php";
    }

    function Eliminar(e){

      if(e=="eliminarUsuario"){
        swal({
          title: 'Estas seguro que deseas eliminar este usuario?',
          text: "No podras revertir esto!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sí, eliminar usuario!',
          cancelButtonText: 'Cancelar'
        }).then(function () {
          document.getElementById(e).submit();        
        })
      }
      else{
        if(e=="HuellaFacial"){
          swal({
            title: 'Estas seguro que deseas eliminar la huella facial?',
            text: "No podras revertir esto!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar huella facial!',
            cancelButtonText: 'Cancelar'
          }).then(function () {
            document.getElementById(e).submit();        
          })
        }
        else{
          swal({
            title: 'Estas seguro que deseas eliminar la huella vocal ?',
            text: "No podras revertir esto!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar huella vocal!',
            cancelButtonText: 'Cancelar'
          }).then(function () {
            document.getElementById(e).submit();        
          })
        }
      }
      
    }

        
    
  </script>

  <script>
  window.onload=cargaAudio();
</script>

  <script>//Funcion que ejecuta la accion de grabar 3 veces

    function Grabar3(button){
          b=button;

                    swal({
                    html: " <h5><b>Grabando</b></h5> <br> <button  class='btn btn-floating pulse waves-light red' type='button'><i class='material-icons left'>fiber_manual_record</i></button> <br><br> <b>Di: Mi voz es mi contraseña</b>  <br> La grabacion finalizara en 5 segundos!!",            
                    text: 'Se cerrará automáticamente en 5 segundos',
                    showConfirmButton: false,
                    timer: 5800,
                    allowOutsideClick: false,
                    onOpen: function () {
                      beep.play();
                      setTimeout(function(){
                        
                        Grabar(b);},800);
                                     
                      
                      }           
                  }).then(
                      function () {

                      },
                    // handling the promise rejection
                    function (dismiss) {

                      if (dismiss === 'timer') {
                        console.log('I was closed by the timer')
                    }
                  }
                  )


              
          }
  </script>

<script>//Funcion que ejecuta la accion de grabar en el javascript 

        function Grabarf(button){          
          
          b=button;
         
                          swal({
                           html: "<i class='material-icons medium blue-text'>mood</i> <h5><b>Graba tu huella facial</b></h5> <div style='display: -webkit-box; display: -ms-flexbox; display: -webkit-flex;  display: flex; justify-content: center; align-items: center;'><img id='silueta' class='center' src='media/silueta.png' style='z-index:3;position:absolute;'> <div id='my_camera' class='responsive-video col s12 m6 l6' ></div></div><br> Pulsa para capturar la imagen<br> Despues verifica si: <br><b>La imagen está centrada y nitida</b>",
                                                    type: '',
                              showCancelButton: false,
                              confirmButtonColor: '#3085d6',
                              cancelButtonColor: '#d33',
                              confirmButtonText: '<i class="material-icons left ">photo_camera</i>',
                              cancelButtonText: 'No, cancel!',
                              confirmButtonClass: 'btn btn-floating waves-light black',                    
                              buttonsStyling: false,
                              allowOutsideClick: false,
                              onOpen: function () {
                                Webcam.set({
                                      width: 300,
                                      height: 230,
                                      dest_width: 600,
                                      dest_height: 460,
                                      image_format: 'jpeg',
                                      jpeg_quality: 100,
                                      flip_horiz: true
                                    });
                                    Webcam.attach( '#my_camera' );
                              }
                            }).then(function () {
                              
                              cameraSound.play();
                              swal({
                           html: "<div id='results' style='display:none'></div><h5><b>Aqui esta tu huella facial</b></h5><br> Puedes internarlo nuevamente, o confirmar esta huella facial",
                                                    type: '',
                              showCancelButton: true,
                              confirmButtonColor: '#3085d6',
                              cancelButtonColor: '#3085d6',
                              confirmButtonText: '<i class="material-icons left ">check</i>',
                              cancelButtonText: '<i class="material-icons left ">undo</i>',
                              confirmButtonClass: 'btn btn-floating waves-light black',
                              cancelButtonClass: 'btn btn-floating waves-light black',                  
                              buttonsStyling: false,
                              allowOutsideClick: false,
                              onOpen: function () {
                                  Webcam.reset();
                                   
                              }
                            }).then(function () {
                                   document.getElementById('NuevaHuellaFacial').submit();
                                     //   swal(
                                       //   'Correcto!',
                                         // 'Tu imagen se ha guardado.',
                                         // 'success'
                                        //)
                                      }, function (dismiss) {
                                        if (dismiss === 'cancel') {
                                          Grabarf(this);
                                        }
                                      })
                              Webcam.snap( function(data_uri) {
        // display results in page
         var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
        document.getElementById('mydataf').value = raw_image_data;
        document.getElementById('results').innerHTML = 
          '<img id="myimg" src="'+data_uri+'" height="230" width="300"/><br/></br>';
        document.getElementById('results').style.display = '';
      } );

                                              
                          })
        
        }     
  </script>

   <script>//Funcion que ejecuta la accion de grabar 3 veces

        function Grabar2(button){          
          
          b=button;
            
                          swal({          
                            html: "<i class='material-icons medium blue-text'>filter_1</i> <h5><b>Graba tu huella vocal</b></h5> Primera grabacion <br><br> Pulsa para grabar<br> Despues di: <b>Mi voz es mi contraseña</b>",
                            type: '',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: '<i class="material-icons left ">mic</i>',
                            cancelButtonText: 'No, cancel!',
                            confirmButtonClass: 'btn btn-floating waves-light black',                    
                            buttonsStyling: false,
                            allowOutsideClick: false
                          }).then(function () {                                            
                                              sound.play();
                                              
                                              setTimeout(function(){
                                                
                                                Grabar3(b); 

                                              },6000)

                                               setTimeout(function(){
                                                    var data_uri1 = returnBinary1();
                                                    var raw_image_data1 = data_uri1.result.replace(/^data\:audio\/\w+\;base64\,/, '');
                                                    if(b==1){
                                                      document.getElementById('mydata1').value = raw_image_data1;
                                                      document.getElementById('actualizarHV1').submit();
                                                    }
                                                    if(b==2){
                                                      document.getElementById('mydata2').value = raw_image_data1;
                                                      document.getElementById('actualizarHV2').submit();
                                                  }
                                                    if(b==3){
                                                      document.getElementById('mydata3').value = raw_image_data1;
                                                      document.getElementById('actualizarHV3').submit();
                                                    }

                                              },12500);


            
                          })


        
        }
  </script>

  </body>

    
      <?php
        require_once("VoiceIt.php");
        $myVoiceIt = new VoiceIt();
        require './app/start.php';
        use Aws\S3\Exception\S3Exception;
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
          
        //Conexion con base de datos local  
        $con = mysqli_connect("localhost", "root", "", "biofacvoz")or die("Problemas al conectar");

        if ($con->connect_error) {
          die("Conexión biofacvoz fallida: " . $con->connect_error);
        } 
        $acentos = $con->query("SET NAMES 'utf8'");

        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
            $accion=  $_POST["accion"]; 

            if($accion=="buscar"){

              $email=  $_POST["email"];        
              $sql = "SELECT * FROM usuarios WHERE email='$email'";//Query en la DB biofacvoz para revisar si hay un email igual
              $result= mysqli_query($con,$sql);
              $checkuser=mysqli_num_rows($result);

              if($checkuser>0){//correo registraro?          
                
                  $info = mysqli_fetch_assoc($result);
                  $UserID=$info['UserID'];
                  $Password=$info['Password'];

                  $sqlUH = "SELECT * FROM usuario_huella WHERE UserID='$UserID'";//Query en la DB biofacvoz en la tabla usuario_huella para verificar que hay huellas guardadas que hagan referencia al correo de la busqueda

                  $resultUH= mysqli_query($con,$sqlUH);
                  $num=mysqli_num_rows($resultUH);

                  if($num>0){
                      $infoUH = mysqli_fetch_assoc($resultUH);
                      $HF_ID=$infoUH['HF_ID'];
                      
                      $HV1_ID=$infoUH['HV1_ID'];
                      $HV2_ID=$infoUH['HV2_ID'];
                      $HV3_ID=$infoUH['HV3_ID'];

                      $sqlHF = "SELECT * FROM huellas_faciales WHERE HF_ID='$HF_ID'";
                      $resultHF= mysqli_query($con,$sqlHF);
                      $infoHF = mysqli_fetch_assoc($resultHF);
                      $pathHF = $infoHF['HuellaFacial'];

                      $sqlHV1 = "SELECT * FROM huellas_vocales WHERE HV_ID='$HV1_ID'";
                      $resultHV1= mysqli_query($con,$sqlHV1);
                      $infoHV1 = mysqli_fetch_assoc($resultHV1);
                      $pathHV1 = $infoHV1['HuellaVocal'];
                      $EnrollmentID1=$infoHV1["EnrollmentID"];
                      

                      $sqlHV2 = "SELECT * FROM huellas_vocales WHERE HV_ID='$HV2_ID'";
                      $resultHV2= mysqli_query($con,$sqlHV2);
                      $infoHV2 = mysqli_fetch_assoc($resultHV2);
                      $pathHV2 = $infoHV2['HuellaVocal'];
                      $EnrollmentID2=$infoHV2["EnrollmentID"];

                      $sqlHV3 = "SELECT * FROM huellas_vocales WHERE HV_ID='$HV3_ID'";
                      $resultHV3= mysqli_query($con,$sqlHV3);
                      $infoHV3 = mysqli_fetch_assoc($resultHV3);
                      $pathHV3 = $infoHV3['HuellaVocal'];
                      $EnrollmentID3=$infoHV3["EnrollmentID"];

                      $path=$pathHF; 
                      $path1=$pathHV1;
                      $path2=$pathHV2;
                      $path3=$pathHV3;      


                      $enlace=$path;
                      $imageData = base64_encode(file_get_contents($enlace));
                      echo "<br><br><br>";
                      ?>
                        <div class="row">
                              <div class="col s12 m2 l4 offset-l4">
                                <div class="card">
                                  <div class="card-image">
                                    <img class="responsive-img materialboxed" data-caption="Huella Facial" src="<?php echo $path; ?>"> 
                                  </div>
                                  <div class="card-action">
                                   <span class="card-title black-text"><?php echo $email; ?></span>                               
                                 
                                 <form id="HuellaFacial" method="post" action="procBusqueda.php" >
                                   <input id="email" type="hidden" name="email" value="<?php echo $email; ?>">
                                   <input type="hidden" name="path" value="<?php echo $path; ?>">
                                   <input type="hidden" name="UserID" value="<?php echo $UserID; ?>">
                                   <input type="hidden" name="HF_ID" value="<?php echo $HF_ID; ?>">
                                   <input type="hidden" name="accion" value="eliminarHF">     
                                 </form>
                                <form id="NuevaHuellaFacial" method="post" action="procBusqueda.php" >
                                  <input id="email" type="hidden" name="email" value="<?php echo $email; ?>">
                                   <input type="hidden" name="path" value="<?php echo $path; ?>">
                                   <input type="hidden" name="UserID" value="<?php echo $UserID; ?>">
                                   <input type="hidden" name="HF_ID" value="<?php echo $HF_ID; ?>">
                                   <input type="hidden" name="accion" value="actualizarHF">     
                                   <input id="mydataf" type="hidden" name="mydataf" value=""/>
                                </form>     

                                   <br>
                                   <?php
                                   if($path!="media/eliminar.png"){
                                        echo '<a href="'.$path.'" download>Descargar</a>';
                                        echo '<a href="#!" onclick="Grabarf(this);" class="secondary-content tooltipped"  data-position="top" data-delay="50" data-tooltip="Actualizar huella facial"><i class="small material-icons red-text">refresh</i></a>';

                                        echo '<a href="#!" onclick="Eliminar(\'HuellaFacial\')" class="secondary-content tooltipped"  data-position="top" data-delay="50" data-tooltip="Eliminar huella facial"><i class="small material-icons red-text">delete_forever</i></a>';
                                   }
                                   else{
                                        echo 'No existe huella facial para este usuario
                                        <a href="#!" onclick="Grabarf(this);" class="secondary-content tooltipped"  data-position="top" data-delay="50" data-tooltip="Añadir huella facial"><i class="small material-icons red-text">add_a_photo</i></a>';
                                   }
                                    
                                    ?>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <br>
                        <?php

                      echo"<div class='row'>
                        <div class='col s12 m2 l3'>
                        </div>
                        <div class='col s12 m6 l6'>
                          <div class='card'>
                            <div class='card-content white-text'>
                              <span class='card-title black-text'>Huella 1</span>
                              <audio controls>
                                <source src='$path1' type='audio/wav'>
                              </audio>";
                              if($HV1_ID!="0"){
                                echo'

                               
                                        <a href="#!" type="button" value="crearHuella1" onclick="Grabar2(1);" class="secondary-content tooltipped"  data-position="top" data-delay="50" data-tooltip="Actualizar huella vocal 1"><i class="small material-icons red-text">refresh</i></a>
                                        <a href="#!" onclick="Eliminar(\'eliminarHV1\')" class="secondary-content tooltipped"  data-position="top" data-delay="50" data-tooltip="Eliminar huella vocal 1"><i class="small material-icons red-text">delete_forever</i></a>
                                        <br>
                                        <br>
                                        <form id="eliminarHV1" method="post" action="procBusqueda.php" >
                                            <input type="hidden" name="email" value="'.$email.'"/>
                                            <input type="hidden" name="path" value="'.$path1.'">
                                            <input type="hidden" name="HV_ID" value="'.$HV1_ID.'">
                                            <input type="hidden" name="UserID" value="'.$UserID.'">
                                            <input type="hidden" name="EnrollmentID" value="'.$EnrollmentID1.'">
                                            <input type="hidden" name="Password" value="'.$Password.'">
                                            <input type="hidden" name="NHV" value="1">
                                            <input type="hidden" name="accion" value="eliminarHV">                              
                                          </form>

                                          <form id="actualizarHV1" method="post" action="procBusqueda.php" >
                                            <input type="hidden" name="email" value="'.$email.'"/>
                                            <input type="hidden" name="path" value="'.$path1.'">
                                            <input type="hidden" name="HV_ID" value="'.$HV1_ID.'">
                                            <input type="hidden" name="UserID" value="'.$UserID.'">
                                            <input type="hidden" name="EnrollmentID" value="'.$EnrollmentID1.'">
                                            <input type="hidden" name="Password" value="'.$Password.'">
                                            <input type="hidden" name="NHV" value="1">
                                            <input id="mydata1" type="hidden" name="mydata" value=""/>
                                            <input type="hidden" name="accion" value="actualizarHV">                              
                                          </form>
                                        </div>                       
                                      </div>
                                    </div>
                                    <div class="col s12 m2 l3">
                                  </div>
                                </div>';
                              }
                              else{



                                echo '
                                <form id="actualizarHV1" method="post" action="procBusqueda.php" >
                                  <input type="hidden" name="email" value="'.$email.'"/>
                                  <input type="hidden" name="path" value="'.$path1.'">
                                  <input type="hidden" name="HV_ID" value="'.$HV1_ID.'">
                                  <input type="hidden" name="UserID" value="'.$UserID.'">
                                  <input type="hidden" name="EnrollmentID" value="'.$EnrollmentID1.'">
                                  <input type="hidden" name="Password" value="'.$Password.'">
                                  <input type="hidden" name="NHV" value="1">
                                  <input id="mydata1" type="hidden" name="mydata" value=""/>
                                  <input type="hidden" name="accion" value="actualizarHV">                              
                                </form>


                                <a href="#!" type="button" value="crearHuella1" onclick="Grabar2(1);" class="secondary-content tooltipped"  data-position="top" data-delay="50" data-tooltip="Actualizar huella vocal 1"><i class="small material-icons red-text">refresh</i></a>

                                <P class="black-text">No existe huella vocal 1 para este usuario</P>';
                                echo'
                                        </div>                       
                                      </div>
                                    </div>
                                    <div class="col s12 m2 l3">
                                  </div>
                                </div>';

                              }

                    echo"<div class='row'>
                                        <div class='col s12 m2 l3'>
                                        </div>
                                        <div class='col s12 m6 l6'>
                                          <div class='card'>
                                            <div class='card-content white-text'>
                                              <span class='card-title black-text'>Huella 2</span>
                                              <audio controls>
                                                <source src='$path2' type='audio/wav'>
                                              </audio>";
                                      if($HV2_ID!="0"){
                                      echo'
                                              <a href="#!" type="button" value="crearHuella2" onclick="Grabar2(2);" class="secondary-content tooltipped"  data-position="top" data-delay="50" data-tooltip="Actualizar huella vocal 2"><i class="small material-icons red-text">refresh</i></a>
                                              <a href="#!" onclick="Eliminar(\'eliminarHV2\')" class="secondary-content tooltipped"  data-position="top" data-delay="50" data-tooltip="Eliminar huella vocal 2"><i class="small material-icons red-text">delete_forever</i></a>
                                              <br>
                                              <br>
                                              <form id="eliminarHV2" method="post" action="procBusqueda.php" >
                                                  <input type="hidden" name="email" value="'.$email.'"/>
                                                  <input type="hidden" name="path" value="'.$path2.'">
                                                  <input type="hidden" name="HV_ID" value="'.$HV2_ID.'">
                                                  <input type="hidden" name="UserID" value="'.$UserID.'">
                                                  <input type="hidden" name="EnrollmentID" value="'.$EnrollmentID2.'">
                                                  <input type="hidden" name="Password" value="'.$Password.'">
                                                  <input type="hidden" name="NHV" value="2">
                                                  <input type="hidden" name="accion" value="eliminarHV">                              
                                                </form>

                                                <form id="actualizarHV2" method="post" action="procBusqueda.php" >
                                                  <input type="hidden" name="email" value="'.$email.'"/>
                                                  <input type="hidden" name="path" value="'.$path2.'">
                                                  <input type="hidden" name="HV_ID" value="'.$HV2_ID.'">
                                                  <input type="hidden" name="UserID" value="'.$UserID.'">
                                                  <input type="hidden" name="EnrollmentID" value="'.$EnrollmentID2.'">
                                                  <input type="hidden" name="Password" value="'.$Password.'">
                                                  <input type="hidden" name="NHV" value="2">
                                                  <input id="mydata2" type="hidden" name="mydata" value=""/>
                                                  <input type="hidden" name="accion" value="actualizarHV">                              
                                                </form>
                                              </div>                       
                                            </div>
                                          </div>
                                          <div class="col s12 m2 l3">
                                        </div>
                                      </div>';
                                    }
                                    else{
                                      echo '

                                      <form id="actualizarHV2" method="post" action="procBusqueda.php" >
                                            <input type="hidden" name="email" value="'.$email.'"/>
                                            <input type="hidden" name="path" value="'.$path2.'">
                                            <input type="hidden" name="HV_ID" value="'.$HV2_ID.'">
                                            <input type="hidden" name="UserID" value="'.$UserID.'">
                                            <input type="hidden" name="EnrollmentID" value="'.$EnrollmentID2.'">
                                            <input type="hidden" name="Password" value="'.$Password.'">
                                            <input type="hidden" name="NHV" value="2">
                                            <input id="mydata2" type="hidden" name="mydata" value=""/>
                                            <input type="hidden" name="accion" value="actualizarHV">                              
                                        </form>

                                     <a href="#!" type="button" value="crearHuella2" onclick="Grabar2(2);" class="secondary-content tooltipped"  data-position="top" data-delay="50" data-tooltip="Actualizar huella vocal 2"><i class="small material-icons red-text">refresh</i></a>
  
          

                                      <P class="black-text">No existe huella vocal 2 para este usuario</P>';
                                      echo'
                                              </div>                       
                                            </div>
                                          </div>
                                          <div class="col s12 m2 l3">
                                        </div>
                                      </div>';

                                    }
                      echo"<div class='row'>
                                          <div class='col s12 m2 l3'>
                                          </div>
                                          <div class='col s12 m6 l6'>
                                            <div class='card'>
                                              <div class='card-content white-text'>
                                                <span class='card-title black-text'>Huella 3</span>
                                                <audio controls>
                                                  <source src='$path3' type='audio/wav'>
                                                </audio>";
                                        if($HV3_ID!="0"){
                                        echo'
                                                 <a href="#!" type="button" value="crearHuella3" onclick="Grabar2(3);" class="secondary-content tooltipped"  data-position="top" data-delay="50" data-tooltip="Actualizar huella vocal 3"><i class="small material-icons red-text">refresh</i></a>
                                                <a href="#!" onclick="Eliminar(\'eliminarHV3\')" class="secondary-content tooltipped"  data-position="top" data-delay="50" data-tooltip="eliminar huella vocal 3"><i class="small material-icons red-text">delete_forever</i></a>
                                                <br>
                                                <br>
                                                <form id="eliminarHV3" method="post" action="procBusqueda.php" >
                                                    <input type="hidden" name="email" value="'.$email.'"/>
                                                    <input type="hidden" name="path" value="'.$path3.'">
                                                    <input type="hidden" name="HV_ID" value="'.$HV3_ID.'">
                                                    <input type="hidden" name="UserID" value="'.$UserID.'">
                                                    <input type="hidden" name="EnrollmentID" value="'.$EnrollmentID3.'">
                                                    <input type="hidden" name="Password" value="'.$Password.'">
                                                    <input type="hidden" name="NHV" value="3">
                                                    <input type="hidden" name="accion" value="eliminarHV">                              
                                                  </form>

                                                   <form id="actualizarHV3" method="post" action="procBusqueda.php" >
                                                    <input type="hidden" name="email" value="'.$email.'"/>
                                                    <input type="hidden" name="path" value="'.$path3.'">
                                                    <input type="hidden" name="HV_ID" value="'.$HV3_ID.'">
                                                    <input type="hidden" name="UserID" value="'.$UserID.'">
                                                    <input type="hidden" name="EnrollmentID" value="'.$EnrollmentID3.'">
                                                    <input type="hidden" name="Password" value="'.$Password.'">
                                                    <input type="hidden" name="NHV" value="3">
                                                    <input id="mydata3" type="hidden" name="mydata" value=""/>
                                                    <input type="hidden" name="accion" value="actualizarHV">                              
                                                  </form>
                                                </div>                       
                                              </div>
                                            </div>
                                            <div class="col s12 m2 l3">
                                          </div>
                                        </div>';
                                      }
                                      else{
                                        echo '

                                                  <form id="actualizarHV3" method="post" action="procBusqueda.php" >
                                                    <input type="hidden" name="email" value="'.$email.'"/>
                                                    <input type="hidden" name="path" value="'.$path3.'">
                                                    <input type="hidden" name="HV_ID" value="'.$HV3_ID.'">
                                                    <input type="hidden" name="UserID" value="'.$UserID.'">
                                                    <input type="hidden" name="EnrollmentID" value="'.$EnrollmentID3.'">
                                                    <input type="hidden" name="Password" value="'.$Password.'">
                                                    <input type="hidden" name="NHV" value="3">
                                                    <input id="mydata3" type="hidden" name="mydata" value=""/>
                                                    <input type="hidden" name="accion" value="actualizarHV">                              
                                                  </form>


                                                  <a href="#!" type="button" value="crearHuella3" onclick="Grabar2(3);" class="secondary-content tooltipped"  data-position="top" data-delay="50" data-tooltip="Actualizar huella vocal 3"><i class="small material-icons red-text">refresh</i></a>


                                        <P class="black-text">No existe huella vocal 3 para este usuario</P>';
                                        echo'
                                                </div>                       
                                              </div>
                                            </div>
                                            <div class="col s12 m2 l3">
                                          </div>
                                        </div>';

                                      }

                     
                     ?>
                      <br>
                      <div class="row">
                        <div class="col s12 m2 l3">
                        </div>
                        <div class="col s12 m6 l6 center-align">
                            <form id="eliminarUsuario" method="post" action="procBusqueda.php" >
                              <input id="email" type="hidden" name="email" value="<?php echo $email; ?>"/>
                              <input type="hidden" name="accion" value="eliminarUsuario">
                              <input type="button" value="Eliminar usuario" class=" waves-light btn red col s12 m12 l12"  onclick="Eliminar('eliminarUsuario');">
                            </form>
                        </div>
                          <div class="col s12 m2 l3">
                        </div>
                      </div>
                      <br><br>
                      
                    <?php
                      
                  }
                  else{

                    $path="media/eliminar.png";

                    echo "<br><br><br>";
                    ?>
                    <div class="row">
                            <div class="col s12 m2 l4 offset-l4">
                              <div class="card">
                                <div class="card-image">
                                  <img class="responsive-img materialboxed" data-caption="Huella Facial" src="<?php echo $path; ?>"> 
                                </div>
                                <div class="card-action">
                                 <span class="card-title black-text"><?php echo $email; ?></span>
                                                              
                                 <form id="HuellaFacial" method="post" action="procBusqueda.php" >
                                   <input id="email" type="hidden" name="email" value="<?php echo $email; ?>"/>
                                   <input type="hidden" name="HV_ID" value="<?php echo $HF_ID; ?>">
                                   <input type="hidden" name="accion" value="eliminarHF">                              
                                 </form>
                                 
                                 <br>
                                  <p>El usuario aun no tiene huellas registradas.</p>
                                  
                                </div>
                              </div>
                            </div>
                    </div>
                          <br>
                    
                    
                      <br><br>

                      <br>
                      <div class="row">
                        <div class="col s12 m2 l3">
                        </div>
                        <div class="col s12 m6 l6 center-align">
                            <form id="eliminarUsuario" method="post" action="procBusqueda.php" >
                              <input id="email" type="hidden" name="email" value="<?php echo $email; ?>"/>
                              <input type="hidden" name="accion" value="eliminarUsuario">
                              <input type="button" value="Eliminar usuario" class=" waves-light btn red col s12 m12 l12"  onclick="Eliminar('eliminarUsuario');">
                            </form>
                        </div>
                        <div class="col s12 m2 l3">
                        </div>
                      </div>
                      <br><br>
                      
                    <?php
                  }


                  
                                    
              }
              else{
                echo "<div class=''style='height:58%; position: initial;'></div>";

                echo "<script type='text/javascript'>
                swal({ title: 'Error!',  text: 'El Correo no está registrado',  type: 'error',  confirmButtonText: 'OK', allowOutsideClick: false}).then(function () {      redireccionarPagina();})
                </script>";
              }
            }

            if($accion=="eliminarUsuario"){

              
              $email=  $_POST["email"];        

              $sql = "SELECT * FROM usuarios WHERE email='$email'";//Query en la DB biofacvoz para revisar si hay un email igual
              $result= mysqli_query($con,$sql);
              $info = mysqli_fetch_assoc($result);

              $password=$info['Password'];
              $UserID=$info['UserID'];

              $sqlUH = "SELECT * FROM usuario_huella WHERE UserID='$UserID'";//Query en la DB biofacvoz en la tabla usuario_huella para verificar que hay huellas guardadas que hagan referencia al correo de la busqueda

              $resultUH= mysqli_query($con,$sqlUH);
              $num=mysqli_num_rows($resultUH);


              if($num>0){
                  $infoUH = mysqli_fetch_assoc($resultUH);
                  $HF_ID=$infoUH['HF_ID'];
                  
                  $HV1_ID=$infoUH['HV1_ID'];
                  $HV2_ID=$infoUH['HV2_ID'];
                  $HV3_ID=$infoUH['HV3_ID'];

                  $sqlUH = "DELETE FROM usuario_huella WHERE UserID='$UserID'";
                  $resultUH= mysqli_query($con,$sqlUH);

                      $sqlHF = "SELECT * FROM huellas_faciales WHERE HF_ID='$HF_ID'";
                      $resultHF= mysqli_query($con,$sqlHF);
                      $infoHF = mysqli_fetch_assoc($resultHF);
                      $pathHF = $infoHF['HuellaFacial'];

                  $sqlHF = "DELETE FROM huellas_faciales WHERE HF_ID='$HF_ID'";
                  $resultHF= mysqli_query($con,$sqlHF);
                  
                      $sqlHV = "SELECT * FROM huellas_vocales WHERE HV_ID='$HV1_ID'";
                      $resultHV= mysqli_query($con,$sqlHV);
                      $infoHV = mysqli_fetch_assoc($resultHV);
                      $pathHV1 = $infoHV['HuellaVocal'];

                  $sqlHV1 = "DELETE FROM huellas_vocales WHERE HV_ID='$HV1_ID'";
                  $resultHV1= mysqli_query($con,$sqlHV1);     

                      $sqlHV = "SELECT * FROM huellas_vocales WHERE HV_ID='$HV2_ID'";
                      $resultHV= mysqli_query($con,$sqlHV);
                      $infoHV = mysqli_fetch_assoc($resultHV);
                      $pathHV2 = $infoHV['HuellaVocal'];                               

                  $sqlHV2 = "DELETE FROM huellas_vocales WHERE HV_ID='$HV2_ID'";
                  $resultHV2= mysqli_query($con,$sqlHV2);
                  
                      $sqlHV = "SELECT * FROM huellas_vocales WHERE HV_ID='$HV3_ID'";
                      $resultHV= mysqli_query($con,$sqlHV);
                      $infoHV = mysqli_fetch_assoc($resultHV);
                      $pathHV3 = $infoHV['HuellaVocal'];

                  $sqlHV3 = "DELETE FROM huellas_vocales WHERE HV_ID='$HV3_ID'";
                  $resultHV3= mysqli_query($con,$sqlHV3);  

                  $sql = "DELETE FROM usuarios WHERE UserID='$UserID'";
                  $result= mysqli_query($con,$sql);   

                  
                  $response = $myVoiceIt->deleteUser($email,$password);
                  $s3->deleteMatchingObjects($config['s3']['bucket'],"uploads/{$pathHF}");//elimina foto en amazon 

                  unlink($pathHF);
                  unlink($pathHV1);
                  unlink($pathHV2);
                  unlink($pathHV3);            
              }
              else{
                $sql = "DELETE FROM usuarios WHERE UserID='$UserID'";
                $result= mysqli_query($con,$sql);            
              }

              echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
                        

              echo "<script>swal({
                      title: 'Usuario eliminado con exito',
                      text: 'Seras redirigido automaticamente en 5 segundos',
                      timer: 5000,
                      onOpen: function () {
                        swal.showLoading()
                      }
                    }).then(
                        function () {},
                        // handling the promise rejection
                        function (dismiss) {
                          if (dismiss === 'timer') {
                            window.location = 'indexAdmin.php'                        
                          }
                        }
                      )</script>";

            }
            if($accion=="actualizarHF"){
              $UserID=$_POST['UserID'];
              $email=$_POST['email'];
              $encoded_data = $_POST['mydataf'];
              $binary_data = base64_decode( $encoded_data );

              if($_POST['path']!="media/eliminar.png"){
                  $result = file_put_contents( $_POST['path'], $binary_data );
                  if (!$result) die("Could not save image!  Check file permissions.");
                  $gestor=fopen($_POST['path'], 'rb');

                    try {
                        $s3->putObject([
                          'Bucket' => $config['s3']['bucket'],
                          'Key' => "uploads/{$_POST['path']}",
                          'Body' =>  $gestor,
                          'ACL' => 'public-read'
                        ]);
                      }catch (S3Exception $e) {
                          echo $e->getMessage() . "\n";
                        }

                  fclose($gestor);
              }
              else{
                $path="saved_images/{$email}.jpg";
                $result = file_put_contents( $path, $binary_data );
                if (!$result) die("Could not save image!  Check file permissions.");
                $gestor=fopen($path, 'rb');

                 try {
                        $s3->putObject([
                          'Bucket' => $config['s3']['bucket'],
                          'Key' => "uploads/{$path}",
                          'Body' =>  $gestor,
                          'ACL' => 'public-read'
                        ]);
                      }catch (S3Exception $e) {
                          echo $e->getMessage() . "\n";
                        }

                  fclose($gestor);

                          $sqlf = "INSERT INTO huellas_faciales (HuellaFacial) VALUES ('$path')";
                          mysqli_query($con,$sqlf);

                          $sqlfq = "SELECT * FROM huellas_faciales WHERE HuellaFacial='$path'";
                          $resultf=mysqli_query($con,$sqlfq);
                          $infof = mysqli_fetch_assoc($resultf);
                          $idf=$infof['HF_ID'];

                          $sqlus = "UPDATE usuario_huella SET HF_ID='$idf' WHERE UserID='$UserID'";
                          mysqli_query($con,$sqlus);

              }

                    echo '<form id="enviarEmail" method="post" action="procBusqueda.php" >
                    <input id="email" type="hidden" name="email" value="'.$email.'">
                    <input type="hidden" name="accion" value="buscar">
                    </form>';


              echo "<script>document.getElementById('enviarEmail').submit();</script>";
            }
            if($accion=="eliminarHF"){

              
              $email=  $_POST["email"];  
              $HF_ID=$_POST['HF_ID'];
              $path=$_POST['path'];
              $UserID=$_POST['UserID'];


              $sql = "UPDATE usuario_huella SET HF_ID=0  WHERE UserID=$UserID";//ACTUALIZAR TABLA
              $result= mysqli_query($con,$sql);



              $sqlUH = "DELETE FROM huellas_faciales WHERE HF_ID='$HF_ID'";
              $resultUH= mysqli_query($con,$sqlUH);
             

                  
              $s3->deleteMatchingObjects($config['s3']['bucket'],"uploads/{$path}");//elimina foto en amazon  

              unlink($path);


              echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";

              echo '<form id="enviarEmail" method="post" action="procBusqueda.php" >
                     <input id="email" type="hidden" name="email" value="'.$email.'">
                     <input type="hidden" name="accion" value="buscar">
                     </form>';


              echo "<script>document.getElementById('enviarEmail').submit();</script>";

            }
            if($accion=="eliminarHV"){

                  
                  $email=  $_POST["email"];  
                  $HV_ID=$_POST['HV_ID'];
                  $path=$_POST['path'];
                  $UserID=$_POST['UserID'];
                  $EnrollmentID=$_POST['EnrollmentID'];
                  $Password=$_POST['Password'];
                  $NHV=$_POST['NHV'];

                  if($NHV=="1"){
                    $sql = "UPDATE usuario_huella SET HV1_ID=0  WHERE UserID=$UserID";//ACTUALIZAR TABLA
                    $result= mysqli_query($con,$sql);
                  }
                  else{
                    if($NHV=="2"){
                      $sql = "UPDATE usuario_huella SET HV2_ID=0  WHERE UserID=$UserID";//ACTUALIZAR TABLA
                      $result= mysqli_query($con,$sql);
                    }
                    else{
                      $sql = "UPDATE usuario_huella SET HV3_ID=0  WHERE UserID=$UserID";//ACTUALIZAR TABLA
                      $result= mysqli_query($con,$sql);
                    }
                  }

                  


                  $sqlUH = "DELETE FROM huellas_vocales WHERE HV_ID='$HV_ID'";
                  $resultUH= mysqli_query($con,$sqlUH);

                  unlink($path);

                  $response = $myVoiceIt->deleteEnrollment($email, $Password, $EnrollmentID);

                  echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";

                  echo '<form id="enviarEmail" method="post" action="procBusqueda.php" >
                         <input id="email" type="hidden" name="email" value="'.$email.'">
                         <input type="hidden" name="accion" value="buscar">
                         </form>';


                  echo "<script>document.getElementById('enviarEmail').submit();</script>";
             
            }
            if($accion=="actualizarHV"){
                  $email=  $_POST["email"];  
                  $HV_ID=$_POST['HV_ID'];
                  $path=$_POST['path'];
                  $UserID=$_POST['UserID'];
                  $EnrollmentID=$_POST['EnrollmentID'];
                  $Password=$_POST['Password'];
                  $NHV=$_POST['NHV'];
                  
                  $encoded_data1 = $_POST['mydata'];
                  $binary_data1 = base64_decode( $encoded_data1 );
                  $path1="saved_audios/{$email}{$NHV}.wav";
                  $result1 = file_put_contents( $path1, $binary_data1 );
                  
                  $response1 = $myVoiceIt->createEnrollment("$email", "$Password", "$path1", "es-CO");
                  
                  $text1 = guardarJson($response1);
                  $r1 = $text1["Result"];
                  $EnrollmentID1=$text1["EnrollmentID"];

                  $r12 = $text1["DetectedVoiceprintText"];
                  $r13 = $text1["DetectedTextConfidence"];

                  echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";

                  echo '<form id="enviarEmail" method="post" action="procBusqueda.php" >
                         <input id="email" type="hidden" name="email" value="'.$email.'">
                         <input type="hidden" name="accion" value="buscar">
                         </form>';

                  if($r1 == "Success"){

                  if($HV_ID!="0"){
                    $sqlus = "UPDATE huellas_vocales SET HuellaVocal='' WHERE HV_ID='$HV_ID'";
                    mysqli_query($con,$sqlus);
                  }


                  //huella vocal1
                  $sqlv1 = "INSERT INTO huellas_vocales (HuellaVocal,EnrollmentID) VALUES ('$path1','$EnrollmentID1')";
                  mysqli_query($con,$sqlv1);

                  $sqlv1q = "SELECT * FROM huellas_vocales WHERE HuellaVocal='$path1'";
                  $resultv1=mysqli_query($con,$sqlv1q);
                  $infov1 = mysqli_fetch_assoc($resultv1);
                  $idv1=$infov1['HV_ID'];



                  $sqlus = "UPDATE usuario_huella SET HV".$NHV."_ID='$idv1' WHERE UserID='$UserID'";
                  mysqli_query($con,$sqlus);
                  

                  if($HV_ID!="0"){
                    $sqlUH = "DELETE FROM huellas_vocales WHERE HV_ID='$HV_ID'";
                    $resultUH= mysqli_query($con,$sqlUH);

                  //unlink($path);

                  $response = $myVoiceIt->deleteEnrollment($email, $Password, $EnrollmentID);
                  }



                  echo "<script>document.getElementById('enviarEmail').submit();</script>";

                  }else{

            echo "<script language='javascript'>
              swal({
                title: 'Error al registrar',
                text: '".$r1."',
                type: 'error',
                confirmButtonColor: '#47A6AC',
                confirmButtonText: 'Salir',
                allowOutsideClick: false
                }).then(function () {
                    document.getElementById('enviarEmail').submit();
                })
                </script>";
                  
                  }

            }
              

          }else{
            echo "<script type='text/javascript'>
                    redireccionarPagina();
                  </script>";
          }

                  function guardarJson($response) {
                  $file = 'json/datos.json';
                  file_put_contents($file, $response);

                  $data = file_get_contents("json/datos.json");
                  $text = json_decode($data, true);

                  return $text;
                  }

      ?>
    
      <footer class="page-footer indigo darken-4 footer">
      <div class="container">
        <div class="row">
          <div class="col l6 s12">
            <h5 class="white-text">Sobre nosotros</h5>
            <p class="grey-text text-lighten-4">Somos estudiantes de último semestre de ingeniería de sistemas de la universidad Industrial de Santander, actualmente estamos desarrollando nuestro proyecto orientado en métodos de autenticación biométrica.</p>


          </div>
          <div class="col l3 s12">
            <h5 class="white-text">Desarrollado con</h5>
            <ul>
              <li><a class="white-text" href="https://aws.amazon.com/es/rekognition/">Amazon Rekognition</a></li>
              <li><a class="white-text" href="http://materializecss.com/">Materializecss</a></li>
              <li><a class="white-text" href="https://limonte.github.io/sweetalert2/">SweetAlert2</a></li>
            </ul>
          </div>
          <div class="col l3 s12">
            <h5 class="white-text">Repositorios</h5>
            <ul>
              <li><a class="github-button" href="https://github.com/davidjurado/ReconocimientoFacial" data-size="large" aria-label="Star davidjurado/ReconocimientoFacial on GitHub">ReconocimientoFacial</a></li>
              <li><a class="github-button" href="https://github.com/julian1303/ReconocimientoVocal" data-size="large" aria-label="Star julian1303/ReconocimientoVocal on GitHub">ReconocimientoVocal</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="footer-copyright">
        <div class="container">
        &copy;2017 Universidad Industrial de Santander
        </div>
      </div>
    </footer>
 </html>
   <script src="js/lib/recorder.js"></script>
  <script src="js/recordLive.js"></script>