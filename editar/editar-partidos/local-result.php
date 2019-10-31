<?php 

$totalGolesLocal = 0;
for($i = 0; $i < $_SESSION['num_jug_local']; $i++){
    $goles_local = $conn->prepare("INSERT INTO goles (id_partido_g, id_jugador_g, numeroGoles) VALUES (?,?,?)");
    $goles_local->bind_param("iii",$id_partido, $idJugL, $golesJugadorL);
    $idJugL = $_SESSION['id_jugL'][$i];
    if(!empty($_POST['goleslocal'.$idJugL]) && $_POST['goleslocal'.$idJugL] != 0 && $_POST['goleslocal'.$idJugL] != "0"){
        $golesJugadorL = segF($_POST['goleslocal'.$idJugL]);
        $goles_local->execute();
    }
    $goles_local->close();

    $totalGolesLocal += $_POST['goleslocal'. $idJugL];


    $sancionesl = $conn->prepare("INSERT INTO sanciones (colorTarjeta, dobleAmarilla, id_jugador_san, id_partido_f) VALUES (?,?,?,?)");
    $sancionesl->bind_param("ssii", $colorTarjetal, $dbamarillal, $id_jug_san_l, $id_partido);

    if(isset($_POST['amarillalocal'.$idJugL]) || isset($_POST['rojalocal'.$idJugL])){
        
        $id_jug_san_l = $idJugL;
        
        if(isset($_POST['amarillalocal'.$idJugL]) && !isset($_POST['rojalocal'.$idJugL])){
            $colorTarjetal = "amarilla";
            $dbamarillal = 0;
        }elseif (!isset($_POST['amarillalocal'.$idJugL]) && isset($_POST['rojalocal'.$idJugL])) {
            $colorTarjetal = "roja";
            $dbamarillal = 0;
        }elseif (isset($_POST['amarillalocal'.$idJugL]) && isset($_POST['rojalocal'.$idJugL])) {
           $colorTarjetal = "roja";
           $dbamarillal = 1;
        }
        $sancionesl->execute();
        
    }

    $sancionesl->close();

}

?>