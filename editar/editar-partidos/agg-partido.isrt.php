<?php
if(isset($_POST['fecha']) && !empty($_POST['fecha']) && isset($_POST['equipo1']) && !empty($_POST['equipo1']) && isset($_POST['equipo2']) && !empty($_POST['equipo2'])){


    if($_POST['equipo1'] == $_POST['equipo2']){
        exit;
        header("location:../../calendario.adm.php");
    }

    require "../../include/conexionbd.php";

    $verif_partido_ex = $conn->prepare("SELECT * FROM partidos WHERE id_equipoLocal = ? AND id_equipoVisitante = ?");
    $verif_partido_ex->bind_param("ii", $_POST['equipo1'], $_POST['equipo2']);
    $verif_partido_ex->execute();
    $verif_partido_ex->store_result();

    if($verif_partido_ex->num_rows > 0){
        echo "<script> alert('el partido ya fue programado');
        window.location = window.history.back();
        </script>";
        exit;
    }
    
    $crear_partido = $conn->prepare('INSERT INTO partidos (fechaPartido, id_equipoLocal, id_equipoVisitante) VALUES (?,?,?)');
    $crear_partido->bind_param("sii", $fecha_partido, $id_local, $id_visita);
    $fecha_partido = segF($_POST['fecha']);
    $id_local = segF($_POST['equipo1']);
    $id_visita = segF($_POST['equipo2']);

    $crear_partido->execute();
    $crear_partido->close();

    echo "<script>alert('El partido ha sido creado');
    window.location = '../../calendario.adm.php';</script>";

}



?>