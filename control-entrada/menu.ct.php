<?php
    session_start();

    if(isset($_SESSION['sesion_admin']) && !empty($_SESSION['sesion_admin']) && $_SESSION['sesion_activa'] == true){
        header('location:admin.php');
        exit;
    }elseif(isset($_SESSION['sesion_usu']) && !empty($_SESSION['sesion_usu']) && $_SESSION['sesion_activa'] == true){
        header('location:capitan.php');
        exit();
    }
    
?>