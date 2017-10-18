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
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.0/sweetalert2.css"> 

      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">
      <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
 <script type="text/javascript" src="js/webcam.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

</head>
<!-- Modificaciones en los colores del active, linea 6074, icon 6392, checkbox 6601 & 6596, chulito 6727-->
<body >

  <div class="navbar-fixed"><!--Barra de navegacion-->
    <nav class="white" role="navigation">
      <div class="nav-wrapper container">
        <ul id="slide-out" class="side-nav">
          <li><a href=".">Home</a></li>
          <li><a href="registro.php">Registro</a></li>
          <li class="active"><a href="ingreso.php">Ingreso</a></li>
        </ul>
        <a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>
        <a id="logo-container" href="." class="brand-logo center"><i class="medium material-icons">fingerprint</i></a>
        <ul class="right hide-on-med-and-down">
          <li><a href="registro.php">Registro</a></li>
          <li class="active"><a href="ingreso.php">Ingreso</a></li>
        </ul>
        <ul id="nav-mobile" class="side-nav">
          <li><a href="registro.php">Registro</a></li>
          <li  class="active"><a href="ingreso.php">Ingreso</a></li>
        </ul>
      </div>
    </nav>
  </div>

<br><br><br>
  

 <div class="container picker__header"><!--Autenticar --> 
    <div class="row">
      <div class="col s12 m12 l6 offset-l3">
        <div class="col s12 card #212121 grey darken-4 z-depth-5">
          <div class="card-content white-text">
             <h3 class="center-align ">Ingreso al Módulo</h3>
            <div class="row">
              <form id="myformA" class="col s10 offset-s1" action="ingresoBio.php" method="post">
                <div>
                  <div class="input-field">
                    <input class="validate" name="email" type="email" id="CorreoAutenticar" name="pass" onblur="validarCorreo('CorreoAutenticar')">
                    <label class="valign-wrapper" for="Correo">Correo electronico</label>                      
                  </div>                  
                  <div class="input-field grey-text ">
                     <i class="material-icons prefix valign-wrapper white-text">g_translate</i>
                    <select id="selectorA" name="idioma">        
                      <!--Cambio de color en 5476-->             
                      <option value="" disabled selected>Idioma</option>
                      <option value="es-CO">Español</option>
                      <option value="en-US">Ingles</option>
                    </select>
                  </div>
                  <br>
                  <div class="center-align">
                    
                    <button  class="btn btn-floating waves-light white" type="button" value="autenticar" onclick="Grabar2(this);" required ><i class="material-icons left black-text">mic</i></button><label><h5>Grabar</h5></label>
                    <button  class="btn btn-floating waves-light white " type="button" value="crearHuella2" onclick="Grabarf(this);" required ><i class="material-icons left black-text">add_a_photo</i></button><label><h5>Grabar huella facial</h5></label>
    
                    <input id="mydataf" type="hidden" name="mydataf" value=""/>
                    <input id="mydatav" type="hidden" name="mydatav" value=""/>
                    <input value="autenticacion" type="hidden"  name="accion"  >
                  </div>
                  <br>
                  <div class="center-align">
                    <input class=" waves-light btn #1565c0 blue darken-3 col s12"  onclick="validarFormAutenticar()" type="button" id="btn-submit" value="Enviar">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  
