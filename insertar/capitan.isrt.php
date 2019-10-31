<?php
//Capitan

$insert_id_equipo = "SELECT id_equipo FROM equipos ORDER BY id_equipo DESC LIMIT 1";
$inst_id_equipo = $conn->query($insert_id_equipo);

$insert = $conn->prepare("INSERT INTO capitanes(correoCapitan, contrCapitan, id_equipo_cap, id_jugador_cap) VALUES (?,?,?,?)");
$insert->bind_param("ssii", $correoCapitan, $contrCapitan, $id_equipo_cap, $id_jugador_cap);

$mirar_id_jug = $conn->query("SELECT id_jugador FROM jugadores ORDER BY id_jugador DESC LIMIT 1");

if($mirar_id_jug->num_rows > 0){
    $id_cap = $mirar_id_jug->fetch_row();

    $id_jugador_cap = $id_cap[0] + 1;
}else{
    $id_jugador_cap = 1;
}

$correoCapitan = segF($_SESSION['correoj']);
$contrCapitan = password_hash($_SESSION['contrj'], PASSWORD_DEFAULT);

if($inst_id_equipo->num_rows > 0){
    while($idddd = $inst_id_equipo->fetch_assoc()){
        $id_equipo_cap = $idddd['id_equipo'];
    }
}




?>