<?php 

require "../../include/conexionbd.php";
if(isset($_GET['editar_p']) && !empty($_GET['editar_p']) && isset($_POST['nuevafecha']) && !empty($_POST['nuevafecha'])){
    $id_partido = segF($_GET['editar_p']);
    $ver_resultado = $conn->query("SELECT * FROM resultados WHERE id_partido_res=$id_partido");
    if($ver_resultado->num_rows > 0){
        echo "<script>
            alert('El partido ya se ha jugado');
            window.location = '../../calendario.adm.php';
            </script>";
    }else{

        $edit = $conn->prepare("UPDATE partidos SET fechaPartido=? WHERE id_partido=?"); 
        $edit->bind_param("si", $fecha_mod, $id_partido);
        
        $fecha_mod = segF($_POST['nuevafecha']);
        $edit->execute();
        $edit->close();
        
        header('location:../../calendario.adm.php');
    }
}



?>