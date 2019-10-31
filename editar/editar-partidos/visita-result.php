<?php
$totalGolesVisita = 0;
for($i = 0; $i < $_SESSION['num_jug_visita']; $i++){
    $goles_visita = $conn->prepare("INSERT INTO goles (id_partido_g, id_jugador_g, numeroGoles) VALUES (?,?,?)");
    $goles_visita->bind_param("iii",$id_partido, $idJugV, $golesJugadorV);
    $idJugV = $_SESSION['id_jugV'][$i];
    if(!empty($_POST['golesvisita'.$idJugV]) && $_POST['golesvisita'.$idJugV] != 0 && $_POST['golesvisita'.$idJugV] != "0"){
        $golesJugadorV = segF($_POST['golesvisita'.$idJugV]);
        $goles_visita->execute();

    }
    $goles_visita->close();

    $totalGolesVisita += $_POST['golesvisita'.$idJugV];

    $sanciones = $conn->prepare("INSERT INTO sanciones (colorTarjeta, dobleAmarilla, id_jugador_san, id_partido_f) VALUES (?,?,?,?)");
    $sanciones->bind_param("ssii", $colorTarjeta, $dbamarilla, $id_jug_san, $id_partido);

    if(isset($_POST['amarillavisita'.$idJugV]) || isset($_POST['rojavisita'.$idJugV])){
        
        $id_jug_san = $idJugV;
        
        if(isset($_POST['amarillavisita'.$idJugV]) && !isset($_POST['rojavisita'.$idJugV])){
            $colorTarjeta = "amarilla";
            $dbamarilla = 0;
        }elseif (!isset($_POST['amarillavisita'.$idJugV]) && isset($_POST['rojavisita'.$idJugV])) {
            $colorTarjeta = "roja";
            $dbamarilla = 0;
        }elseif (isset($_POST['amarillavisita'.$idJugV]) && isset($_POST['rojavisita'.$idJugV])) {
           $colorTarjeta = "roja";
           $dbamarilla = 1;
        }
        $sanciones->execute();
        
    }

    $sanciones->close();

}

?>