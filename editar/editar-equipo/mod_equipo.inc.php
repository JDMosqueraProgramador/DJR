<?php 

$nombreEquipoNuevo = $_POST['nombreEquipo'];
$consult_nomE = $conn->prepare("UPDATE equipos SET nombreEquipo=? WHERE id_equipo=?");
$consult_nomE->bind_param("si", $nombreEquipoNuevo, $id_equipo);
$consult_nomE->execute();
$consult_nomE->close();

echo "<script>
alert('El nombre del equipo ha sido actualizado');
window.location = 'index.php?editar=$id_equipo';
</script>";

?>