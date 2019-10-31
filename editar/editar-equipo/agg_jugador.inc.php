<?php

if(!empty($_POST['nombreNuevoJugador']) && !empty($_POST['apellidosNuevoJugador']) && !empty($_POST['gradoNuevoJugador'])){
    $nombreJugN = segF($_POST['nombreNuevoJugador']);
    $apeJugN = segF($_POST['apellidosNuevoJugador']);
    $graJugN = segF($_POST['gradoNuevoJugador']);

    $insert = $conn->prepare("INSERT INTO jugadores(nombreJugador, apellidosJugador, grupoJugador, id_equipo_jug) VALUES (?,?,?,?)");
    $insert->bind_param("sssi", $nombreJugN, $apeJugN, $graJugN, $id_equipo);
    $insert->execute();
    $insert->close();

    echo "<script>
    alert('El jugador ha sido agregado');
    window.location = 'index.php?editar=$id_equipo';
    </script>";
}

?>