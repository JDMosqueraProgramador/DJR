<?php
require 'control-entrada/menu.ct.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php require "include/links.php"; ?>
    <link rel="stylesheet" href="css/sanciones.css">
    <title>Sanciones</title>
</head>
<body>
    <?php
    include "include/menu.php";
    ?>
    <section class="container">
        <h1>Jugadores Sancionados</h1>
        <div class="auto-center">
    
        <?php 
        $sanc = "SELECT jugadores.nombreJugador, jugadores.apellidosJugador, sanciones.id_partido_f, equipos.nombreEquipo FROM jugadores INNER JOIN sanciones ON jugadores.id_jugador = sanciones.id_jugador_san INNER JOIN equipos ON equipos.id_equipo = jugadores.id_equipo_jug";
        $sanc_c = $conn->query($sanc);
        if($sanc_c->num_rows > 0){
            while($datos_jugador = $sanc_c->fetch_assoc()){
            
        ?>
            <div class="sancionado"  ondratagable='true'>
                <div class="info_san">
                    <span><?php echo $datos_jugador['nombreJugador'] . " " . $datos_jugador['apellidosJugador'] ?></span> 
                </div>
                <div class="escudo">
                    <img src="imagenes/boca.png">
                </div> 
                <div class="inform">
                    <table>
                        <tr><td>Sanción:</td><td>Tarjeta Amarilla</td></tr>
                        <tr><td>Equipo:</td><td><?php echo $datos_jugador['nombreEquipo'] ?></td></tr>
                        <tr><td>Fecha</td><td><?php echo $datos_jugador['id_partido_san'] ?></td></tr>
                        <tr><td>Partido:</td><td>Once dos vs Once uno</td></tr>
                    </table>
                </div>
            </div>
        <?php
            }
        }else{
            echo "<div style='width: 100%; height: 300px; text-align: center;'>Aún no se registra ninguna sanción</div>";
        }
        ?>
        </div>
    </section>
    <?php include "include/footer.php"; ?>
    <script>
    menu_2(3);
    </script>
    
</body>
</html>

<?php
$conn->close();
?>