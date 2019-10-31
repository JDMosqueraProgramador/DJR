<?php
require 'control-entrada/menu.ct.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include 'include/links.php' ?>
    <title>Deportes Jesus Rey</title>
</head>
<body>
    
   <?php require 'include/menu.php';?>
    
    <div class="container class sec1">
        <div class="row">
            <div class="col-c3 invisible">
                <table class="resultados-i">
                    <thead>
                        <tr><th class="th-inicio">Resultados torneo 2019<br>
                            <img src="imagenes/jesusrey.jpg" width="30px" class="circulo">
                        </th>

                        </tr>
                    </thead>
                    <tbody>
                    <?php

                    // Resultados - tabla principal
                            $resultados_generales = $conn->query('SELECT * FROM resultados LIMIT 9');

                            if($resultados_generales->num_rows > 0){
                                while($dat_resultados = $resultados_generales->fetch_assoc()){
                                    $idpartido_r = $dat_resultados['id_partido_res'];
                                    $select_partido =$conn->query("SELECT * FROM partidos WHERE id_partido =$idpartido_r");
                                    $ids_partido =$select_partido->fetch_row();
                                    $idl = $ids_partido[2];
                                    $idv = $ids_partido[3];
                                    $select_equipol = $conn->query("SELECT nombreEquipo FROM equipos WHERE id_equipo = $idl");
                                    $select_equipov = $conn->query("SELECT nombreEquipo FROM equipos WHERE id_equipo = $idv");
                                    $datos_l = $select_equipol->fetch_row();
                                    $datos_v = $select_equipov->fetch_row();

                                    echo "<tr><td class='t-inicio'><span>$datos_l[0]</span> <span class='marcador'> ".$dat_resultados['golesLocal']." - ".$dat_resultados['golesVisitante']." </span> <span>$datos_v[0]</span></td></tr>";
                                }
                            }else{
                                echo "<tr><td class='t-inicio'>Aún no hay resultados disponibles</td></tr>";
                            }
                        ?>
                        
                    </tbody>
                </table>
            </div>
            <div class="col-c5">
                <div class="" style="max-width:100%; overflow:hidden;">
                    <img class="mySlides" src="imagenes/1.jpg" style="width:100%">
                    <img class="mySlides" src="imagenes/camepones.jpg" style="width:100%">
                    <img class="mySlides" src="imagenes/interc.jpg" style="width:100%">
                    <img class="mySlides" src="imagenes/10-2.jpg" style="width:100%">
                </div>
            </div>
            <div class="col-c4 container txt-blanco" style="padding-bottom:20px;padding-top:20px;">
                <div class="text-slider">
                    <div class="titles-slider">
                        <div class="title-slides">Bienvenido a</div>
                        <div class="title-slides">Deportes </div>
                        <div class="title-slides">Jesus Rey</div>
                    </div>
                    <span class="content-slider">
                        Una nueva manera de vivir los deportes en la instutución educativa
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style='margin: 40px auto auto auto'>
        <div class="col-b5">

            <!-- Cubo -->

            <div class="wrap"> 
                <div class="cubo" id="cubo" style=" transform: rotateY(40deg) rotateX(60deg) "> 
                    <div class="delante"><img class="circulo" src="imagenes/balon-1.jpg"></div> 
                    <div class="atras"><img class="circulo" src="imagenes/balon-1.jpg"></div>
                    <div class="arriba"><img class="circulo" src="imagenes/balon-1.jpg"></div> 
                    <div class="abajo"><img class="circulo" src="imagenes/balon-1.jpg"></div> 
                    <div class="izquierdaC"><img class="circulo" src="imagenes/balon-1.jpg"></div> 
                    <div class="derechaC"><img class="circulo" src="imagenes/balon-1.jpg"></div> 
                 </div> 
             </div>
        </div>
        <div class="col-b6">
    
             <table class="t-pos">
                <thead>
                    <tr>
                        <th>Pos</th>
                        <th>Nombre de equipo</th>
                        <th>pts</th><th>Pj</th><th>V</th><th>E</th><th>D</th><th>GF</th><th>GC</th><th>DG</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    // Tabla de posiciones
                    $equipos = $conn->query('SELECT * FROM equipos ORDER BY puntos DESC, nombreEquipo ASC');
                    if($equipos->num_rows > 0){
                        
                        $posicion = 1;
                        while($dat_equipos = $equipos->fetch_assoc()){
                            $id_equipo = $dat_equipos['id_equipo'];
                            // Total de goles anotados de visitante y recibidos de local de cada equipo
                            $golesjv = "SELECT partidos.id_equipoVisitante, sum(golesVisitante) AS totalGolesV, sum(golesLocal) AS totalGolesLC FROM resultados INNER JOIN partidos ON resultados.id_partido_res = partidos.id_partido WHERE partidos.id_equipoVisitante = " .$dat_equipos['id_equipo'];

                            
                            // Total de goles anotados de local y recibidos de visitante de cada equipo
                            $golesjl = "SELECT partidos.id_equipoLocal, sum(golesLocal) AS totalGolesL, sum(golesVisitante) AS totalGolesVC FROM resultados INNER JOIN partidos ON resultados.id_partido_res = partidos.id_partido WHERE partidos.id_equipoLocal = " .$dat_equipos['id_equipo'];

                            $golesjl = $conn->query($golesjl);
                            $golesjv = $conn->query($golesjv);

                            //Total de partidos jugados
                            $t_part_j = "SELECT count(id_resultado) FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE partidos.id_equipoLocal = $id_equipo OR partidos.id_equipoVisitante = $id_equipo";
                            $t_part_j = $conn->query($t_part_j);
                            $t_j = $t_part_j->fetch_row();

                            // total de victorias del equipo de Local
                            $t_victoriasl = "SELECT count(resultados.id_resultado) AS nvl FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal > resultados.golesVisitante AND partidos.id_equipoLocal =" . $dat_equipos['id_equipo'];
                            $t_victoriasl = $conn->query($t_victoriasl);
                            $t_vl = $t_victoriasl->fetch_row();

                            // total de victorias del equipo como visitante
                            $t_victoriasv = "SELECT count(resultados.id_resultado) AS nvv FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal < resultados.golesVisitante AND partidos.id_equipoLocal =" . $dat_equipos['id_equipo'];
                            $t_victoriasv = $conn->query($t_victoriasv);
                            $t_vv = $t_victoriasv->fetch_row();

                            //Numero total de victorias
                            $t_vic = $t_vl[0] + $t_vv[0];

                            // total de empates 
                            $t_empates = "SELECT count(resultados.id_resultado) AS tmp FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal = resultados.golesVisitante AND (partidos.id_equipoLocal = $id_equipo OR partidos.id_equipoVisitante = $id_equipo)";
                            $t_empates = $conn->query($t_empates);
                            $t_e = $t_empates->fetch_row();

                            // total de derrotas del equipo de Local
                            $t_derrotasl = "SELECT count(resultados.id_resultado) AS nvl FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal < resultados.golesVisitante AND partidos.id_equipoLocal =" . $dat_equipos['id_equipo'];
                            $t_derrotasl = $conn->query($t_derrotasl);
                            $t_dl = $t_derrotasl->fetch_row();

                            // total de derrotas del equipo como visitante
                            $t_derrotasv = "SELECT count(resultados.id_resultado) AS nvv FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal > resultados.golesVisitante AND partidos.id_equipoLocal =" . $dat_equipos['id_equipo'];
                            $t_derrotasv = $conn->query($t_derrotasv);
                            $t_dv = $t_derrotasv->fetch_row();

                            // numero total de derrotas
                            $t_derr = $t_dl[0] + $t_dv[0];
                            
                            $totalgoles = 0;
                            $totalgolesc = 0;
                            if($golesjl->num_rows > 0){
                                while($res_golesl = $golesjl->fetch_assoc()){
                                    $totalgolesc += $res_golesl['totalGolesVC'];
                                    $totalgoles += $res_golesl['totalGolesL'];
                                }
                            }
                            if($golesjv->num_rows > 0){
                                while($res_golesv = $golesjv->fetch_assoc()){
                                    $totalgolesc += $res_golesv['totalGolesLC'];
                                    $totalgoles += $res_golesv['totalGolesV'];
                                }
                            }
                            echo "<tr>
                                <td>$posicion</td>
                                <td>".$dat_equipos['nombreEquipo']."</td>
                                <td>".$dat_equipos['puntos']."</td>
                                <td>$t_j[0]</td>
                                <td>$t_vic</td>
                                <td>$t_e[0]</td>
                                <td>$t_derr</td>
                                <td>$totalgoles</td>
                                <td>$totalgolesc</td>
                                <td>".($totalgoles-$totalgolesc)."</td>

                            </tr>";
                            $posicion++;
                        }
                    }else{
                        echo "<tr><td colspan='10' rowspan='15'><div style='margin: 150px 0; font-size: 20px; font-weight: 700'>No hay equipos aún en el torneo</div></td></tr>";
                    }
                    ?>
                    
                    
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <?php

        // Partido del dia
        $fecha_hoy = date("Y-m-d");
        $partido_de_hoy = $conn->query("SELECT * FROM partidos WHERE fechaPartido = '$fecha_hoy'");
        if($partido_de_hoy->num_rows > 0){
            while($datos_partido_hoy = $partido_de_hoy->fetch_assoc()){
                $idEL = $datos_partido_hoy['id_equipoLocal'];
                $idEV = $datos_partido_hoy['id_equipoVisitante'];
                $idpartido = $datos_partido_hoy['id_partido'];
                $equipo_l_x = $conn->query("SELECT nombreEquipo, escudo, id_equipo FROM equipos WHERE id_equipo = '$idEL'");
                $equipo_v_x = $conn->query("SELECT nombreEquipo, escudo, id_equipo FROM equipos WHERE id_equipo = '$idEV'");
                $equipo_l_d = $equipo_l_x->fetch_row();
                $equipo_v_d = $equipo_v_x->fetch_row();

                // Verificar si ya se han agregado los resultados del partido

                $ver_result = $conn->query("SELECT * FROM resultados WHERE id_partido_res = $idpartido");
                if($ver_result->num_rows > 0){
                    $resultados_hoy = $ver_result->fetch_row();
                    $jug_e_l = "SELECT jugadores.nombreJugador, jugadores.apellidosJugador, goles.numeroGoles FROM goles INNER JOIN jugadores ON goles.id_jugador_g = jugadores.id_jugador WHERE id_equipo_jug = $equipo_l_d[2] and id_partido_g = $idpartido";

                    $jug_e_v = "SELECT jugadores.nombreJugador, jugadores.apellidosJugador, goles.numeroGoles FROM goles INNER JOIN jugadores ON goles.id_jugador_g = jugadores.id_jugador WHERE id_equipo_jug = $equipo_v_d[2] and id_partido_g = $idpartido";

                    $jug_e_v = $conn->query( $jug_e_v);
                    $jug_e_l = $conn->query( $jug_e_l);


                    ?>

                    <!-- Resultado del día de hoy -->
                    <div class='resultado-hoyi'>
                        <div class='boxEquipo primerequipo'>
                            <div class='escudos-r'><img src='<?php echo $equipo_l_d[1] ?>' alt=''></div>
                            <div class='equipoestado'><h2><?php echo $equipo_l_d[0] ?></h2></div>
                            <div class='anotadores'>
                                <ul>
                                <?php
                                if($jug_e_l->num_rows > 0){
                                    while($anotadoresl = $jug_e_l->fetch_assoc()){
                                        echo "<li>".$anotadoresl['nombreJugador'] . " " . $anotadoresl['apellidosJugador'] . " (" . $anotadoresl['numeroGoles'].")</li>";
                                    }
                                }
                                    
                                ?>
                                </ul>
                            </div>
                        </div>

                        <div class='resultado-h'><h1><?php echo $resultados_hoy[1] ." - ". $resultados_hoy[2] ?></h1></div>
                        
                        <div class='boxEquipo segundoequipo'>
                            <div class='escudos-r'><img src='<?php echo $equipo_v_d[1] ?>' alt=''></div>
                            <div class='equipoestado'><h2><?php echo $equipo_v_d[0] ?></h2></div>
                            <div class='anotadores'>
                                <ul>
                                    <?php 
                                    if($jug_e_v->num_rows > 0){
                                        while($anotadoresv = $jug_e_v->fetch_assoc()){
                                            echo "<li>".$anotadoresv['nombreJugador'] . " " . $anotadoresv['apellidosJugador'] . " (" . $anotadoresv['numeroGoles'].")</li>";
                                        }
                                    } 
                                    
                                    ?>
                                </ul>
                            </div>
                        </div>

                    </div>
            <?php

                }else{


         ?>

         <!-- partido del dia sin resultado -->

        <div class="card-p">
            <div class="titulo">
                Partido de hoy
            </div>
            <div class="cuerpo row">
                <div class="col-4">
                    <img src="<?php echo $equipo_l_d[1] ?>" width="200px">
                </div>
                <div class="col-4">
                    <?php echo $datos_partido_hoy['fechaPartido'] ?> <br><br>
                    <div class="vs-p">vs</div><br>
                    Lorem ipsum dolor sit amet
                </div>
                
                <div class="col-4">
                    <img src="<?php echo $equipo_v_d[1]; ?>" height="200px">
                </div>
            </div>
            <div class="equipos-p row">
                <div class="col-6"><?php echo $equipo_l_d[0] ?></div> <div class="col-6"><?php echo $equipo_v_d[0] ?></div>
            </div>
        </div>
        <?php 
                }

            }
        }else{
        
            echo "<div class='card-p' style='position: relative; overflow: hidden;'>
                <div class='error'>No hay partidos programados el dia de hoy</div>
            </div>";
        }
        
        ?>

        <!-- animación tierra-balon -->
        <div class="rotation">
            <div class="tierra"></div>
            <div class="balon"></div>
        </div>
    </div>
        
    
    <?php include 'include/footer.php' ?>

    <script>
        menu_3(0);
        carousel();
    </script>
    <script>
    // interacción del usuario con el balón (cubo)
   var cubo = document.getElementById('cubo');
    
    cubo.addEventListener('mousemove', function(evt) {
            var mousePos = getMousePos(cubo, evt);
            var ancho = cubo.width/2;
            var alto = cubo.height/2;
            if(mousePos.y != alto && mousePos.x != ancho){
                cubo.style.transform = "rotateY("+ mousePos.x + "deg) rotateX(-"+ mousePos.y + "deg)";
            }
    }, false);


    function getMousePos(cubo, evt) {
        return {
          x: evt.clientX,
          y: evt.clientY
        };
      }

 
    </script>


</body>
</html>