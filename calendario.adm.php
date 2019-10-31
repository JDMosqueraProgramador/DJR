<?php
require 'control-entrada/admin.ct.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Deportes jesus rey</title>
    <?php require 'include/links.php' ?>
    <link rel="stylesheet" href="css/programacion.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/calendario.adm.css">
</head>
<body>
    <?php
    require "include/menuadmin.php";
    require "include/conexionbd.php";

    $cons = "SELECT * FROM equipos";
    $consult1 = $conn->query($cons);
    $consult2 = $conn->query($cons);
    ?>


    <?php
    // Eliminar partido
    if(isset($_GET['eliminar_partido']) && !empty($_GET['eliminar_partido'])){
        $id_partido_get = segF($_GET['eliminar_partido']);
        // verificar si el partido ya tiene o no un resultado
        $ver_resultado = $conn->query("SELECT * FROM resultados WHERE id_partido_res=$id_partido_get");
        if($ver_resultado->num_rows > 0){
            echo "<script>
                alert('El partido ya se ha jugado');
                window.location = '".htmlspecialchars($_SERVER['PHP_SELF'])."';
                </script>";
        }else{
            $eliminar_partido = "DELETE FROM partidos WHERE id_partido='$id_partido_get'";
            if($conn->query($eliminar_partido) == true){
                echo "<script>
                alert('el partido ha sido eliminado');
                window.location = '".htmlspecialchars($_SERVER['PHP_SELF'])."';
                </script>";
            }
        }
    }
    
    ?>


    <div class="nuev-prog" id="nuev-progr">
        <i class="fas fa-times-circle derecha" id="close-ventana"></i>
        <fieldset>
            <!-- Form - Crear nuevo partido -->
            <form method="post" id="form-ev" action="editar/editar-partidos/agg-partido.isrt.php">
                <h2>Crear Partido</h2><br>
                <label for="fecha">Fecha:</label>
                <input type="date" name="fecha" id="" style="display:none">
                <span id="ver_fecha"></span><br><br><br>
                <h3>Encuentro entre</h3><br>
                <select name="equipo1">
                    <?php
                    if($consult1->num_rows > 0){
                        while($equipo1 = $consult1->fetch_assoc()){
                            echo "<option value='".$equipo1['id_equipo']."'>" .$equipo1['nombreEquipo'] . "</option>";
                        }
                    }
                    
                    ?>
                </select>
                vs
                <select name="equipo2">
                    <?php
                    if($consult2->num_rows > 0){
                        while($equipo2 = $consult2->fetch_assoc()){
                            echo "<option value='".$equipo2['id_equipo']."'>" .$equipo2['nombreEquipo'] . "</option>";
                        }
                    }
                    
                    ?>
                    </select>
                <br><br>
                <input type="submit" value="crear" class="btn btn-large">
            </form>
        </fieldset>
    </div>

    <div id="edit_partido" class='nuev-prog'>
        <i class="fas fa-times-circle derecha" id="close-ventEdit"></i>
        <fieldset>
        <!-- Form - editar partido -->
            <form action="" method="post">
                <h2>Editar partido</h2><br>
                <label for="nuevafecha">Fecha:</label>
                <input type="date" name="nuevafecha"><br><br>
                <h3>Encuentro entre</h3><br>
                <div>
                    <div id='localMod'></div><vs>vs</vs><div id='visitaMod'></div><br><br>
                </div>
                <input type="submit" value="editar">
            </form>
        </fieldset>
    </div>
    
    <div class="pass_cal">
        <button id="preC"><i class="fas fa-arrow-left"></i></button>
        <button id="nextC"><i class="fas fa-arrow-right"></i></button>
    </div>

    <script src="js/calendario.js"></script>

    <?php
    // Seleccionar partidos porgramados
    $select_encuentros = "SELECT * FROM partidos";
    $select_encuentros = $conn->query($select_encuentros);

    while($fecha_partido = $select_encuentros->fetch_assoc()){
        $id_eq_local = $fecha_partido['id_equipoLocal'];
        $id_eq_vist = $fecha_partido['id_equipoVisitante'];
        $nombreLocal = "SELECT nombreEquipo FROM equipos WHERE id_equipo = $id_eq_local";
        $nombreVisita = "SELECT nombreEquipo FROM equipos WHERE id_equipo = $id_eq_vist";
        $nombreLocal = $conn->query($nombreLocal);
        $nombreVisita = $conn->query($nombreVisita);
        $nombreLocalF = $nombreLocal->fetch_row();
        $nombreVisitaF = $nombreVisita->fetch_row();

        // extraer cada dato de la fecha extraido
        $momentos = explode("-", $fecha_partido['fechaPartido']);   
        
        echo "<script>

        // llenar los días en los que ya hay partidos programados

        marcarFechas();
        function marcarFechas(){
            
            const mes = document.getElementsByTagName('table')[".($momentos[1]-1)."];
            let dia = mes.getElementsByTagName('td');
            for(let i = 0; i < dia.length; i++){
                if(dia[i].textContent == ".$momentos[2]."){
                    dia[i].textContent = '".$nombreLocalF[0]." vs ".$nombreVisitaF[0]."';
                    dia[i].className = 'removeEvent';
                    let basura = document.createElement('a');
                    basura.className = 'fas fa-trash';
                    basura.addEventListener('click', eliminarPartido);
                    dia[i].appendChild(basura);
                    dia[i].addEventListener('click', editarPartido);
                }
            }

            // llenar los datos para modificar el partido
            function editarPartido(){   

                const form_edit = document.getElementById('edit_partido');
                const oc_otro_evento = document.getElementById('nuev-progr');

                oc_otro_evento.style.top = '-100vh';
                form_edit.classList.add('top-o');
                document.getElementById('localMod').textContent = '".$nombreLocalF[0]."';
                document.getElementById('visitaMod').textContent = '".$nombreVisitaF[0]."';

                form_edit.getElementsByTagName('input')[0].value = '".$fecha_partido['fechaPartido']."';
                form_edit.getElementsByTagName('input')[0].min = '".date('Y-m-d')."';
                form_edit.getElementsByTagName('form')[0].setAttribute('action','editar/editar-partidos/editar-partido.php?editar_p=".$fecha_partido['id_partido']."');
                
                document.getElementById('close-ventEdit').addEventListener('click', function cerrarEdit(){
                    form_edit.classList.remove('top-o');
                });

            }

            function eliminarPartido(){
                let confirm = window.confirm('¿seguro que desea eliminar el encuentro?');
                if(confirm == true){
                    window.location = '?eliminar_partido=".$fecha_partido['id_partido']."';
                }else{
                    const form_edit = document.getElementById('edit_partido');
                    form_edit.classList.remove('top-o');
                }
            }    
        }
        
        
        </script>";
    }
    ?>

    <?php include "include/footer.php"; ?>

    <script>
    pasarCalendario();
    </script>
    <script src="js/validar_cal.js"></script>

</body>
</html>
<?php $conn->close() ?>
