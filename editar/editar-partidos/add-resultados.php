<?php

session_start();

require '../../include/conexionbd.php';
$fechahoy = date("Y-m-d");
$id_equipo_local = $_GET['local'];
$id_equipo_visita = $_GET['visita'];

$sec_id_partido = $conn->prepare("SELECT id_partido FROM partidos WHERE fechaPartido = ?");
$sec_id_partido->bind_param('s', $fechahoy);
$sec_id_partido->execute();
$sec_id_partido->bind_result($id_partido);
$sec_id_partido->fetch();
$sec_id_partido->close();

require 'local-result.php';
require 'visita-result.php';

$resultado = $conn->prepare("INSERT INTO resultados (golesLocal, golesVisitante, id_partido_res) VALUES (?,?,?)");
$resultado->bind_param("iii", $totalGL, $totalGV, $id_partido);
$totalGL = $totalGolesLocal;
$totalGV = $totalGolesVisita;

$resultado->execute();
$resultado->close();

if($totalGolesLocal > $totalGolesVisita){
    $v_d_e_loc = "UPDATE equipos SET num_victorias=num_victorias+1, num_partidosJugados = num_partidosJugados+1, puntos=puntos+3 WHERE id_equipo=$id_equipo_local";
    $v_d_e_vis = "UPDATE equipos SET num_derrotas=num_derrotas+1, num_partidosJugados = num_partidosJugados+1 WHERE id_equipo=$id_equipo_visita";
}elseif($totalGolesLocal < $totalGolesVisita){
    $v_d_e_loc = "UPDATE equipos SET num_derrotas=num_derrotas+1, num_partidosJugados = num_partidosJugados+1 WHERE id_equipo=$id_equipo_local";
    $v_d_e_vis = "UPDATE equipos SET num_victorias=num_victorias+1, num_partidosJugados = num_partidosJugados+1, puntos=puntos+3 WHERE id_equipo=$id_equipo_visita";
}elseif($totalGolesLocal == $totalGolesVisita){
    $v_d_e_loc = "UPDATE equipos SET num_empates=num_empates+1, num_partidosJugados = num_partidosJugados+1, puntos=puntos+1 WHERE id_equipo=$id_equipo_local";
    $v_d_e_vis = "UPDATE equipos SET num_empates=num_empates+1, num_partidosJugados = num_partidosJugados+1, puntos=puntos+1 WHERE id_equipo=$id_equipo_visita";
}

$conn->query($v_d_e_loc);
$conn->query($v_d_e_vis);

header('location:../../index.php');

?>