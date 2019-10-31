<?php
require 'control-entrada/menu.ct.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php require 'include/links.php' ?>
    <link rel="stylesheet" href="css/programacion.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Programación</title>
</head>
<body>

    <?php require 'include/menu.php'; ?>

    <div id="estadisticas" class='estadisticas'>
        <span id="close"><i class='fas fa-times-circle'></i></span>
        <table>
            <thead>
                <tr> 
                <td><img src="" id='escL'><br><span id='esLocal'></span></td>
                <td>vs</td>
                <td><img src="" id='escV'><br><span id='esVisita'></span></tr> </tr>
            </thead>
            <tbody>
                <tr><td></td> <td>Puntos</td> <td></td></tr>
                <tr><td></td> <td>victorias</td> <td></td></tr>
                <tr><td></td> <td>Derrotas</td> <td></td></tr>
                <tr><td></td> <td>Empates</td> <td></td></tr>
                
            </tbody>
        </table>
    
    </div>
                                
    <div class="calendario-completo">
        <div class="pass_cal">
            <button id="preC"><i class="fas fa-arrow-left"></i></button>
            <button id="nextC"><i class="fas fa-arrow-right"></i></button>
        </div>
    </div>
           
    <script>
    // Crear calendario

       var mes_text = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    var dia_text = ['Domingo','Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];

    calen();

    function calen(){
        for(let m = 0; m <= 11; m++){
            
            let cal_com = document.getElementsByClassName('calendario-completo')[0];
            let calendario = document.createElement("div");
            calendario.className = "mes";
            cal_com.appendChild(calendario);

            let mes = document.createElement("div");
            mes.className = "t-mes";
            mes.textContent = mes_text[m];
            calendario.appendChild(mes);

            let tabla_calendario = document.createElement("table");
            tabla_calendario.className = "semanas";
            calendario.appendChild(tabla_calendario);

            let dias = document.createElement('thead');
            tabla_calendario.appendChild(dias);
            let fila = document.createElement("tr");
            dias.appendChild(fila);
            for(let i = 0; i <= dia_text.length; i++){
                let campo = document.createElement('th');
                campo.textContent = dia_text[i];
                fila.appendChild(campo);
            }
            let num_dia = document.createElement('tbody');
            tabla_calendario.appendChild(num_dia);
            for(let f = 0; f < 6; f++){
                let fila = document.createElement("tr");
                num_dia.appendChild(fila);
                for(let d = 0; d < 7; d++){
                    let campo = document.createElement('td');
                    fila.appendChild(campo);
                    let span = document.createElement('span');
                    campo.appendChild(span);
                }
            }
        }

    }

    numerar();
    
    function numerar(){
        let fecha_año = new Date();
        var año = fecha_año.getFullYear();
        for (i = 1; i < 366; i++) {
            let fecha = fechaPorDia(año, i);
            let mes = fecha.getMonth();
            let select_tabla = document.getElementsByClassName('semanas')[mes];
            let dia = fecha.getDate();
            let dia_semana = fecha.getDay();
            if (dia == 1) {var sem = 0;}
            select_tabla.children[1].children[sem].children[dia_semana].children[0].innerText = dia;
            if (dia_semana == 6) { sem = sem + 1; }
        }
    }

    function fechaPorDia(año, dia){
        var fecha = new Date(año, 0);
        return new Date(fecha.setDate(dia));
    }
       </script>

<?php
    
    $select_encuentros = "SELECT * FROM partidos";
    $select_encuentros = $conn->query($select_encuentros);

    while($fecha_partido = $select_encuentros->fetch_assoc()){
        $id_eq_local = $fecha_partido['id_equipoLocal'];
        $id_eq_vist = $fecha_partido['id_equipoVisitante'];
        $nombreLocal = "SELECT nombreEquipo, puntos, escudo FROM equipos WHERE id_equipo = $id_eq_local";
        $nombreVisita = "SELECT nombreEquipo, puntos, escudo FROM equipos WHERE id_equipo = $id_eq_vist";
        $nombreLocal = $conn->query($nombreLocal);
        $nombreVisita = $conn->query($nombreVisita);
        $nombreLocalF = $nombreLocal->fetch_row();
        $nombreVisitaF = $nombreVisita->fetch_row();
       

        /* -------------------------------------------------- *\
        \*----------------------------------------------------*/

        // total de victorias del equipo de Local << local >>
        $t_victoriasll = "SELECT count(resultados.id_resultado) AS nvl FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal > resultados.golesVisitante AND partidos.id_equipoLocal =" . $id_eq_local;
        $t_victoriasll = $conn->query($t_victoriasll);
        $tl_vl = $t_victoriasll->fetch_row();

        // total de victorias del equipo como visitante << local >>
        $t_victoriasvl = "SELECT count(resultados.id_resultado) AS nvv FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal < resultados.golesVisitante AND partidos.id_equipoLocal =" . $id_eq_local;
        $t_victoriasvl = $conn->query($t_victoriasvl);
        $tl_vv = $t_victoriasvl->fetch_row();

        //Numero total de victorias
        $tl_vic = $tl_vl[0] + $tl_vv[0];

        /* -------------------------------------------------- *\
        \*----------------------------------------------------*/

        // total de victorias del equipo de Local << visita >>
        $t_victoriaslv = "SELECT count(resultados.id_resultado) AS nvl FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal > resultados.golesVisitante AND partidos.id_equipoLocal =" . $id_eq_vist;
        $t_victoriaslv = $conn->query($t_victoriaslv);
        $tv_vl = $t_victoriaslv->fetch_row();

        // total de victorias del equipo como visitante << visita >>
        $t_victoriasvv = "SELECT count(resultados.id_resultado) AS nvv FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal < resultados.golesVisitante AND partidos.id_equipoLocal =" . $id_eq_vist;
        $t_victoriasvv = $conn->query($t_victoriasvv);
        $tv_vv = $t_victoriasvv->fetch_row();

        //Numero total de victorias
        $tv_vic = $tv_vl[0] + $tv_vv[0];

        /* -------------------------------------------------- *\
        \*----------------------------------------------------*/

        // total de empates Local
        $t_empatesl = "SELECT count(resultados.id_resultado) AS tmp FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal = resultados.golesVisitante AND (partidos.id_equipoLocal = $id_eq_local OR partidos.id_equipoVisitante = $id_eq_local)";
        $t_empatesl = $conn->query($t_empatesl);
        $tl_e = $t_empatesl->fetch_row();

         // total de empates Visitante
         $t_empatesv = "SELECT count(resultados.id_resultado) AS tmp FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal = resultados.golesVisitante AND (partidos.id_equipoLocal = $id_eq_vist OR partidos.id_equipoVisitante = $id_eq_vist)";
         $t_empatesv = $conn->query($t_empatesv);
         $tv_e = $t_empatesv->fetch_row();

        /* -------------------------------------------------- *\
        \*----------------------------------------------------*/        

        // total de derrotas del equipo de Local << local >>
        $t_derrotasll = "SELECT count(resultados.id_resultado) AS nvl FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal < resultados.golesVisitante AND partidos.id_equipoLocal = $id_eq_local";
        $t_derrotasll = $conn->query($t_derrotasll);
        $tl_dl = $t_derrotasll->fetch_row();

        // total de derrotas del equipo como visitante << local >>
        $t_derrotasvl = "SELECT count(resultados.id_resultado) AS nvv FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal > resultados.golesVisitante AND partidos.id_equipoLocal = $id_eq_local";
        $t_derrotasvl = $conn->query($t_derrotasvl);
        $tl_dv = $t_derrotasvl->fetch_row();

        // numero total de derrotas << local >>
        $tl_derr = $tl_dl[0] + $tl_dv[0];

        /* -------------------------------------------------- *\
        \*----------------------------------------------------*/
      

        // total de derrotas del equipo de Local << visita >>
        $t_derrotaslv = "SELECT count(resultados.id_resultado) AS nvl FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal < resultados.golesVisitante AND partidos.id_equipoLocal = $id_eq_vist";
        $t_derrotaslv = $conn->query($t_derrotaslv);
        $tv_dl = $t_derrotaslv->fetch_row();

        // total de derrotas del equipo como visitante << visita >>
        $t_derrotasvv = "SELECT count(resultados.id_resultado) AS nvv FROM resultados INNER JOIN partidos ON partidos.id_partido = resultados.id_partido_res WHERE resultados.golesLocal > resultados.golesVisitante AND partidos.id_equipoLocal = $id_eq_vist";
        $t_derrotasvv = $conn->query($t_derrotasvv);
        $tv_dv = $t_derrotasvv->fetch_row();

        // numero total de derrotas << visita >>
        $tv_derr = $tv_dl[0] + $tv_dv[0];

        /* -------------------------------------------------- *\
        \*----------------------------------------------------*/  


        $momentos = explode("-", $fecha_partido['fechaPartido']);   
        
        echo "<script>
        
        marcarFechas();
        function marcarFechas(){
            
            const mes = document.getElementsByTagName('table')[".($momentos[1])."];
            let dia = mes.getElementsByTagName('td');
            for(let i = 0; i < dia.length; i++){
                if(dia[i].textContent == ".$momentos[2]."){
                    let sp_partido = document.createElement('div');
                    sp_partido.className += 'partido pointer';
                    sp_partido.textContent = '".$nombreLocalF[0]." vs ".$nombreVisitaF[0]."';
                    dia[i].appendChild(sp_partido); 
                    dia[i].addEventListener('click', mostrarEst);
                    function mostrarEst(){
                        
                        var loc = document.getElementById('esLocal'), vis = document.getElementById('esVisita');
                        let escL = document.getElementById('escL'), escV = document.getElementById('escV');
                        escL.src = '$nombreLocalF[2]';
                        escV.src = '$nombreVisitaF[2]';

                        loc.textContent = '".$nombreLocalF[0]."';
                        vis.textContent = '".$nombreVisitaF[0]."';
                        
                        const est = document.getElementById('estadisticas');
                        const tbod = est.getElementsByTagName('tbody')[0];
                        var trs = tbod.getElementsByTagName('tr');
                        
                        var tds = trs[0].getElementsByTagName('td');
                        tds[0].textContent = ' $nombreLocalF[1] ';
                        tds[2].textContent = ' $nombreVisitaF[1] ';

                        var tds = trs[1].getElementsByTagName('td');
                        tds[0].textContent = ' $tl_vic ';
                        tds[2].textContent = ' $tv_vic ';

                        var tds = trs[2].getElementsByTagName('td');
                        tds[0].textContent = ' $tl_derr';
                        tds[2].textContent = ' $tv_derr ';

                        var tds = trs[3].getElementsByTagName('td');
                        tds[0].textContent = ' $tl_e[0]';
                        tds[2].textContent = ' $tv_e[0] ';
                            
                  

                        est.style.display = 'block';
                        document.getElementById('close').addEventListener('click',function cerrarEsaMonda(){
                            est.style.display = 'none';
                        });

                        document.addEventListener('click', function(e){
                            if(e.target != est){
                                est.style.display = 'none';
                            }
                        }, true);


                    }
        
                }
            } 
        }
        
        
        </script>";
    }
    ?>


<?php require 'include/footer.php' ?>
    
    <script>
        menu_2(0);
        pasarCalendario();
    </script>

</body>
</html>