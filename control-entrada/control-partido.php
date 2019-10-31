<?php
$select_partido_vr = $conn->prepare("SELECT * FROM partidos WHERE fechaPartido = ? AND id_equipoLocal = ? AND id_equipoVisitante = ?");
$select_partido_vr->bind_param('sss', $fechahoy, $local_verif , $visita_verif);

if(isset($_GET['local']) && isset($_GET['visita'])){

    $local_verif = segF($_GET['local']);
    $visita_verif = segF($_GET['visita']);
    
    $select_partido_vr->execute();
    $select_partido_vr->store_result();
    
    if($select_partido_vr->num_rows > 0){
        return true;
    }else{
        echo "El dia de hoy no hay partidos programados";
        echo $fd . $sd . $we . $de;
        include "include/footer.php";
        exit;
    }
}else{
    echo "no se han definido los equipos que jugarán hoy, por favor regrese al inicio e intente de nuevo";
    include "include/footer.php";
    exit;

}

$select_partido_vr->close();

?>