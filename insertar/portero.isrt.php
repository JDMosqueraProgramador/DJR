<?php

$cidp = "SELECT id_equipo FROM equipos ORDER BY id_equipo DESC LIMIT 1";
$cidp_e = $conn->query($cidp);

$num_arq = $_POST['portero'];

$insert_portero = $conn->prepare("INSERT INTO porteros (nombrePortero, apellidosPortero, gradoPortero, id_equipo_por) VALUES (?,?,?,?)");
$insert_portero->bind_param("sssi", $nombrePortero, $apellidosPortero, $gradoPortero, $id_equipo_por);
$nombrePortero = segF($_POST['nombre'.$num_arq]);
$apellidosPortero = segF($_POST['apellidos'.$num_arq]);
$gradoPortero = segF($_POST['grado'.$num_arq]);
while ($a = $cidp_e->fetch_assoc()) {
    $id_equipo_por = $a['id_equipo'];
}
$insert_portero->execute();
$insert_portero->close();

?>