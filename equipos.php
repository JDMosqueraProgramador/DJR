<?php
require 'control-entrada/menu.ct.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Equipos - Deportes Jesus Rey</title>
    <?php include 'include/links.php' ?>
    <link rel="stylesheet" href="css/equipos.css">
</head>
<body>

    <?php include "include/menu.php";

    $select_equipos = "SELECT * FROM equipos";

    $equipos = $conn->query($select_equipos);

    if(!isset($_GET['equipo']) || $_GET['equipo'] == ""){

    ?>

    <div class="row">
        <div class="col-a7">

            <div class="links_equipos">
                <div class="equipoBtn">
                    Equipos participantes del torneo
                </div>

                <?php
                // verificar si ya hay equipos inscritos en el torneo
                if($equipos->num_rows > 0){
                    while($mostrar_equipos = $equipos->fetch_assoc()){
                        
                        echo "<div class='equipoBtn'>";
                        echo "<a href='?equipo=" . $mostrar_equipos['nombreEquipo'] . "'>";
                        echo "<img src='". $mostrar_equipos['escudo'] ."' class='izquierda'>";
                        echo $mostrar_equipos['nombreEquipo'];
                        echo "<img src='". $mostrar_equipos['escudo']."' class='derecha'></a>";
                        echo "</div>";
                        
                    }
                }else{
                    echo "<div class='equipoBtn _error'>";
                    echo "<span>Aún no hay equipos para mostrar</span>";
                    echo "</div>";
                }
            
                ?>

            </div>
        </div>
        <div class="col-a5">
        <!-- animación de rotación -->
            <div class="giro">
                <div class="circulo-l">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <img src="imagenes/jesusrey.jpg">
                </div>
            </div>
        </div>
    </div>

    <?php
    }
    else{
        
        $nom = htmlspecialchars($_GET['equipo']);
        $consultr = "SELECT * FROM equipos WHERE nombreEquipo='$nom'";

        $consult = $conn->query($consultr);

        // Mostrar datos de los equipos

        if($consult->num_rows > 0){
            while($mostrar_estadisticas = $consult->fetch_assoc()){
        
    ?>
        <div class="container">
            <div class="info-equipo container">
                <div class="row cabeza">
                    <div class="col-10">
                        <span class="nombreEquipo"><?php echo $mostrar_estadisticas['nombreEquipo'] ?></span>
                    </div>
                    <div class="col-2">
                        <img src="<?php echo $mostrar_estadisticas['escudo'] ?>">
                    </div>
                </div>
                <div class="row">

                    <div class="info-jugadores col-b6">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nombres</th><th>Apellidos</th><th>Grado</th><th>Faltas</th><th>Goles</th>
                                </tr>
                            </thead>
                            <tbody>
       
                    
        <?php

                    $id = $mostrar_estadisticas['id_equipo'];
                    $select_jugadores = "SELECT * FROM jugadores WHERE id_equipo_jug=$id";

                    //  Mostrar jugadores del equipo
                    $select_jugC = $conn->query($select_jugadores);
                    while($mostrar_jugadores = $select_jugC->fetch_assoc()){
                        $con_num_goles = $conn->query("SELECT sum(numeroGoles) FROM goles WHERE id_jugador_g=".$mostrar_jugadores['id_jugador']."");
                        $num_goles = $con_num_goles->fetch_row();
                        $con_sanciones = $conn->query("SELECT count(id_jugador_san) FROM sanciones WHERE id_jugador_san = ".$mostrar_jugadores['id_jugador']."");
                        $num_sanciones = $con_sanciones->fetch_row();
        ?>
                                <tr>
                                    <th> <?php echo $mostrar_jugadores['nombreJugador'] ?> </th>
                                    <th> <?php echo $mostrar_jugadores['apellidosJugador'] ?> </th>
                                    <th> <?php echo $mostrar_jugadores['grupoJugador']?></th>
                                    <th> <?php echo $num_sanciones[0] ?> </th>
                                    <th> 
                                        <?php 
                                        if(empty($num_goles[0])){
                                            echo "0";
                                        }else{
                                            echo $num_goles[0];
                                        }
                                        ?>  
                                    </th>
                                </tr>

        <?php

                    }
        ?>
                            </tbody>
                        </table>
                    </div>
                
                    <div class="col-b6">
                        
                        <section class="encuentros">
                            <h1>Programación del equipo <br><span> (Año - Mes - Dia)</span></h1>
                            <?php 

                            // Mostrar partidos programados en los que juega el equipo
                                $fecha_hoy = date('Y-m-d');
                                $encuentro = "SELECT * FROM partidos WHERE (id_equipoLocal = $id OR id_equipoVisitante = $id) AND fechaPartido >= '$fecha_hoy' ORDER BY fechaPartido ASC";
                                $encuentroQ = $conn->query($encuentro);
                                if($encuentroQ->num_rows > 0){
                                    while($most_encuentr = $encuentroQ->fetch_assoc()){

                                        $id_eq_local = $most_encuentr['id_equipoLocal'];
                                        $id_eq_vist = $most_encuentr['id_equipoVisitante'];
                                        $nombreLocal = "SELECT nombreEquipo FROM equipos WHERE id_equipo = $id_eq_local";
                                        $nombreVisita = "SELECT nombreEquipo FROM equipos WHERE id_equipo = $id_eq_vist";
                                        $nombreLocal = $conn->query($nombreLocal);
                                        $nombreVisita = $conn->query($nombreVisita);
                                        $nombreLocalF = $nombreLocal->fetch_row();
                                        $nombreVisitaF = $nombreVisita->fetch_row();

                                        echo "<d3><div>"
                                            .$most_encuentr['fechaPartido'] . 
                                            "</div> <div>". $nombreLocalF[0] ."<span> vs </span>". $nombreVisitaF[0]. "</div>
                                            </d3>";
                                    }
                                }else{
                                    echo "<div class='error'>No hay encuentros programados :[</div>";
                                }
                            ?>
                        </section>

                        <section>
                            <h1>Resultados</h1>
                            <!-- <div class='error'>El equipo no ha participado en ningún encuentro</div> -->
                        <?php

                            // Mostrar resultados de los partidos del equipo
                        
                            $resultados = $conn->query("SELECT partidos.id_equipoLocal,partidos.id_equipoVisitante,partidos.fechaPartido, resultados.golesLocal, resultados.golesVisitante FROM partidos inner join resultados on resultados.id_partido_res = partidos.id_partido WHERE (partidos.id_equipoLocal = $id OR partidos.id_equipoVisitante = $id) ORDER BY partidos.fechaPartido");

                            if($resultados->num_rows > 0){
                                while($resul = $resultados->fetch_assoc()){
                                    $idEL = $resul['id_equipoLocal'];
                                    $idEV = $resul['id_equipoVisitante'];
                                    $equipo_l_x = $conn->query("SELECT nombreEquipo FROM equipos WHERE id_equipo = '$idEL'");
                                    $equipo_v_x = $conn->query("SELECT nombreEquipo FROM equipos WHERE id_equipo = '$idEV'");

                                    $nombres_p_f_l = $equipo_l_x->fetch_row();
                                    $nombres_p_f_v = $equipo_v_x->fetch_row();

                                    echo "<div class='resultado'>
                                        <span>$nombres_p_f_l[0]</span>
                                        <div class='marcador'>
                                        <marc1>".$resul['golesLocal']."</marc1><div style='margin: 0 5px;'> - </div>
                                        <marc2>".$resul['golesVisitante']."</marc2></div>
                                        <span>$nombres_p_f_v[0]</span>
                                    </div>
                                    <fecha>".$resul['fechaPartido']."</fecha>";

                                
                                }
                            }else{
                                echo "<div class='error'>no hay resultados disponibles</div>";
                            }
                            
                        
                        ?>
                        </section>
                    </div>
                </div>
                <!-- Estadisticas del equipo -->

                <?php
                //Total de partidos jugados
                $t_part_j = "SELECT count(id_resultado) FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE partidos.id_equipoLocal = $id OR partidos.id_equipoVisitante = $id";
                $t_part_j = $conn->query($t_part_j);
                $t_j = $t_part_j->fetch_row();

                // total de victorias del equipo de Local
                $t_victoriasl = "SELECT count(resultados.id_resultado) AS nvl FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal > resultados.golesVisitante AND partidos.id_equipoLocal =" . $id;
                $t_victoriasl = $conn->query($t_victoriasl);
                $t_vl = $t_victoriasl->fetch_row();

                // total de victorias del equipo como visitante
                $t_victoriasv = "SELECT count(resultados.id_resultado) AS nvv FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal < resultados.golesVisitante AND partidos.id_equipoLocal =" . $id;
                $t_victoriasv = $conn->query($t_victoriasv);
                $t_vv = $t_victoriasv->fetch_row();

                //Numero total de victorias
                $t_vic = $t_vl[0] + $t_vv[0];

                // total de empates 
                $t_empates = "SELECT count(resultados.id_resultado) AS tmp FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal = resultados.golesVisitante AND (partidos.id_equipoLocal = $id OR partidos.id_equipoVisitante = $id)";
                $t_empates = $conn->query($t_empates);
                $t_e = $t_empates->fetch_row();

                // total de derrotas del equipo de Local
                $t_derrotasl = "SELECT count(resultados.id_resultado) AS nvl FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal < resultados.golesVisitante AND partidos.id_equipoLocal =" . $id;
                $t_derrotasl = $conn->query($t_derrotasl);
                $t_dl = $t_derrotasl->fetch_row();

                // total de derrotas del equipo como visitante
                $t_derrotasv = "SELECT count(resultados.id_resultado) AS nvv FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal > resultados.golesVisitante AND partidos.id_equipoLocal =" . $id;
                $t_derrotasv = $conn->query($t_derrotasv);
                $t_dv = $t_derrotasv->fetch_row();

                // numero total de derrotas
                $t_derr = $t_dl[0] + $t_dv[0];
                
                ?>
                <section class="estadistics">
                    <div class="t-esta">Estadisticas de <?php echo $mostrar_estadisticas['nombreEquipo']?></div>
                    <table>
                        <tr>
                            <td>Puntos:</td>
                            <th><?php echo $mostrar_estadisticas['puntos'] ?></th>
                        </tr>
                        <tr>
                            <td>Partidos Jugados:</td>
                            <th><?php echo $t_j[0] ?></th>
                        </tr>
                        <tr>
                            <td>Victorias:</td>
                            <th><?php echo $t_vic ?></th>
                        </tr>
                        <tr>
                            <td>Derrotas:</td>
                            <th><?php echo $t_derr ?></th>
                        </tr>
                        <tr>
                            <td>Empates:</td>
                            <th><?php echo $t_e[0] ?></th>
                        </tr>
                    </table>
                </section>
            </div>
        </div>

    <?php
            }
        }else{
            echo "<div style='font-size: 30px; width: 100%; height:350px ; position:relative; overflow:hidden; text-align: center'>
            <div style='position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            padding: 30px;
            box-shadow: 3px 3px 10px black;
            font-weight: 900;'>No hay equipos indentificados con este nombre</div> 
            </div>";
        }
    }

    ?>

    <?php include "include/footer.php" ?>

    <script>
        menu_2(2);
    </script>
</body>
</html>
<?php $conn->close() ?>