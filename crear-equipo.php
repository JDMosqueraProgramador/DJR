<?php
require 'control-entrada/menu.ct.php';
?>
<?php

if(!isset($_SESSION['apellidosj']) || !isset($_SESSION['nombrej']) || !isset($_SESSION['correoj']) || !isset($_SESSION['contrj'])){
    
    echo "<script>
    alert('Primero debe registrarse como capitán');
    window.location = 'http://localhost/proyecto/crear-cuenta.php';
    </script>";

    exit;
}

$cont_inputs = 7;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include 'include/links.php' ?>
    <link rel="stylesheet" href="css/crear-equipo.css">
    <title>Bienvenido al equipo</title>
</head>
<body>

<nav>Jesus Rey es deporte </nav>

<?php

    $ind_inputs = "";

    if(isset($_GET['num_jug'])){
        $ind_inputs = $_GET['num_jug'];
    }
    else{
        $ind_inputs = 0;
    }
?>

<div class="mas-jugadores" id="sisisi">
    
    <span class="cerrar derecha" onclick="mostrarforminputs()"><i class="fas fa-times-circle"></i></span>
    <form action="?num_jug=<?php echo $ind_inputs ?>" method="get">
    Ingrese el numero de jugadores que desea añadir: <br><br>
    <input type="number" name="num_jug" max="5" min="1"><br><br>
    <input type="submit" value="enviar">
    </form>
</div>

<script>
    const mostrarforminputs = () => {
        document.getElementById('sisisi').classList.toggle('top-o'); 
    }
</script>

<?php


if(isset($_GET['num_jug']) && $_GET['num_jug'] == $ind_inputs){

    $cont_inputs = $cont_inputs+$ind_inputs;
}

if($ind_inputs > 5){
    $ind_inputs = 5;
}

$_SESSION['num_jug'] = $cont_inputs;

function segF($data){
    $data = htmlspecialchars($data);
    $data = trim($data);
    $data = stripslashes($data);
    return $data;
}

