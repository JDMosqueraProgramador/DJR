<?php
require 'control-entrada/menu.ct.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php require 'include/links.php' ?>
    <link rel="stylesheet" href="css/posiciones.css">
    
    <title>Posiciones</title>
</head>
<body>
    
    <?php require 'include/menu.php'; ?>
    
    <div class="container">
    <table class="t-pos" style="margin: 30px;">
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

        <div class="row">
            <div class="card">
                <div class="delante active-r">
                    <div class="desempeño">Goleador</div>
                    <div class="info"><i class="fas fa-info-circle"></i></div>
                    <div class="escudo">
                        <img src="https://png.icons8.com/color/96/000000/the-premier-league.png">
                        <br> <span>Juan David Mosquera</span>
                    </div>
                    <ul class="datos">
                        <li>
                            <div class="atributo">Equipo </div>
                            <div class="valor">Los teletubbies</div>
                        </li>
                        <li>
                            <div class="atributo">Grupo</div>
                            <div class="valor">10-1</div>
                        </li>
                        <li>
                            <div class="atributo">Goles</div>
                            <div class="valor">15</div>
                        </li>
                    </ul>
                </div>
                <div class="atras">
                    <div class="go-back"><i class="fas fa-arrow-alt-circle-left"></i></div>
                    <ul class="datos">
                        <li>
                            <div class="atributo">Equipo</div>
                            <div class="valor">teletubbies</div>
                        </li>
                        <li>
                            <div class="atributo">Del grupo</div>
                            <div class="valor">10-1</div>
                        </li>
                        <li>
                            <div class="atributo">tarjetas</div>
                            <div class="valor">2</div>
                        </li>
                        <li>
                            <div class="atributo">Goles</div>
                            <div class="valor">15</div>
                        </li>
                        <li>
                            <div class="atributo">Asistencias</div>
                            <div class="valor">10</div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="delante1 active-r">
                    <div class="desempeño">Arquero menos vencido</div>
                    <div class="info1"><i class="fas fa-info-circle"></i></div>
                    <div class="escudo">
                        <img src="https://png.icons8.com/color/96/000000/the-premier-league.png">
                        <br> <span>Sebastian Rivera</span>
                    </div>
                    <ul class="datos">
                        <li>
                            <div class="atributo">par sin goles</div>
                            <div class="valor">15</div>
                        </li>
                        <li>
                            <div class="atributo">Goles</div>
                            <div class="valor">15</div>
                        </li>
                        <li>
                            <div class="atributo">Goles</div>
                            <div class="valor">15</div>
                        </li>
                    </ul>
                </div>
                <div class="atras1">
                    <div class="go-back1"><i class="fas fa-arrow-alt-circle-left"></i></div>
                    <ul class="datos">
                        <li>
                            <div class="atributo">Goles</div>
                            <div class="valor">15</div>
                        </li>
                        <li>
                            <div class="atributo">Goles</div>
                            <div class="valor">15</div>
                        </li>
                        <li>
                            <div class="atributo">Goles</div>
                            <div class="valor">15</div>
                        </li>
                        <li>
                            <div class="atributo">Goles</div>
                            <div class="valor">15</div>
                        </li>
                        <li>
                            <div class="atributo">Goles</div>
                            <div class="valor">15</div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="delante2 active-r">
                    <div class="desempeño">Mas tarjetas</div>
                    <div class="info2"><i class="fas fa-info-circle"></i></div>
                    <div class="escudo">
                        <img src="https://png.icons8.com/color/96/000000/the-premier-league.png">
                        <br> <span>Pablo Gallego Valencia</span>
                    </div>
                    <ul class="datos">
                        <li>
                            <div class="atributo">tarjetas</div>
                            <div class="valor">3</div>
                        </li>
                        <li>
                            <div class="atributo">Goles</div>
                            <div class="valor">15</div>
                        </li>
                        <li>
                            <div class="atributo">Goles</div>
                            <div class="valor">15</div>
                        </li>
                    </ul>
                </div>
                <div class="atras2">
                    <div class="go-back2"><i class="fas fa-arrow-alt-circle-left"></i></div>
                    <ul class="datos">
                        <li>
                            <div class="atributo">Goles</div>
                            <div class="valor">15</div>
                        </li>
                        <li>
                            <div class="atributo">Goles</div>
                            <div class="valor">15</div>
                        </li>
                        <li>
                            <div class="atributo">Goles</div>
                            <div class="valor">15</div>
                        </li>
                        <li>
                            <div class="atributo">Goles</div>
                            <div class="valor">15</div>
                        </li>
                        <li>
                            <div class="atributo">Goles</div>
                            <div class="valor">15</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        
    </div>


    <?php include 'include/footer.php' ?>

    <script>
        menu_2(1);
    </script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
        $('.info').click(function(){
            $('.atras').addClass('active-r')
            $('.delante').removeClass('active-r')
        })
        $('.go-back').click(function(){
            $('.atras').removeClass('active-r')
            $('.delante').addClass('active-r')
        })

        $('.info1').click(function(){
            $('.atras1').addClass('active-r')
            $('.delante1').removeClass('active-r')
        })
        $('.go-back1').click(function(){
            $('.atras1').removeClass('active-r')
            $('.delante1').addClass('active-r')
        })

        $('.info2').click(function(){
            $('.atras2').addClass('active-r')
            $('.delante2').removeClass('active-r')
        })
        $('.go-back2').click(function(){
            $('.atras2').removeClass('active-r')
            $('.delante2').addClass('active-r')
        })

    })
    </script>
    
</body>
</html>