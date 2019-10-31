<?php
require "control-entrada/admin.ct.php";
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
<?php  require 'include/menuadmin.php'; require 'include/conexionbd.php';?>
    <div class="resultados">
        <div class="dettorneo">
            Torneo interclases <?php echo date("Y") ?>
        </div>

    <?php
// mostrar resultados

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

                echo "<a href='?editar_p=$idpartido&local=$idl&visita=$idv'><div class='resultado-r'>
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
                    </div></a>";
                
            }
        }else{
            echo "<div style='margin:10px auto; padding: 20px'>Aún no hay resultados disponibles</div>";
        }
    ?>
                
        </div>

    <?php 
    // Editar equipos 
    if(isset($_GET['editar_p']) && isset($_GET['local']) && isset($_GET['visita'])){
        echo "<div class='editar-resultado'><form class='row' method='post' action='editar/editar-partidos/edit-resultados.php' id='form-nr'><input type='hidden' name='id_partido' value='".$_GET['editar_p']."'>";
        $jugadoresl = $conn->query("SELECT * FROM jugadores WHERE id_equipo_jug = ".$_GET['local'].""); 
        $jugadoresv = $conn->query("SELECT * FROM jugadores WHERE id_equipo_jug = ".$_GET['visita'].""); 
        
        $_SESSION['id_jugL'] = [];
        $num_jug_l = $num_jug_v = 0;
        echo "<div class='col-a5'><h1>" . $datos_l[0] . "</h1><br>";
        while($jugl = $jugadoresl->fetch_assoc()){
            $idslocales = $jugl['id_jugador'];
            $jugg_e_l = $conn->query("SELECT * FROM goles WHERE id_jugador_g = ".$jugl['id_jugador']." AND id_partido_g = ".$_GET['editar_p']);
            $numGl = $jugg_e_l->fetch_row();
            if($numGl[3] != null){
                $numgolesl = $numGl[3];
            }else{
                $numgolesl = 0;
            }
            echo "<div class='ejr'><div>".$jugl['nombreJugador']. " " .$jugl['apellidosJugador']."</div><input type='number' value='$numgolesl' name='goleslocal$idslocales' class='ngl'></div>";
            $_SESSION['id_jugL'][] = $idslocales;
            $num_jug_l++;
        }
        echo "<input type='hidden' value='$num_jug_l' name='num_j_l'>";

        $result = $conn->query("SELECT * FROM resultados WHERE id_partido_res = ".$_GET['editar_p']);
        $resultr = $result->fetch_assoc();

        // Resultado Anterior

        echo "</div>
        <div class='col-a2' style='text-align: center'><br>
        ".$resultr['golesLocal']." - ".$resultr['golesVisitante']."<br><br>
        Partido de la fecha:
        $ids_partido[1]</div>";
        
        $_SESSION['id_jugV'] = [];
        echo "<div class='col-a5' style='text-align: right'><h1>$datos_v[0]</h1><br>";
        while($jugv = $jugadoresv->fetch_assoc()){
            $idsvisita = $jugv['id_jugador'];
            $jugg_e_v = $conn->query("SELECT * FROM goles WHERE id_jugador_g = ".$jugv['id_jugador']." AND id_partido_g = ".$_GET['editar_p']);
            $numGv = $jugg_e_v->fetch_row();
            if($numGv[3] != null){
                $numgolesv = $numGv[3];
            }else{
                $numgolesv = 0;
            }
            echo "<div class='ejr'><input type='number' value='$numgolesv' name='golesvisita$idsvisita' value='0' class='ngv'><div>".$jugv['nombreJugador']. " " .$jugv['apellidosJugador']."</div></div>";
            $_SESSION['id_jugV'][] = $idsvisita;

            $num_jug_v++;
        }
        echo "<input type='hidden' value='$num_jug_v' name='num_j_v'></div>";

        echo "<div class='n-m'>Nuevo Marcador:  <span id='rl'></span> - <span id='rv'></span></div> <div class='butt'><input type='submit' value='Modificar Resultado'></div>";

        echo "</form></div>"; 
    }
    
    ?>

    <?php 
    require "include/footer.php";
    ?>

<script>
    const form_nr = id('form-nr');
    var newgolesl = form_nr.getElementsByClassName('ngl');
    var totall = totalv = 0;
    for(let i = 0; i < newgolesl.length; i++){
        newgolesl[i].addEventListener('keyup', function(){
            if(this.value != ""){
                totall += parseInt(this.value); 
                id('rl').textContent = totall;
            }else{
                form_nr.addEventListener('change', function(e){
                    e.preventDefault();
                    newgolesl[i].style.borderColor = 'red';
                    return false;
                });
            }
        });
    }

    var newgolesv = form_nr.getElementsByClassName('ngv');

    for(let i = 0; i < newgolesv.length; i++){
        newgolesv[i].addEventListener('change', function(){
            if(this.value != ""){
                totalv += parseInt(this.value); 
                id('rv').textContent = totalv;
            }else{
                form_nr.addEventListener('submit', function(e){
                    e.preventDefault();
                    newgolesv[i].style.borderColor = 'red';
                    return false;
                });
            }
        });
    }



</script>

</body>
</html>