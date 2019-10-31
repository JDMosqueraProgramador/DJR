<?php
    require 'control-entrada/admin.ct.php';
    require "include/conexionbd.php";
    $mostrar_equipos = "SELECT id_equipo, nombreEquipo FROM equipos ORDER BY nombreEquipo DESC";
    $consult = $conn->query($mostrar_equipos);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Deportes jesus rey</title>
    <?php require 'include/links.php' ?>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <?php 
    require "include/menuadmin.php";
    // mostrar datos de administrador
    $correo_admin = $_SESSION['sesion_admin'];
    $dat_admin = "SELECT * FROM administradores WHERE correoAdmin='$correo_admin'";
    $dat_admin = $conn->query($dat_admin);
    $data_admin = $dat_admin->fetch_row();
    ?>

    

    <section>
        <div class="col-11" style="margin: auto">
            <h2>Administrador <?php echo $data_admin[1] . " " . $data_admin[2]; ?></h2><hr>
        </div>

        <div class="row">
            <div class="col-a6">
                <div class="edit_equipos">
                    <?php
                    // Crud - equipos del torneo
                    if($consult->num_rows > 0){
                       
                        echo "<div class='titulo'>Equipos del torneo</div>";
                        while($guardar_datos = $consult->fetch_assoc()){
                                
                            echo "<div class='equipo_crud'>";
                            echo "<span>". $guardar_datos['nombreEquipo'] . "</span>";
                            echo "<a class='editar derecha' href='editar/editar-equipo/?editar=".$guardar_datos['id_equipo'] ." '>editar</a>
                            <a class='eliminar derecha' onclick='alerta_delete()'>eliminar</a>
                            </div><br>";

                            echo "<script>
                            function alerta_delete(){
                                let alert = window.confirm('¿Seguro que desea borrar el equipo?');
                                if(alert == true){
                                    window.location = '?eliminar=".$guardar_datos['id_equipo']."';
                                }
                            }
                            </script>";
                        }
                    }
                    else{
                        echo "<h1>Aun no hay equipos en el torneo</h1>";
                    }
                    ?>

                    <?php
                    if(isset($_GET['eliminar']) && !empty($_GET['eliminar'])){

                        include "editar/editar-equipo/eliminar_equipo.php";
        
                    }
                    
                    ?>
                </div>
            </div>
            <div class="col-a6">
                
                    
                <?php
                // verificar si hay partidos programados este dia
                $fecha_hoy = date("Y-m-d");
                $partido = "SELECT * FROM partidos WHERE fechaPartido = '$fecha_hoy'";
                $partido = $conn->query($partido);
                if($partido->num_rows > 0){
                    while($ids_equipos = $partido->fetch_assoc()){
                        
                        $id_local = $ids_equipos['id_equipoLocal'];
                        $id_visita = $ids_equipos['id_equipoVisitante'];
                        $nombre_y_escudoL = "SELECT id_equipo, nombreEquipo, escudo FROM equipos WHERE id_equipo = '$id_local'";
                        $nombre_y_escudoV = "SELECT id_equipo, nombreEquipo, escudo FROM equipos WHERE id_equipo = '$id_visita'";
                        $nombre_y_escudoL = $conn->query($nombre_y_escudoL);
                        $nombre_y_escudoV = $conn->query($nombre_y_escudoV);

                        $mostrar_l = $nombre_y_escudoL->fetch_row();
                        $mostrar_v = $nombre_y_escudoV->fetch_row();

                        // verificar si el partido de este dia ya tiene resultado
                        $ver_result = $conn->query("SELECT * FROM resultados WHERE id_partido_res = ".$ids_equipos['id_partido']."");
                        if($ver_result->num_rows > 0){
                            $resultados = $ver_result->fetch_row();
                            echo "<div class='text-tt'>Resultado de partido de hoy</div>
                            <div class='btns_torneo'>
                                <div class='resultado-hoy'>
                                <img src='$mostrar_l[2]' class='izquierda' width='30px'>
                                <img src='$mostrar_v[2]' class='derecha' width='30px'>
                                
                                <span class='equipo'>$mostrar_l[1]</span> 
                                <span class='vs circulo'>$resultados[1] - $resultados[2]</span>
                                <span class='equipo'>$mostrar_v[1]</span>
                                </div>
                            </div>";
                        }else{

                ?>
                <!-- Vinculo para agregar resultado al partido de este dia -->
                    <div class="btns_torneo">
                        <div>
                            <img src="<?php echo $mostrar_l[2]; ?>" class="izquierda" width="30px">
                            <img src="<?php echo $mostrar_v[2]; ?>" class="derecha" width="30px">
                            
                            <span><?php echo $mostrar_l[1]; ?></span> 
                            <span class="vs circulo">vs</span>
                            <span><?php echo $mostrar_v[1]; ?></span><br>

                            <a class="btn-admin" href="partidos.adm.php?local=<?php echo $mostrar_l[0] . "&visita=" . $mostrar_v[0]?>">Empezar partido de hoy</a><br>

                            <fecha><?php echo $fecha_hoy; ?></fecha><br>
                        </div>
                    </div>

                <?php
                        }
                    }
                }else{
                    echo "<div class='error'>No hay partidos programados para hoy</div>";
                }
                ?>

                <?php
                // Mostrar partidos programados que no fueron jugados

                $partidos_aplazar = $conn->query("SELECT id_partido, id_equipoLocal, id_equipoVisitante, fechaPartido FROM partidos WHERE fechaPartido < '$fecha_hoy' ORDER BY fechaPartido ASC");
                if($partidos_aplazar->num_rows > 0){
                    echo "<div class='text-tt'>partidos no jugados que deben ser aplazados:</div>";
                    while($ids = $partidos_aplazar->fetch_row()){
                        $ver_par = $conn->query("SELECT * FROM resultados WHERE id_partido_res=$ids[0]");
                        if($ver_par->num_rows <= 0){
                            $nombreLocal = $conn->query("SELECT nombreEquipo FROM equipos WHERE id_equipo = $ids[1]");
                            $nombreVisita =$conn->query( "SELECT nombreEquipo FROM equipos WHERE id_equipo = $ids[2]");

                            $nombreLocalF = $nombreLocal->fetch_row();
                            $nombreVisitaF = $nombreVisita->fetch_row();
                            echo "<div class='partido-aplazar'>
                            <span class='equipo'>{$nombreLocalF[0]}</span> <vs class='vs circulo'>vs</vs><span class='equipo'> {$nombreVisitaF[0]} </span>
                            <fecha>{$ids[3]}</fecha>
                            </div>";
                        }
                    }
                    
                }
                
                ?>

                
            </div>
        </div>
        
    </section>

    <?php include "include/footer.php"; ?>

    <?php
    // if(isset($_REQUEST['empezar-torneo'])){
    //     echo "<div>
    //     <form action='" . htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
    //         <h2>Fecha final de inscripciones</h2>
    //         <input type='date' name='fecha-inscripciones'>
    //     </form>
    //     </div>";
    // }
    ?>
    
</body>
</html>
<?php $conn->close() ?>