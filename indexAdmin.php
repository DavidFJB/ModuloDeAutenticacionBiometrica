<?php
  session_start();
  if(!isset($_SESSION["Admin"])){

    if(isset($_SESSION["User"])){
      header("Location: indexUser.php");
    }
    else{
      header("Location: index.php");
    }
  }
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

    <title>Módulo de autenticación biométrica</title>
    
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">
    
    <link href="https://fonts.googleapis.com/css?family=Raleway|Roboto" rel="stylesheet">
    
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.0/sweetalert2.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.0/sweetalert2.js"></script>
    
</head>

<body>
  <div class="navbar-fixed"><!--Barra de navegacion-->
    <nav class="white" role="navigation">
      <div class="nav-wrapper container">
        <ul id="slide-out" class="side-nav">                                       
          <li><a href="registro-huella.php">Registrar huella</a></li>
          <li><a href="busqueda.php">Buscar</a></li>
          <li><a href="cerrarSesion.php">Cerrar sesión</a></li>
        </ul>
        <a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>
        <a id="logo-container" href="indexAdmin.php" class="brand-logo center"><i class="medium material-icons">fingerprint</i></a>
        <ul class="right hide-on-med-and-down">                              
          <li><a href="registro-huella.php">Registrar huella</a></li>
          <li><a href="busqueda.php">Buscar</a></li>
          <li><a href="cerrarSesion.php">Cerrar sesión</a></li>
        </ul>
        <ul id="nav-mobile" class="side-nav">                              
          <li><a href="registro-huella.php">Registrar huella</a></li>
          <li><a href="busqueda.php">Buscar</a></li>
          <li><a href="cerrarSesion.php">Cerrar sesión</a></li>
        </ul>
      </div>
    </nav>
  </div>

  <div class="parallax-container valign-wrapper"><!-- Gif -->
    <div class="section no-pad-bot">
      <div class="container">
        <div class="row center">
            <form id="moodle" method="post" action="../moodle/login/index.php" target="_blank">
            <input id="username" type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>"/>
            <input id="password" type="hidden" name="password" value="<?php echo $_SESSION['password']; ?>"/>
            <input class="btn-large waves-light #1565c0 blue darken-3"  onclick="document.getElementById('moodle').submit();" type="button" id="btn-submit" value="Ir a moodle">            
          </form>
        </div>
      </div>
    </div>
    <div class="parallax"><img src="http://www.starlinkindia.com/blog/wp-content/uploads/2016/08/Biometric-From-Its-Past-History-1.jpg" alt="Unsplashed background img 2"></div>
  </div>


 <div class="container"><!-- Info 1-->
    <div class="section">
      <div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons">lock</i></h2>
            <h5 class="center">Alto grado de seguridad</h5>

            <p class="light" style="text-align: justify;">Este módulo está basado en la unión de dos metodos de autenticación biometrica, aunque independientemente cada uno ofrece un grado de seguridad moderado, dejan muchas brechas a aquellos indivuduos que quieran suplantar a otra persona, es por esto que la unión de estos metodos permite aumentar considerablemente el grado de seguridad al ingresar al sistema.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons">mood</i></h2>
            <h5 class="center">Biometría facial</h5>

            <p class="light" style="text-align: justify;">Permite determinar la identidad de una persona analizando una de sus características fisiológicas, su rostro,  a diferencia de otras técnicas biométricas es fácil de implementar y mucho menos costoso, sólo es necesario que el rostro sea adquirido por una cámara para que posteriormente la imagen sea analizada.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons">record_voice_over</i></h2>
            <h5 class="center">Biometría de voz</h5>

            <p class="light" style="text-align: justify;">Consiste en la identificación automática de una persona a través de su voz, el reconocimiento consta de un procesado de audio que permite extraer un conjunto características del locutor y posteriormente la búsqueda de coincidencias mediante un proceso de reconocimiento de patrones.</p>
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="parallax-container valign-wrapper"><!-- Git hub -->
      <div class="section no-pad-bot">
        <div class="container">
          <div class="row center">
            <h5 class="header col s12 light black-text">Repositorio del proyecto</h5>          
            <a href="https://github.com/DavidFJB/ModuloDeAutenticacionBiometrica" class="btn-floating btn-large waves-effect waves-light indigo lighten-1"><i class="fa fa-github"></i></a>
          </div>
        </div>
      </div>
      <div class="parallax"><img src="https://assets-cdn.github.com/images/modules/open_graph/github-mark.png" alt="Unsplashed background img 3"></div>
  </div>

  <div class="container"><!-- Info 2 -->
    <div class="section">

      <div class="row">
        <div class="col s12 center">
          <h3><i class="mdi-content-send brown-text"></i></h3>
          <h4>Biometría bimodal</h4>
          <p class="left-align light">Es la combinación de las dos tecnicas de autenticación biometrica y otorga grandes ventajas como mayor precisión a la hora de detectar y autenticar a una persona, mayor seguridad ya que elimina la posiblidad de suplantación de identidad, universalidad ya que si una persona no puede hacer uso de la biometria vocal podrá suar la facial y viceversa, efectividad-costo ya que al tratarse de biometria facial y de voz hace su implementación demasiadamente facil y accesible para la mayoria de usuarios.</p>
          <a href="#tcmodal" class="btn waves-effect waves-light indigo lighten-1 tctrigger">Más información</a>
        </div>
      </div>

    </div>
  </div>

  <div class="row"><!-- Info 2 -->
      <div id="tcmodal" class="modal">
        <div class="modal-content">
          <h4>Rostro &amp; Voz</h4>
          <p>La biometría multimodal son sistemas que son capaces de usar más de una característica fisiológica o de comportamiento para la inscripción, verificación e identificación. Identificación humana basado en biometría multimodal se está convirtiendo en una tendencia emergente, y una de las razones más importantes para combinar diferentes modalidades es mejorar la precisión de reconocimiento. Hay razones adicionales para combinar dos o más datos biométricos como el hecho de que diferentes modalidades biométricas sería más apropiadas para escenarios de implementación única o cuando la seguridad es de vital importancia para proteger los datos confidenciales.</p>
          <p>La biometría facial y de voz actualmente  permiten una implementación sencilla, pues en cuanto a hardware se refiere tan solo se necesita una cámara y un micrófono respectivamente, encontramos estos componentes físicos en dispositivos móviles o computadores lo que no solo reduce costos sino que también aumenta su sencillez y usabilidad.
          </p>
        </div>
        <div class="modal-footer">
          <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
        </div>
      </div>
  </div>



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
  

  <script type="text/javascript">
      $(document).ready(function(){
        $('.tctrigger').leanModal();
      });
  </script>
</body>
</html>

<?php
  
    if($_SESSION['Contador']=="0"){
      
      echo "<script>swal({title: 'Correcto',html: '<b>Bienvenido administrador</b>, Desde esta web podras ingresar las huellas correspondientes a cada uno de los usuarios', type: 'success',confirmButtonText: 'Aceptar'});</script>";
      $_SESSION['Contador']="1";
    }
  
?>