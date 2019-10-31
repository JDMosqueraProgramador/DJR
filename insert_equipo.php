<?php 
session_start();

require "include/conexionbd.php";

if(!isset($_POST['nombreEquipo']) || !isset($_SESSION['num_jug'])){

    echo "<script>
    alert('No es posible acceder');
    </script>";

    header("location:index.php");

}
else{

    require "insertar/equipo.isrt.php";
    require "insertar/capitan.isrt.php";
    require "insertar/portero.isrt.php";
    require "insertar/jugadores.isrt.php";

    $insert->execute();
    $insert->close();

    
}

$conn->close();

?>