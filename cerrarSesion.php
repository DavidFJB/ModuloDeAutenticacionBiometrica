<?php
session_start();
$_SESSION["User"]=array();
$_SESSION["Admin"]=array();
$_SESSION["Contador"]=array();
$_SESSION['ContadorError']=array();
session_destroy();
header("Location: index.php");
?>