<?php
session_start();

if(!isset($_SESSION['sesion_admin']) || empty($_SESSION['sesion_admin']) && $_SESSION['sesion_activa'] == false){

    session_destroy();
    header('location:index.php');
    exit;
}
?>