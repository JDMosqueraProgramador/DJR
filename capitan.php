<?php
session_start();

if(!isset($_SESSION['sesion_usu']) || empty($_SESSION['sesion_usu'])){
    header('location:index.php');
    exit();
    
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include 'include/links.php'; ?>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/equipos.css">
    <title>Deportes Jesus Rey</title>
</head>
<body>
   <?php require 'include/menucap.php'; require 'include/conexionbd.php';?>

<div class="info-jugadores col-b6">
    <div class="auto-center">
        <h2>Jugadores del equipo</h2>
    </div>
    <table>
        <thead>
            <tr>
                <th>Nombres</th><th>Apellidos</th><th>Grado</th><th>Faltas</th><th>Goles</th>
            </tr>
        </thead>

<?php

$id_equipo_c = $conn->query("SELECT id_equipo_cap FROM capitanes WHERE correoCapitan='".$_SESSION['sesion_usu']."'");
$id_equipo = $id_equipo_c->fetch_row();
$select_jugadores = "SELECT * FROM jugadores WHERE id_equipo_jug=$id_equipo[0]";

$select_jugC = $conn->query($select_jugadores);
while($mostrar_jugadores = $select_jugC->fetch_assoc()){
    $con_num_goles = $conn->query("SELECT sum(numeroGoles) FROM goles WHERE id_jugador_g=".$mostrar_jugadores['id_jugador']."");
    $num_goles = $con_num_goles->fetch_row();
    $con_sanciones = $conn->query("SELECT count(id_jugador_san) FROM sanciones WHERE id_jugador_san = ".$mostrar_jugadores['id_jugador']."");
    $num_sanciones = $con_sanciones->fetch_row();
?>
        <tbody>
            <tr>
                <th> <?php echo $mostrar_jugadores['nombreJugador'] ?> </th>
                <th> <?php echo $mostrar_jugadores['apellidosJugador'] ?> </th>
                <th> <?php echo $mostrar_jugadores['grupoJugador']?></th>
                <th> <?php echo $num_sanciones[0] ?> </th>
                <th> 
                    <?php 
                    if(empty($num_goles[0])){
                        echo "0";
                    }else{
                        echo $num_goles[0];
                    }
                    ?>  
                </th>
            </tr>
        </tbody>
<?php
}
?>

    </table>
</div>

   <?php require 'include/footer.php'; ?>

</body>
</html>