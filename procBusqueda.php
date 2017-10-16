
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
  </script>

  </body>
  <?php
    
      
    //Conexion con base de datos local  
    $con = mysqli_connect("localhost", "root", "", "biofacvoz")or die("Problemas al conectar");

    if ($con->connect_error) {
      die("Conexión biofacvoz fallida: " . $con->connect_error);
    } 
    $acentos = $con->query("SET NAMES 'utf8'");

    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $email=  $_POST["email"];        
        $sql = "SELECT * FROM usuarios WHERE email='$email'";//Query en la DB biofacvoz para revisar si hay un email igual
        $result= mysqli_query($con,$sql);
        $checkuser=mysqli_num_rows($result);

        if($checkuser>0){//correo registraro?          
          
            $info = mysqli_fetch_assoc($result);
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

                $sqlHF = "SELECT * FROM huellas_faciales WHERE HF_ID='$HF_ID'";
                $resultHF= mysqli_query($con,$sqlHF);
                $infoHF = mysqli_fetch_assoc($resultHF);
                $pathHF = $infoHF['HuellaFacial'];

                $sqlHV1 = "SELECT * FROM huellas_vocales WHERE HV_ID='$HV1_ID'";
                $resultHV1= mysqli_query($con,$sqlHV1);
                $infoHV1 = mysqli_fetch_assoc($resultHV1);
                $pathHV1 = $infoHV1['HuellaVocal'];
                

                $sqlHV2 = "SELECT * FROM huellas_vocales WHERE HV_ID='$HV2_ID'";
                $resultHV2= mysqli_query($con,$sqlHV2);
                $infoHV2 = mysqli_fetch_assoc($resultHV2);
                $pathHV2 = $infoHV2['HuellaVocal'];

                $sqlHV3 = "SELECT * FROM huellas_vocales WHERE HV_ID='$HV3_ID'";
                $resultHV3= mysqli_query($con,$sqlHV3);
                $infoHV3 = mysqli_fetch_assoc($resultHV3);
                $pathHV3 = $infoHV3['HuellaVocal'];

                $path=$pathHF; 
                $path1=$pathHV1;
                $path2=$pathHV2;
                $path3=$pathHV3;      


                $enlace=$path;
                $imageData = base64_encode(file_get_contents($enlace));
                echo "<br><br><br>";
                echo'  <div class="row">
                        <div class="col s12 m2 l4 offset-l4">
                          <div class="card">
                            <div class="card-image">
                              <img src="'.$path.'">
                              <span class="card-title black-text">'.$email.'</span> 
                            </div>
                            <div class="card-action">
                              <a href="'.$path.'" download>Descargar</a>
                              
                            </div>
                          </div>
                        </div>
                      </div>
                      <br>';

                echo'<div class="row">
                  <div class="col s12 m2 l3">
                  </div>
                  <div class="col s12 m6 l6">
                    <div class="card">
                      <div class="card-content white-text">
                        <span class="card-title black-text">Huella 1</span>
                        <audio controls>
                          <source src="'.$path1.'" type="audio/wav">
                        </audio>
                        </div>                       
                      </div>
                    </div>
                    <div class="col s12 m2 l3">
                  </div>
                </div>';

                echo'<div class="row">
                  <div class="col s12 m2 l3">
                  </div>
                  <div class="col s12 m6 l6">
                    <div class="card">
                      <div class="card-content white-text">
                      <span class="card-title black-text">Huella 2</span>
                        <audio controls>
                          <source src="'.$path2.'" type="audio/wav">
                        </audio>
                      </div>
                    
                      
                        </div>
                      </div>
                    <div class="col s12 m2 l3">
                  </div>
                  </div>';

                echo'<div class="row">
                  <div class="col s12 m2 l3">
                  </div>
                  <div class="col s12 m6 l6">
                    <div class="card">
                      <div class="card-content white-text">
                      <span class="card-title black-text">Huella 3</span>
                        <audio controls>
                          <source src="'.$path3.'" type="audio/wav">
                        </audio>
                      </div>
                    
                      
                  </div>
                  </div>
                    <div class="col s12 m2 l3">
                  </div>
                </div>';
            }
            else{
              echo "<script type='text/javascript'>
                      swal({ title: 'Error!',  text: 'El Correo aun no tiene huellas registradas',  type: 'error',  confirmButtonText: 'OK', allowOutsideClick: false}).then(function () {      redireccionarPagina();})
                    </script>";
            }

            
                              
        }
        else{
          echo "<script type='text/javascript'>
          swal({ title: 'Error!',  text: 'El Correo no está registrado',  type: 'error',  confirmButtonText: 'OK', allowOutsideClick: false}).then(function () {      redireccionarPagina();})
          </script>";
        }
    


      }

?>