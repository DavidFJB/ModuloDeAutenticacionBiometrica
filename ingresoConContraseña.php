<?php
  session_start();
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

    <title>Registro</title>
    
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.0/sweetalert2.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">
    
    <link href="https://fonts.googleapis.com/css?family=Raleway|Roboto" rel="stylesheet">
    
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
  
<body>
  
  <div class="navbar-fixed"><!--Barra de navegacion-->
    <nav class="white" role="navigation">
      <div class="nav-wrapper container">
        <ul id="slide-out" class="side-nav">
          <li><a href=".">Home</a></li>
          <li><a href="registro.php">Registro</a></li>
          <li class="active"><a href="ingresoConContraseña.php">Ingreso</a></li>
        </ul>
        <a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>
        <a id="logo-container" href="." class="brand-logo center"><i class="medium material-icons">fingerprint</i></a>
        <ul class="right hide-on-med-and-down">
          <li><a href="registro.php">Registro</a></li>
          <li class="active"><a href="ingresoConContraseña.php">Ingreso</a></li>
        </ul>
        <ul id="nav-mobile" class="side-nav">
          <li><a href="registro.php">Registro</a></li>
          <li  class="active"><a href="ingresoConContraseña.php">Ingreso</a></li>
        </ul>
      </div>
    </nav>
  </div>

  
  <br><br><br><br>

  <div  class="container picker__header section scrollspy "><!-- Formulario para registrar usuario -->
      <div class="row">
        <div class="col s12 m12 l6 offset-l3">
          <div class="col s12 card #212121 grey darken-4 z-depth-5">
            <div class="card-content white-text">
               <h3 class="center-align ">Iniciar sesión</h3>
              <div id="registro" class="section scrollspy row">
                <form id="FormCrearUsuario" class="col s10 offset-s1" action="inicioSesionContraseña.php"  method="post">
                  <div>                    
                    <div class="input-field">
                      <input class="validate" name="email" type="email" id="correo" onblur="validarCorreo('correo')">
                      <label class="valign-wrapper" for="Correo">Correo electronico</label>                    
                    </div>
                    <div class="input-field">
                      <i class="material-icons prefix">lock</i>
                      <input class="validate" name="password" type="password" id="Contraseña" onblur="validarContraseña()" onfocus="validarContraseña()">   
                      <label class="valign-wrapper" for="Contraseña">Contraseña</label>                 
                    </div>           
                    <br>
                    <div class="center-align">                    
                      <input class=" waves-light btn #1565c0 blue darken-3 col s12" type="button" value="Iniciar sesión" onclick="validarFormIniciarSesionContraseña()" id="btn-submit" >
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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.0/sweetalert2.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
  <script src="js/init.js"></script>    
  <script async defer src="https://buttons.github.io/buttons.js"></script>

  <script type="text/javascript">
     $(document).ready(function(){
      $('.scrollspy').scrollSpy();
    });
  </script>

</body>

</html>
<script type="text/javascript">
    function validarContraseña(){

          var minNumberofChars = 6;

          var Contra1 = document.getElementById('Contraseña').value;          

          if(Contra1.length < minNumberofChars){
              document.getElementById('Contraseña').className="validate invalid";              
          }
          else{
             document.getElementById('Contraseña').className="validate valid";
          }
          
        }

        function validarCorreo(e){
          var id = e;
          var correo = document.getElementById(id).value;
          
          expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

          if ( !expr.test(correo) ){
            document.getElementById(id).className="validate invalid";
          }      
          else{
            document.getElementById(id).className="validate valid";
          }
        }

        function ValidateNumberOnly(){
          if ((event.keyCode < 48 || event.keyCode > 57)){
            if(event.keyCode!=8){
              event.returnValue = false;
            }
          }
        }
        function validarFormIniciarSesionContraseña(){

            var validateStateContraseña = document.getElementById('Contraseña').className;            
            var validateStateCorreo = document.getElementById('correo').className;
            var Contra1 = document.getElementById('Contraseña').value;            
            var minNumberofChars = 6;

            if(document.getElementById('correo').value!="" && document.getElementById('Contraseña').value!=""){

              if(validateStateContraseña!="validate invalid"){

                  if(validateStateCorreo != "validate invalid"){
                    document.getElementById('FormCrearUsuario').submit();
                  }
                  else{
                    swal({ title: 'Error!',  html: 'El correo debe tener el siguente formato <br> <b>xxxxxx@xxxx.com</b>',  type: 'error',  confirmButtonText: 'OK'})
                  }
              }
              else{                
                if(Contra1.length < minNumberofChars){
                  swal({ title: 'Error!',  text: 'La contraseña debe tener minimo 6 caracteres',  type: 'error',  confirmButtonText: 'OK'})
                  
                }
                else{
                    swal({ title: 'Error!',  text: 'La contraseña no coincide',  type: 'error',  confirmButtonText: 'OK'})
                }
              }


            }
            else{
                swal({ title: 'Error!',  text: 'Debe ingresar todos los campos',  type: 'error',  confirmButtonText: 'OK'})
            }
        }
</script>

