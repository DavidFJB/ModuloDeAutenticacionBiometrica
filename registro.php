<!DOCTYPE html>
<html>
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

    <title>Registro</title>
    
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">
    
    <link href="https://fonts.googleapis.com/css?family=Raleway|Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.0/sweetalert2.css"> 
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
  
<body>
  
  <div class="navbar-fixed"><!--Barra de navegacion-->
    <nav class="white" role="navigation">
      <div class="nav-wrapper container">
        <ul id="slide-out" class="side-nav">
          <li><a href=".">Home</a></li>
          <li class="active"><a href="registro.html">Registro</a></li>
          <li><a href="reconocimiento.html">Ingreso</a></li>
        </ul>
        <a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>
        <a id="logo-container" href="." class="brand-logo center"><i class="medium material-icons">fingerprint</i></a>
        <ul class="right hide-on-med-and-down">
          <li class="active"><a href="registro.html">Registro</a></li>
          <li><a href="reconocimiento.html">Ingreso</a></li>
        </ul>
        <ul id="nav-mobile" class="side-nav">
          <li class="active"><a href="registro.html">Registro</a></li>
          <li><a href="reconocimiento.html">Ingreso</a></li>
        </ul>
      </div>
    </nav>
  </div>

  <div id="index-banner" class="parallax-container"><!-- Parallax -->
      <div class="section no-pad-bot">
        <div class="container">
          <br><br>
           <div class="row center">
          <h3 class="header col s12 white-text text-lighten-2">Registrate</h3>
           </div>
          <div class="row center">
            <h5 class="header col s12 light">Bienvenido al módulo de autenticacion biometrica</h5>
          </div>
          <div class="row center">
            <a href="#registro" id="download-button" class="btn-floating blue darken-3 pulse"><i class="material-icons">arrow_downward</i></a>
          </div>
          <br><br>

        </div>
      </div>
      <div class="parallax">
        <img  src="media/banner.jpg" alt="Unsplashed background img 1">
      </div>
  </div>
  
  <section class="aboutContent">
      <div class="container">        
        <p><br>A continuacion encontraras un formulario de registro en el cual debes ingresar los datos solicitados para posteriormente poder realizar 
          la grabacion de las huellas tanto vocal como facial.
          <br><br>
          Una vez realizado el registro el <b>administrador</b> se encargará de contactarte para agendar una cita presencial en la cual se hará toma de 
          tu informacion biometrica, esto con el fin de garantizar la fiabilidad e integridad de los datos almacenados en el sistema.
        </p>
      </div>
  </section>

  <br><br>

  <div  class="container picker__header section scrollspy ">
      <div class="row">
        <div class="col s12 m12 l6 offset-l3">
          <div class="col s12 card #212121 grey darken-4 z-depth-5">
            <div class="card-content white-text">
               <h3 class="center-align ">Crear Usuario</h3>
              <div id="registro" class="section scrollspy row">
                <form id="FormCrearUsuario" class="col s10 offset-s1" action="index2.php"  method="post">
                  <div>
                    <div class="input-field" >                    
                      <input class="validate" name="firsName" type="text" id="Nombre"  required >
                      <label class="valign-wrapper" for="Nombre" required>Nombre</label>
                    </div>
                    <div class="input-field">                    
                      <input id="Apellido" name="lastName" type="text" class="validate">
                      <label class="valign-wrapper" for="Apellido">Apellido</label>                    
                    </div>
                    <div class="input-field">
                      <input class="validate" name="email" type="email" id="correoCrearUsuario" name="pass" onblur="validarCorreo('correoCrearUsuario')">
                      <label class="valign-wrapper" for="Correo">Correo electronico</label>                    
                    </div>
                    <div class="input-field">
                      <i class="material-icons prefix">lock</i>
                      <input class="validate" name="password" type="password" id="CUContraseña" onblur="validarContraseña()" onfocus="validarContraseña()">   
                      <label class="valign-wrapper" for="Contraseña">Contraseña</label>                 
                    </div>
                    <div class="input-field">
                      <i class="material-icons prefix">lock</i>
                      <input class="validate" type="password" id="ConfirmarContraseña" onblur="validarContraseña()" onfocus="validarContraseña()">   
                      <label class="valign-wrapper" for="Contraseña">Confirmar contraseña</label>                 
                    </div>
                    <div class="input-field">
                      <i class="material-icons prefix">phone</i>
                      <input id="Telefono" name="tel" type="tel" class="validate" onkeydown="ValidateNumberOnly()">
                      <label class="valign-wrapper" for="Telefono">Telefono</label>    

                      <input type="hidden" name="accion" value="Crear usuario">                
                    </div>                  
                    <br>
                    <div class="center-align">                    
                      <input class=" waves-light btn #1565c0 blue darken-3 col s12" type="button" value="Crear usuario" onclick="validarFormCrearUsuario()" id="btn-submit" >
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>

  <br><br>

<footer class="page-footer indigo darken-4"><!-- Pie de pagina -->
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Sobre nosotros</h5>
          <p class="grey-text text-lighten-4">Estudiantes de ingeniería de sistemas de la universidad Industrial de Santander.</p>


        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Desarrollado con</h5>
          <ul>
            <li><a class="white-text" href="https://aws.amazon.com/es/rekognition/">Amazon Rekognition</a></li>
            <li><a class="white-text" href="https://voiceit.io/">VoiceIt</a></li>
            <li><a class="white-text" href="http://materializecss.com/">Materializecss</a></li>
            <li><a class="white-text" href="https://limonte.github.io/sweetalert2/">SweetAlert2</a></li>
          </ul>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Prototipos</h5>
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


  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
  <script src="js/init.js"></script>    
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.0/sweetalert2.js"></script>

  <script type="text/javascript">
     $(document).ready(function(){
      $('.scrollspy').scrollSpy();
    });
  </script>

</body>

</html>

<?php 

    require_once("VoiceIt.php");
    $myVoiceIt = new VoiceIt();
    error_reporting(E_ERROR | E_WARNING | E_PARSE);      
    $con = mysqli_connect("localhost", "root", "", "biofacvoz")or die("Problemas al conectar");
    if ($con->connect_error) {
      die("Connection failed: " . $con->connect_error);
    } 

    $accion = $_POST["accion"];
    
    if ($accion === "Crear usuario") {
        
        $email = $_POST["email"];
        $password = $_POST["password"];
        $firsName = $_POST["firsName"];
        $lastName = $_POST["lastName"];
        $tel = $_POST["tel"];

        $response = $myVoiceIt->createUser($email, $password, $firsName, $lastName, $tel, "", "");

        $sql = "INSERT INTO usuarios (Nombre, Apellido, Email, Password,  Telefono, Rol) VALUES ('$firsName', '$lastName', '$email', '$password', $tel, '001')";
        


        $text = guardarJson($response);

        if ($text["Result"] == "Success") {
            echo "<script>swal({title: 'Correcto',html: 'Registro exitoso por favor contacte al siguente numero <b>3174837626</b> o al correo <b>jdkdhd@jdjd.com</b> para la creacion de las huellas biometricas correspondientes', type: 'success',confirmButtonText: 'Aceptar'});</script>";

            if ($con->query($sql) === TRUE) {
             
             } 
            else {
                 echo "<script>alert(Error en grabacion de base de datos);</script>";
            }

        } else {
            $r = $text["Result"];
            echo "<script>swal({ title: 'Error!',  text: '$r',  type: 'error',  confirmButtonText: 'Aceptar'})</script>";
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