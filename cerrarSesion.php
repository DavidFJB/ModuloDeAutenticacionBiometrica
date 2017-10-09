<?php
session_start();
$_SESSION["email"]=array();
$_SESSION["Admin"]=array();
$_SESSION["Rol"]=array();
session_destroy();
header("Location: index.html");


?>