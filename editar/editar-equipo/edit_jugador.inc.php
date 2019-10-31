<?php

$id_jug_ed = $_GET['editJug'];
$jug_edit = "SELECT nombreJugador, apellidosJugador, grupoJugador FROM jugadores WHERE id_jugador='$id_jug_ed'";

$jug_edit_c = $conn->query($jug_edit);

if($jug_edit_c->num_rows > 0){

    while($dat_mod = $jug_edit_c->fetch_assoc()){

        echo "
        <div class='editJugador'>
        <form action='' method='post'>
            <a class='derecha' href='index.php?editar=$id_equipo'><i class='fas fa-times-circle pointer'></i></a>
            <h1>Editar jugador</h1>
            <input type='text' name='nombreNuevo' value='".$dat_mod['nombreJugador']."'><br>
            <input type='text' name='apellidosNuevo' value='".$dat_mod['apellidosJugador']."'><br>
            <input type='text' name='grupoNuevo' value='".$dat_mod['grupoJugador']."'><br>
            <input type='submit' value='Editar Jugador' name='editar_jugador'>
        </form>
        </div>";
    }

    if(isset($_POST['editar_jugador'])){
        $editarJug = $conn->prepare("UPDATE jugadores SET nombreJugador=?, apellidosJugador=?, grupoJugador=? WHERE id_jugador=?");
        $editarJug->bind_param("sssi", $nombreAcjug, $apellidosAcjug, $grupoAcjug, $id_jug_ed);
        $nombreAcjug = segF($_POST['nombreNuevo']);
        $apellidosAcjug = segF($_POST['apellidosNuevo']);
        $grupoAcjug = segF($_POST['grupoNuevo']);
        $editarJug->execute();
        $editarJug->close();

        echo "<script>
        alert('Los datos han sido actualizados');
        window.location = 'index.php?editar=$id_equipo';
        </script>";

    }
            
        }

        ?>