?>

    <fieldset>
        <form action="insert_equipo.php" method="post" enctype="multipart/form-data" id="regForm" onsubmit="return val_nombre_e()">
            <div class="row sesion1">
                <div class="col-a5 parrafo">
                    <img src="imagenes/jesusrey.jpg" width="100px" class="izquierda circleClass"><p>
                    Ahora que te has registrado como estudiante, el compromiso con la institución y de todo su personal es hacer cumplir las reglas al participar del torneo interclases llevado a cabo este año escolar. Para continuar con la inscripción, llena los campos requeridos de información general de tu equipo y comienza a vivir esta experiencia en la institución.
                    </p>
                </div>

                <div class="col-a7 row">
                    <div class="col-c6">

                        <div class="inputBox" onchange="formL(2, 0)">
                            <input type="text" name="nombreEquipo" id="nomEquipo">
                            <label for="nombreEquipo">Ingresa el nombre del equipo</label>
                        </div>
                    </div>
                    <hr style=" border: solid 1px #450797">
                    <div class="col-c5">
                        <label for="escudo" id="labes">Ahora, agrega un escudo para distinguir a tu equipo <br>
                            <i class="fas fa-image"></i>
                        </label>
                        <input type="file" name="escudo" id="escudo" style="display:none;" accept="image/png, image/jpg, image/jpeg">
                    </div>
                </div>
            </div>

            <section>

                <p> Ingresa los datos de los jugadores de tu equipo:</p>
                <div class="row">

                <div class="col-b6">
                    
                    <table class="jug-eq" id="inp_jugadores">
                        <thead><tr><td>#</td><td>Nombre</td><td>Apellidos</td><td>Grado</td><td><i class="fas fa-hand-paper"></i></td></tr></thead>
                        <tbody>

                       <tr>
                       <!-- Capitan del equipo -->
                            <td>1</td>
                            <td><input type="text" name="nombre1" value="<?php echo segF($_SESSION['nombrej']) ?>"></td>
                            <td><input type="text" name="apellidos1" value="<?php echo segF($_SESSION['apellidosj']) ?>"></td>
                            <td><input type="text" name="grado1" value="<?php echo segF($_SESSION['gradoj']) ?>" class="grado"></td>
                            <td><input type='radio' name='portero' value="1"></td>
                       </tr>
                            
                        <?php
                        
                        // Campos para demás jugadores
                        for($i = 2; $i <= $cont_inputs; $i++){
                            echo "<tr><td class='secAr'>" .$i. "</td>
                            <td><input type='text' name='nombre" .$i. "'></td> 
                            <td><input type='text' name='apellidos" .$i. "'></td> 
                            <td><input type='text' name='grado" . $i . "' class='grado' value='".$_SESSION['gradoj']."'></td>
                            <td><input type='radio' name='portero' value='$i'></td>
                            </tr>";  
                        } 

                        ?>

                        </tbody>
                    </table>

                    <script>
                        // agregar más jugadores

                        var table = document.getElementById('inp_jugadores');

                        for(let i = 0; i < tds.length; i++){
                            tds[i].addEventListener("click", function aggarquero() {
                                tds[i].textContent = "5";
                            }); 
                            if(tds[i].textContent == "5"){
                                
                            }
                        }
                        
                    
                    </script>
                    <br><br>
                    <span> Si desea agregar mas de 7 jugadores a su equipo, haga clic en el botón:</span>
                    <br><br><br>
                    <a class="btn-aggjug pointer" onclick="mostrarforminputs()">Agregar jugadores</a>
                    <br><br>

                </div>
                <div class="col-b6">
                    <div class="terminos">
                        <input type="checkbox" name="terminos">
                        <label for="terminos" style="width:90%" id="fterminos">He leído y estado de acuerdo con el reglamento implementado por la institución</label><br><br>
                    </div>
                    <input type="submit" value="Registrar equipo">
                </div>
                </div>
            </section>

            </form>
    </fieldset>

    <div class="nuev-prog pag-1" id="nuev-progr">
        <i class="fas fa-times-circle derecha" id="close-ventana" onclick="venM()"></i>
        <fieldset>
            <img src="imagenes/jesusrey.jpg" width="70px" height="70px" class="circulo"><br>
            <form action="iniciar-sesion.php" method="post" onsubmit="return formF()">
                <h2><strong> Iniciar Sesión</strong></h2><br><br>
                <div class="inputBox">
                    <input type="text" name="usuario"  id="usuario">
                    <label for="usuario" id="labelf">Correo</label>
                </div>
                <div class="inputBox">
                    <input type="password" name="contraseña" id="pass">
                    <label for="contraseña" id="labelp">Contraseña</label>
                </div>
                <div class="inputBox">
                        <select name="tipo" id="">
                            <option value="1">Administrador</option>
                            <option value="2">Estudiante</option>
                        </select>
                    </div><br>
                    <input type="submit" value="Entrar" class="btn-large">
                    <a href="Vprofesores.html" style="color:transparent">profesor</a>
            </form>
        </fieldset>
    </div>


    <footer>
        <a href="index.php"><i class="fa fa-home"></i></a> 
        <a onclick="venM()" class="pointer">Iniciar sesión</a>
        <a href="index.php" target="_blank">Reglamento</a>
    </footer>



    <script src="js/js.js"></script>
    <script src="js/validar_ce.js"></script>
    <script>
    formL(2,0);
    </script>

    <script>
    // Mostrar imagen seleccionada para el escudo
    var input_files = document.getElementById('escudo'), info_es = document.getElementById('labes');
    input_files.addEventListener('change', MostrarImagenSeleccionada);
    function MostrarImagenSeleccionada() {
        while(info_es.firstChild) {
        info_es.removeChild(info_es.firstChild);
        }

        var curFiles = input_files.files;
    if(curFiles.length === 0) {
        var para = document.createElement('span');
        para.textContent = 'No has seleccionado una foto para el escudo';
        info_es.appendChild(para);
    } else {
        var list = document.createElement('ul');
        info_es.appendChild(list);
        for(var i = 0; i < curFiles.length; i++) {
        var listItem = document.createElement('li');
        var para = document.createElement('span');
        if(validFileType(curFiles[i])) {
            para.textContent = 'escudo seleccionado: ' + curFiles[i].name ;
            var image = document.createElement('img');
            image.src = window.URL.createObjectURL(curFiles[i]);

            listItem.appendChild(image);
            listItem.appendChild(para);

        } else {
            para.textContent = 'Nombre del archivo ' + curFiles[i].name + ': El archivo seleccionado no es correspondiente.';
            listItem.appendChild(para);
        }

        list.appendChild(listItem);
        }
    }
    }

    var fileTypes = [
        'image/jpeg',
        'image/pjpeg',
        'image/png'
    ]
    
    function validFileType(file) {
        for(var i = 0; i < fileTypes.length; i++) {
        if(file.type === fileTypes[i]) {
            return true;
        }
        }
    
        return false;
    }
    </script>

</body>
</html>