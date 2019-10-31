<?php
require 'control-entrada/admin.ct.php';
$fechahoy = date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php require 'include/links.php' ?>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/partidos.css">
    <title>partido</title>
</head>
<body>
    <?php require 'include/menuadmin.php'; require 'include/conexionbd.php'; 
    require 'control-entrada/control-partido.php';
    if(isset($_GET['local']) && !empty($_GET['local']) && isset($_GET['visita']) && !empty($_GET['visita'])){
        $id_local = $_GET['local'];
        $id_visita = $_GET['visita'];
        $equipo_l = "SELECT nombreEquipo, escudo FROM equipos WHERE id_equipo = '$id_local'";
        $equipo_l = $conn->query($equipo_l);
        $equipo_v = "SELECT nombreEquipo, escudo FROM equipos WHERE id_equipo = '$id_visita'";
        $equipo_v = $conn->query($equipo_v);
        $dat_equipol = $equipo_l->fetch_row();
        $dat_equipov = $equipo_v->fetch_row();        

    ?>

    <header>Partido 1 fecha: <?php echo date("d M Y") ?> </header>

    <form action="editar/editar-partidos/add-resultados.php?local=<?php echo $id_local ?>&visita=<?php echo $id_visita ?>" method="post" id='form-partido'>
        <div class="row">
            <div class="col-a5"> 
            <?php
            // mostrar jugadores del equipo local
                $jugL = $conn->prepare("SELECT id_jugador, nombreJugador, apellidosJugador FROM jugadores WHERE id_equipo_jug=?"); 
                $jugL->bind_param("i", $id_local);
                $jugL->execute();
                $jugL->bind_result($id_jugL, $nombreJugL, $apJugL);
                $_SESSION['num_jug_local'] = 0;
                $_SESSION['id_jugL'] = [];
            ?>
                <strong><img src="<?php echo $dat_equipol[1] ?>"><br> <?php echo $dat_equipol[0] ?></strong>
                <ul class='instr'><li>Jugadores</li><li>Goles</li><li>Amarilla</li><li>Roja</li></ul>
                <?php while($jugL->fetch()){
                    $_SESSION['id_jugL'][] = $id_jugL;
                    echo "<ul class='jug-dat'>
                        <li>$nombreJugL $apJugL</li>
                        <li><input type='number' name='goleslocal$id_jugL' class='golesLocal' value='0'></li>
                        <li><input type='checkbox' name='amarillalocal$id_jugL' value='$id_jugL' class='amarillalocal'></li>
                        <li><input type='checkbox' name='rojalocal$id_jugL' value='$id_jugL' class='rojalocal'></li>
                    </ul>";
                    
                    $_SESSION['num_jug_local']++;
                } 
                $jugL->close();
                ?>
             </div>
             <div class="col-a1" style="text-align: center; ">(L) VS (V)</div>
            <div class="col-a5"> 
            <?php
            // mostrar jugadores del equipo local

                $jugV = $conn->prepare("SELECT id_jugador, nombreJugador, apellidosJugador FROM jugadores WHERE id_equipo_jug=?"); 
                $jugV->bind_param("i", $id_visita);
                $jugV->execute();
                $jugV->bind_result($id_jugV, $nombreJugV, $apJugV);
                $_SESSION['num_jug_visita'] = 0;
                $_SESSION['id_jugV'] = [];
         ?>
                <strong><img src="<?php echo $dat_equipov[1] ?>"><br><?php echo $dat_equipov[0] ?></strong>
                <ul class="instr"><li>Jugadores</li><li>Goles</li><li>Amarilla</li><li>Roja</li></ul>
                <?php while($jugV->fetch()){
                    echo "<ul class='jug-dat'>
                        <li>$nombreJugV $apJugV</li>
                        <li><input type='number' name='golesvisita$id_jugV' class='golesVisita' value='0'></li>
                        <li><input type='checkbox' name='amarillavisita$id_jugV' value='$id_jugV' class='amarillavisita'></li>
                        <li><input type='checkbox' name='rojavisita$id_jugV' value='$id_jugV' class='rojavisita'></li>
                    </ul>";
                    
                    $_SESSION['num_jug_visita']++;
                    $_SESSION['id_jugV'][] = $id_jugV;
                } ?>
             </div>
        </div>
        <div class="row">

            <div class="totales col-a5">
                <div class="tot1">
                    <strong>Total: </strong>
                    <equipo><?php echo $dat_equipol[0] ?></equipo>
                    <span><span id='resultL'>0</span> - <span id='resultV'>0</span></span>
                    <equipo><?php echo $dat_equipov[0] ?></equipo>
                </div>
                <div class="tot2">
                    <span>Jugadores con amarilla del equipo local: <span id="amL">0</span></span><br>
                    <span>Jugadores con roja del equipo local: <span id="roL">0</span></span>
                </div>
                <div class="tot3">
                    <span>Jugadores con amarilla del equipo visitante: <span id="amV">0</span></span><br>
                    <span>Jugadores con roja del equipo visitante: <span id="roV">0</span></span>
                </div>        
            </div>

            <div class="col-a6" style='position: relative'>
                <input type="submit" value="Enviar datos del partido" class='pointer'>
            </div>
        </div>
    </form>

    <?php
    }
    ?>
    <?php  require 'include/footer.php'?>
    <script src="js/partidos.js"></script>
    
</body>
</html>
<?php $conn->close() ?>