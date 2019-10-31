<?php

if(isset($_GET['eliminar']) && $_GET['eliminar'] != ""){

    $elim = $_GET['eliminar'];

    // eliminar escudo
    $escudo = "SELECT escudo FROM equipos WHERE id_equipo=$elim";
    $escudo_ej = $conn->query($escudo);
    $dir_escudo = $escudo_ej->fetch_row();
    $elim_escudo = unlink($dir_escudo[0]);
    if($elim_escudo == false){
        die();
    }

    // eliminar equipo
    $eliminar = "DELETE FROM equipos WHERE id_equipo=$elim";
    $ejec_elim = $conn->query($eliminar);
    
    if($ejec_elim == false){
        echo "<script>alert('No es posible eliminar al equipo')</script>";
    }else{
        echo "<script>
        alert('El equipo ha sido borrado del torneo');
        window.location = 'admin.php';
        </script>";
    }

}

?>