<?php
  session_start();
  if(!isset($_SESSION["Admin"])){

    if(isset($_SESSION["User"])){
      header("Location: indexUser.php");
    }    
  }
?>


<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="media/fingerprint.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

    <title>Búsqueda</title>
    
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
  
  <div>
    <nav class="pushpin-demo-nav pinned indigo darken-4 " style="z-index:3;" >
      <div class="nav-wrapper">
           <form id = "buscar" action="procBusqueda.php" method="post">
             <div class="input-field grey-text">
               <input id="search" name="email" type="search" placeholder="Buscar huella por correo" value="" onblur="validarCorreo('search')" required onkeydown="if (event.keyCode == 13) return false" tabindex="1">
               <input type="hidden" name="accion" value="buscar" tabindex="1" >
               <label class="label-icon" for="search"><i class="material-icons grey-text">search</i></label>
               <i class="material-icons grey-text">close</i>
             </div>
           </form>
         </div>        
          <button style="width: 100%;" class="pushpin-demo-nav pinned waves-effect waves-light blue darken-3 btn" onclick="buscar()" tabindex="2" onfocus="myFunction(this)" onblur="myFunction2(this)">
              Buscar
          </button>  
    </nav>
  </div>
  <br><br><br><br><br><br><br><br><br>
  <div class="row ">
        <div class="col s8 m8 l4 offset-l4 offset-s2 offset-m2">
          <div class="card "> 
            <div class="card-image">
              <img src="media/02.jpg" style="width: 100%; height: 50%;" class="responsive-img">              
            </div>    
                  
            <div class="card-content">
              <p>En esta pagina podras buscar las huellas tanto vocales como faciales para cada uno de los
              usuarios registrados en el modulo.</p>
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

  <script type="text/javascript">
    $('.pushpin-demo-nav').each(function() {
      var $this = $(this);
      var $target = $('#' + $(this).attr('data-target'));
      $this.pushpin({
        top: $target.offset().top,
        bottom: $target.offset().top + $target.outerHeight() - $this.height()
      });
    });
  </script>

  <script type="text/javascript">
        function myFunction(x) {
            x.style= "width: 100%; border: 0.5px solid grey; border-radius: 5px;";
            x.className="pushpin-demo-nav pinned waves-effect waves-light blue darken-1 btn";
        }
        function myFunction2(x) {
            x.style= "width: 100%; ";
            x.className="pushpin-demo-nav pinned waves-effect waves-light blue darken-3 btn";
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

        function buscar(){     
          var validateStateCorreo = document.getElementById('search').className;
          if(document.getElementById('search').value!="" ){

            if(validateStateCorreo != "validate invalid"){
              document.getElementById('buscar').submit();
            }
            else{
              swal({ title: 'Error!',  html: 'El correo debe tener el siguente formato <br> <b>xxxxxx@xxxx.com</b>',  type: 'error',  confirmButtonText: 'OK'})
            }

          }
          else{
              swal({ title: 'Error!',  text: 'Por favor ingresa el correo para realizar la busqueda',  type: 'error',  confirmButtonText: 'OK'})
          }
        }
  </script>

</body>

</html>



