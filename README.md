# ModuloDeAutenticacionBiometrica

Desarrollo de prototipo de módulo web en el que los usuarios pueden ser identificados por reconocimiento biométrico (facial y de voz).

## Introducción

En el presente proyecto se va a trabajar específicamente con biometría facial y de voz, características que nos permiten reconocer a alguien sin el uso de algún sensor especial y que pueden ser utilizadas en la mayoría de los teléfonos y computadoras actuales, esto con el fin de hacer más fácil su uso e instalación y así poder ampliar el campo de aplicación de la herramienta. En este caso específico se tomará como escenario de prueba un simulador o emulador de aula virtual el cual permitirá tanto el registro como el ingreso a la plataforma con la informacion biometrica.

### Pre-requisitos

Para el uso del modulo de autenticación, se hace uso de unas API (interfaz de programación de aplicaciones) las cuales reciben archivos e identifican la similitud entre cada uno de ellos. El uso de dichas plataformas tiene un periodo de prueba gratuito, en cada uno de estas platarformas es necesario crear las siguientes credenciales.

* [Amazon Web Services](https://aws.amazon.com/es/)


Es necesario crear una cuenta, inicialmente se otorga un año en la capa gratuita la cual incluye Amazon Rekognition, el cual es el servicio de reconocimiento facial, en el siguiente link esta la información para generar las credenciales [Amazon Rekognition](https://aws.amazon.com/es/rekognition/getting-started/).

* [VoiceIT](https://voiceit.io/)


Es necesario crear una cuenta, inicialmente se otorga un mes de prueba gratuita del servicio de reconocimiento de voz, una vez realizado el registro se genera automaticamente las credenciales para su uso.


### Instalación

Basta con clonar o copiar el repositorio en un servidor local y configuar dos archivos con las credenciales.

Para validar los servicios de reconocimiento facial en la carpeta App se encuentra el archivo **config.php**, se deben cambiar las siguientes variables de acuerdo a la configuración que se tenga en aws.

```
$key='XXXXXXXXX';
$secret='XXXXXXXXX';
$bucket='MyBucket';
$region='us-west-2';
```

Para el uso del modulo de autenticación por biometría de voz, se hace uso de una API (interfaz de programación de aplicaciones) la cual recibe archivos e identifica la similitud entre cada uno de ellos. El uso de dicha plataforma tiene un periodo de prueba gratuito de un mes durante el cual asigna un código único llamado developerID. Una vez obtenido dicho código es necesario incluir el mismo en el archivo **voiceIt.php** para poder ejecutar cada uno de los métodos disponibles en la plataforma

```
 $this->developerId = "XXXXXXXXX";
```

## Desarrollado con

* [Amazon Rekognition](https://aws.amazon.com/es/) - Reconocimiento Facial
* [VoiceIt](https://voiceit.io/) - Reconocimiento de voz
* [Materialize](http://materializecss.com/) - Front-end framework
* [Sweet Alert 2](https://limonte.github.io/sweetalert2/) - Alertas dinámicas en Javascript


## Autores

* **David Jurado** - [DavidFJB](https://github.com/DavidFJB)
* **Julian garcia** - [julian1303](https://github.com/julian1303)