<br><br><br>
  

  <script>//Validaciones    
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

        function validarFormAutenticar(){

            var validateStateCorreo = document.getElementById('CorreoAutenticar').className;
            var idioma = document.getElementById('selectorA').value;

            if(idioma == "en-US"){

                if(document.getElementById('CorreoAutenticar').value!==""){
                  
                    if(validateStateCorreo != "validate invalid"){
                          loadBinaryA(idioma);
                    }
                    else{
                      swal({ title: 'Error!',  html: 'The email should have the following format <br> <b>xxxxxx@xxxx.com</b>',  type: 'error',  confirmButtonText: 'OK'})
                    }

                }
                else{
                    swal({ title: 'Error!',  text: 'You must enter all the fields',  type: 'error',  confirmButtonText: 'OK'})
                }

            }
            else{ 
              if(document.getElementById('CorreoAutenticar').value!==""){
                
                if(document.getElementById('selectorA').value!=""){

                  if(validateStateCorreo != "validate invalid"){
                        loadBinaryA(idioma);
                  }
                  else{
                    swal({ title: 'Error!',  html: 'El correo debe tener el siguente formato <br> <b>xxxxxx@xxxx.com</b>',  type: 'error',  confirmButtonText: 'OK'})
                  }

                }
                else{
                  swal({ title: 'Error!',  text: 'Por favor seleccione un idioma',  type: 'error',  confirmButtonText: 'OK'})
                }
                
              }
              else{
                  swal({ title: 'Error!',  text: 'Debe ingresar todos los campos',  type: 'error',  confirmButtonText: 'OK'})
              }
            }
        }

        function validarSeleccionIdioma(button){

            
            
            if(button.value=="autenticar"){
              
              var res =document.getElementById('selectorA').value;
              
              if(document.getElementById('selectorA').value!==""){                
                return true;
              }
              else{
                swal({ title: 'Error!',  text: 'Por favor selecciona un idioma',  type: 'error',  confirmButtonText: 'OK'})
                return false;
              }
            }
            else{
              
              if(document.getElementById('selectorC').value!==""){
                return true;
              }
              else{
                swal({ title: 'Error!',  text: 'Por favor seleccion un idioma',  type: 'error',  confirmButtonText: 'OK'})
                return false;
              }
            }
        }
  </script>

  <script>//Carga del binaryData para crear huella
        function loadBinary(e){

            var data_uri1 = returnBinary1();
            if(data_uri1 == undefined){
              if(e=="es-CO"){
                swal({ title: 'Error!',  text: 'Debe realizar las grabaciones para la creación de la huella',  type: 'error',  confirmButtonText: 'OK'})
              }
              else{
              swal({ title: 'Error!',  text: 'You must do the recordings for the creation of the fingerprint',  type: 'error',  confirmButtonText: 'OK'})
              }
            }
            
            var data_uri2 = returnBinary2();
            var data_uri3 = returnBinary3();

            var raw_image_data1 = data_uri1.result.replace(/^data\:audio\/\w+\;base64\,/, '');
            var raw_image_data2 = data_uri2.result.replace(/^data\:audio\/\w+\;base64\,/, '');
            var raw_image_data3 = data_uri3.result.replace(/^data\:audio\/\w+\;base64\,/, '');

            //alert(raw_image_data1);

            document.getElementById('mydata1').value = raw_image_data1;
            document.getElementById('mydata2').value = raw_image_data2;
            document.getElementById('mydata3').value = raw_image_data3;
            document.getElementById('myform').submit();
            

            //swal({title: 'Correcto',text: raw_image_data, type: 'success',confirmButtonText: 'Cool'});

        }
  </script>

  <script>//Carga del binaryData para autenticar
        function loadBinaryA(e){
           

            var data_uri = returnBinary();
            
            if(data_uri == undefined){

              if(e=="es-CO"){
                swal({ title: 'Error!',  text: 'Debe realizar la grabacion para poder autenticarse',  type: 'error',  confirmButtonText: 'OK'})
              }
              else{
              swal({ title: 'Error!',  text: 'You must perform the recording to be able to authenticate',  type: 'error',  confirmButtonText: 'OK'})
              }
            }else{
              if(document.getElementById('mydataf').value == ""){
              if(e=="es-CO"){
                swal({ title: 'Error!',  text: 'Debe realizar la foto para la creación de la huella',  type: 'error',  confirmButtonText: 'OK'})
              }
              else{
              swal({ title: 'Error!',  text: 'You must take a snapshot for the creation of the fingerprint',  type: 'error',  confirmButtonText: 'OK'})
              }
            }else{
            var raw_image_data = data_uri.result.replace(/^data\:audio\/\w+\;base64\,/, '');
            document.getElementById('mydatav').value = raw_image_data;
            document.getElementById('myformA').submit()

            }
            }         


            

            //swal({title: 'Correcto',text: raw_image_data, type: 'success',confirmButtonText: 'Cool'});

        }
  </script>

  <script>//Funcion que ejecuta la accion de grabar 3 veces
        function Grabar2(button){          
          
          b=button;
          var seleccionIdioma = validarSeleccionIdioma(button);        
          

          if(seleccionIdioma==true){

                    var sound = new Audio('media/grabacion.wav');
                    var beep = new Audio('media/beep.wav');
                    var id = button.value;
                    if(id=="autenticar"){
                      var idioma = document.getElementById("selectorA").value;  
                    }
                    else{
                      var idioma = document.getElementById("selectorC").value;  
                    }
                    

                    if(button.value=="autenticar"){

                        if(idioma=="es-CO"){

                          swal({
                            html: "<i class='material-icons medium blue-text'>music_note</i> <h5><b>Graba tu huella vocal</b></h5> <br> Realiza tu grabación <br><br> Pulsa para grabar<br> Despues di: <b>Mi voz es mi contraseña</b>",
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
                                                beep.play();
                                                Grabar3(b);                            
                                              },5000)
                          })

                        }
                        else{

                          swal({
                            html: "<i class='material-icons medium blue-text'>music_note</i> <h5><b>Record your fingerprint vowel</b></h5> <br> Make your recording <br><br> Press to record<br> Then say: <b>Never forget tomorrow is a new day</b>",
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
                                  beep.play();
                                  Grabar3(b); 
                          })
                          
                        }  
                    }
                    else{
                    
                      if(idioma=="es-CO"){
            
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
                                                beep.play();
                                                Grabar3(b);  
                                              },5000)
            
                                              setTimeout(function(){
                                                swal({
                                                    html: "<i class='material-icons medium blue-text'>filter_2</i> <h5><b>Graba tu huella vocal</b></h5> <br> Segunda grabacion <br><br> Pulsa para grabar<br> Despues di: <b>Mi voz es mi contraseña</b>",
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
                                                                      beep.play();                                                       
                                                                      Grabar3(b);                         
                                                                    },5000)
            
                                                                    setTimeout(function(){
                                                                      swal({
                                                                        html: "<i class='material-icons medium blue-text'>filter_3</i> <h5><b>Graba tu huella vocal</b></h5> <br> Tercera grabacion <br><br> Pulsa para grabar<br> Despues di: <b>Mi voz es mi contraseña</b>",
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
                                                                                            beep.play();
                                                                                            Grabar3(b);                            
                                                                                          },5000)
                                                                      })
                                                                    },10600);
                                                  
                                                })
                                              },10600);
                          })
            
                      }else{
            
                          swal({          
                            html: "<i class='material-icons medium blue-text'>filter_1</i> <h5><b>Record your fingerprint</b></h5> First recording <br><br> Press to record<br> Then say: <b>Never forget tomorrow is a new day</b>",
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
                                              beep.play();
                                              Grabar3(b);                                  
                                              setTimeout(function(){
                                                swal({
                                                  html: "<i class='material-icons medium blue-text'>filter_1</i> <h5><b>Record your fingerprint</b></h5> Second recording <br><br> Press to record<br> Then say: <b>Never forget tomorrow is a new day</b>",
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
                                                                    beep.play();
                                                                    Grabar3(b);                                                        
                                                                    setTimeout(function(){
                                                                    swal({
                                                                      html: "<i class='material-icons medium blue-text'>filter_1</i> <h5><b>Record your fingerprint</b></h5> Third recording <br><br> Press to record<br> Then say: <b>Never forget tomorrow is a new day</b>",
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
                                                                                        beep.play();
                                                                                        Grabar3(b);
                                                                                        
                                                                    })
                                                                  },5200);
                                                  
                                                })
                                              },5200);
            
            
            
                          })
                      }
                    
                    }
          }

        
        }
  </script>

  <script>//Funcion que ejecuta la accion de grabar en el javascript          
          function Grabar3(button){

            b=button;

            var id = button.value;
            if(id=="autenticar"){
                  var idioma = document.getElementById("selectorA").value;  
            }
            else{
                  var idioma = document.getElementById("selectorC").value;  
            }

            if(idioma=="es-CO"){
                    swal({
                    html: " <h5><b>Grabando</b></h5> <br> <button  class='btn btn-floating pulse waves-light red' type='button'><i class='material-icons left'>fiber_manual_record</i></button> <br><br> <b>Di: Mi voz es mi contraseña</b>  <br> La grabacion finalizara en 5 segundos!!",            
                    text: 'Se cerrará automáticamente en 5 segundos',
                    showConfirmButton: false,
                    timer: 5000,
                    allowOutsideClick: false,
                    onOpen: function () {

                      setTimeout(function(){
                        Grabar(b);},540);                     
                      
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
              else{
                  swal({
                  html: " <h5><b>Recording</b></h5> <br> <button  class='btn btn-floating pulse waves-light red' type='button'><i class='material-icons left'>fiber_manual_record</i></button> <br><br> <b>Say: Never forget tomorrow is a new day</b>  <br> The recording ended in 5 seconds!!",            
                  text: 'Se cerrará automáticamente en 5 segundos',
                  showConfirmButton: false,
                  timer: 5000,
                  allowOutsideClick: false,
                  onOpen: function () {
                    Grabar(b);
                    
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
          }
  </script>

  <script>//Funcion que ejecuta la accion de grabar en el javascript 

        function Grabarf(button){          
          
          b=button;
          var cameraSound = new Audio('media/camera.wav');



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
                                   
                                        swal(
                                          'Correcto!',
                                          'Tu imagen se ha guardado.',
                                          'success'
                                        )
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


  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.0/sweetalert2.js"></script>
  
  <script src="js/lib/recorder.js"></script>
  <script src="js/recordLive.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
  <script src="js/init.js"></script>    
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script >
     $(document).ready(function() {
    $('select').material_select();
  });
  </script>
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
</body>
</html>


