<?php 
// Jugadores

    $cpie = "SELECT id_equipo FROM equipos ORDER BY id_equipo DESC LIMIT 1";
    $cpie_e = $conn->query($cpie);
    

    $consult_j = $conn->prepare("INSERT INTO jugadores(nombreJugador, apellidosJugador, grupoJugador, id_equipo_jug) values (?,?,?,?)");
    $consult_j->bind_param('sssi', $nombreJug, $apJug, $gradoJug, $id_equipo);

    if($cpie_e->num_rows > 0){
        while($id_equipo_f = $cpie_e->fetch_assoc()){
            $id_equipo = $id_equipo_f['id_equipo'];
        }
    }

    for($i = 1; $i <= $_SESSION['num_jug']; $i++){

        $nombreJug = segF($_POST['nombre'.$i]);
        $apJug = segF($_POST['apellidos'.$i]);
        $gradoJug = segF($_POST['grado'.$i]);
        
        $consult_j->execute();
    }
    $consult_j->close();

    header("location:equipos.php?equipo=".$nombreEquipo);

    ?>