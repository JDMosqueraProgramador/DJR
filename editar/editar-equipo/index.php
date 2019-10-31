<?php
    require "../../control-entrada/admin.ct.php";

    require "../../include/conexionbd.php";

    if($_GET['editar'] && !empty($_GET['editar'])){
        $id_equipo = $_GET['editar'];
        $ejc = "SELECT * FROM equipos WHERE id_equipo='$id_equipo'";
        $equipo = $conn->query($ejc);
        $ejc_j = "SELECT * FROM jugadores WHERE id_equipo_jug='$id_equipo'";
        $jugadores = $conn->query($ejc_j);
        
        if($equipo->num_rows > 0){
            while($equipoF = $equipo->fetch_assoc()){
                $nombreEquipo = $equipoF['nombreEquipo'];
                $escudoEquipo = $equipoF['escudo'];
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modificar equipo</title>
    <link rel="stylesheet" href="css/editar-equipo.css">
    <link rel="stylesheet" href="../../css/diseño.css">
    <link rel="stylesheet" href="../../css/cubo.css">
    <link rel="stylesheet" href="../../css/logins.css">
    <link rel="icon" href="../../imagenes/jesusrey.jpg">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css">
</head>
<body>
    <nav>Jesus Rey es deporte </nav>

    <form action="" method="post" style="margin-bottom: 100px">
        <h1> <img src="<?php echo "../../$escudoEquipo" ?>" width="10%" class="izquierda">Modificar equipo <img src="<?php echo "../../$escudoEquipo" ?>" width="10%" class="derecha"></h1>
        <div class="equipo-general">
            <input type="text" name="nombreEquipo" value="<?php echo $nombreEquipo ?>">
        </div>
        
        <h2>Jugadores</h2> 
        <div class="inputs-jug">
            <?php
            if($jugadores->num_rows > 0){
                while($infoJug = $jugadores->fetch_assoc()){
                    $id_jugador = $infoJug['id_jugador'];
                    echo "
                    <div>".$infoJug['nombreJugador']."</div>".
                    "<div>".$infoJug['apellidosJugador']."</div>".
                    "<div>".$infoJug['grupoJugador']."</div>

                    <div class='btn-crud edit'><a href='?editar=$id_equipo&editJug=$id_jugador'><i class='fas fa-user-edit'></i></a> </div>
                    <div class='btn-crud elim'><a href='?editar=$id_equipo&elimJug=$id_jugador'><i class='far fa-window-close'></i></a></div>";
                }
            } 

            ?>
        </div>   
        <br>
        <a id="agregar_jugador" onclick="mostrarEsaCosa()"><i class="fas fa-user-plus"></i></a>
       <br><br>
        <div class="enviar">
            <input type="submit" value="Modificar Datos" class="pointer" name="mod">
            <input type="submit" value="Modificar Datos" class="pointer" name="mod">
            <input type="submit" value="Modificar Datos" class="pointer" name="mod">
            <input type="submit" value="Modificar Datos" class="pointer" name="mod">
        </div>


    </form>

    <div class="agg" style=" top: -100vh;">
        <span class='derecha' onclick="mostrarEsaCosa()"><i class="fas fa-times-circle pointer"></i></span>
        <form action="" method="post">
            <h1>Agregar Nuevo jugador</h1>
            <input type="text" name="nombreNuevoJugador" placeholder="Nombre del jugador"><br>
            <input type="text" name="apellidosNuevoJugador" placeholder="Apellidos del jugador"><br>
            <input type="text" name="gradoNuevoJugador" placeholder="grado del jugador"><br>
            <input type="submit" value="Agregar" name="agrJug">
        </form>
    </div> 

    <footer>
        <a href="../../admin.php"><i class="fa fa-home"></i></a> 
    </footer>

    <script>
        function mostrarEsaCosa(){
            var x = document.getElementsByClassName("agg")[0];
            if(x.style.top == "-100vh"){
                x.style.top = "0";
            }else{
                x.style.top = "-100vh";
            }
        }
        </script>

    <?php
    
    if(isset($_GET['editJug']) && !empty($_GET['editJug'])){
        require 'edit_jugador.inc.php';
    }
    if(isset($_GET['elimJug']) && !empty($_GET['elimJug'])){
        require 'elim_jugador.inc.php';
    }
    if(isset($_POST['mod'])){
        require 'mod_equipo.inc.php';
    }
    if(isset($_POST['agrJug'])){
        require 'agg_jugador.inc.php';    
        
    }

    ?>
    
</body>
</html>