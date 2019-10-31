<?php

$id_jug_elim = $_GET['elimJug'];
$delete_jugador = "DELETE FROM jugadores WHERE id_jugador='$id_jug_elim'";
if($conn->query($delete_jugador) == true){
    echo "<script>
    alert('el jugador ha sido eliminado');
    window.location = 'index.php?editar=$id_equipo';
    </script>";
}

?>