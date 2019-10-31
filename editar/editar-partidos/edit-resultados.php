<?php
session_start();

require "../../include/conexionbd.php";
$id_partido = $_POST['id_partido'];

$eliminar_goles_anteriores = $conn->query("DELETE FROM goles WHERE id_partido_g = $id_partido");

$totalGolesLocal = 0;


for($i = 0; $i < $_POST['num_j_l']; $i++){
    $goles_local = $conn->prepare("INSERT INTO goles (id_partido_g, id_jugador_g, numeroGoles) VALUES (?,?,?)");
    $goles_local->bind_param("iii",$id_partido, $idJugL, $golesJugadorL);
    $idJugL = $_SESSION['id_jugL'][$i];

    if(!empty($_POST['goleslocal'.$idJugL]) && $_POST['goleslocal'.$idJugL] != 0 && $_POST['goleslocal'.$idJugL] != "0"){
        $golesJugadorL = segF($_POST['goleslocal'.$idJugL]);
        $goles_local->execute();
    }
    $goles_local->close();

    $totalGolesLocal += $_POST['goleslocal'. $idJugL];


}

$totalGolesVisita = 0;

for($i = 0; $i < $_POST['num_j_v']; $i++){
    $goles_visita = $conn->prepare("INSERT INTO goles (id_partido_g, id_jugador_g, numeroGoles) VALUES (?,?,?)");
    $goles_visita->bind_param("iii",$id_partido, $idJugV, $golesJugadorV);
    $idJugV = $_SESSION['id_jugV'][$i];
    if(!empty($_POST['golesvisita'.$idJugV]) && $_POST['golesvisita'.$idJugV] != 0 && $_POST['golesvisita'.$idJugV] != "0"){
        $golesJugadorV = segF($_POST['golesvisita'.$idJugV]);
        $goles_visita->execute();

    }
    $goles_visita->close();

    $totalGolesVisita += $_POST['golesvisita'.$idJugV];
}

$actualizar_resultado = $conn->query("UPDATE resultados SET golesLocal=$totalGolesLocal, golesVisitante=$totalGolesVisita WHERE id_partido_res = $id_partido");

echo "<script>
alert('el resultado del partido ha sido actualizado');
window.location = '../../resultados.adm.php';
</script>";

?>