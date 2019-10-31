<?php
require "control-entrada/menu.ct.php";
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
    <link rel="stylesheet" href="css/resultados.css">
</head>
<body>
<?php  require 'include/menu.php'; ?>
    <div class="container">
        <div class="row">

            <div class="resultados">
                <div class="dettorneo">
                    Torneo interclases <?php echo date("Y") ?>
                </div>

    <?php

        $resultados = "SELECT * FROM resultados";
        $resultados = $conn->query($resultados);
        if($resultados->num_rows > 0){
            while($dat_resultados = $resultados->fetch_assoc()){
                $idpartido = $dat_resultados['id_partido_res'];
                $select_partido =$conn->query("SELECT * FROM partidos WHERE id_partido =$idpartido");
                $ids_partido =$select_partido->fetch_row();
                $idl = $ids_partido[2];
                $idv = $ids_partido[3];
                $select_equipol = $conn->query("SELECT nombreEquipo, escudo FROM equipos WHERE id_equipo = $idl");
                $select_equipov = $conn->query("SELECT nombreEquipo, escudo FROM equipos WHERE id_equipo = $idv");
                $datos_l = $select_equipol->fetch_row();
                $datos_v = $select_equipov->fetch_row();

                $jug_e_l = "SELECT jugadores.nombreJugador, jugadores.apellidosJugador, goles.numeroGoles FROM goles INNER JOIN jugadores ON goles.id_jugador_g = jugadores.id_jugador WHERE id_equipo_jug = $idl and id_partido_g = $idpartido";

                $jug_e_v = "SELECT jugadores.nombreJugador, jugadores.apellidosJugador, goles.numeroGoles FROM goles INNER JOIN jugadores ON goles.id_jugador_g = jugadores.id_jugador WHERE id_equipo_jug = $idv and id_partido_g = $idpartido";

                $jug_e_v = $conn->query($jug_e_v);
                $jug_e_l = $conn->query($jug_e_l);

                echo "<div class='resultado-r'>
                <div class='equ1'>
                    <img src='$datos_l[1]'>
                    <span>$datos_l[0]</span>";


                    if($jug_e_l->num_rows > 0){
                        while($anotadoresl = $jug_e_l->fetch_assoc()){
                            echo "<div class='anot'>".$anotadoresl['nombreJugador']." ".$anotadoresl['apellidosJugador']."(".$anotadoresl['numeroGoles'].")</div>";
                        }
                    }

                echo "
                </div>
                <span class='marcador-r'>".$dat_resultados['golesLocal']." - ".$dat_resultados['golesVisitante']."</span>
                <div class='fecha-result'>$ids_partido[1]</div>

                <div class='equ2'>
                    <span>$datos_v[0]</span>
                    <img src='$datos_v[1]'> <br>";

                    if($jug_e_v->num_rows > 0){
                        while($anotadoresv = $jug_e_v->fetch_assoc()){
                            echo "<div class='anot'>".$anotadoresv['nombreJugador']." ".$anotadoresv['apellidosJugador']."(".$anotadoresv['numeroGoles'].")</div>";
                        }
                    }

                    echo "
                        </div>
                    </div>";
                
            }
        }else{
            echo "<div style='margin:30px auto; padding: 20px'>Aún no hay resultados disponibles</div>";
        }
    ?>
                
            </div>
            <div class="espacio">

                <div class="c-grande">
                    <script>
                    let cubo_g = document.getElementsByClassName('c-grande')[0];
                    for(let i = 0; i < 6; i++){
                        linea_c = document.createElement('div');
                        linea_c.className = "linea-c";
                        for(let i = 0; i < 6; i++){
                            cubo_g.appendChild(linea_c);
                            let row = document.createElement('div');
                            row.className = "row";
                            for(let i = 0; i < 6; i++){
                                linea_c.appendChild(row);
                                let cubo = document.createElement('div');
                                cubo.className = "c-peque";
                                row.appendChild(cubo);
                                for(let i = 0;i < 6; i++){
                                    let lado = document.createElement('div');
                                    lado.className = "lado";
                                    cubo.appendChild(lado);
                                }  
                            }
                        }
                        
                    }
                </script>
                <img src="imagenes/jesusrey.jpg">
                <span>Torneo 2019</span>
                </div>
            </div>
            
        </div>
    </div>


    <?php 
    require "include/footer.php";
    ?>
    <script>
    menu_2(4);
    </script>
</body>
</html>