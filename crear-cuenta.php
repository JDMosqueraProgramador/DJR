<?php
require 'control-entrada/menu.ct.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Cuenta</title>
    <?php include 'include/links.php' ?>
    <link rel="stylesheet" href="css/crear-cuenta.css">
</head>
<body>
<?php 
include "include/menu.php";
?> 

        <form action="control-entrada/verificar.php" method="post" id="c-c" onsubmit="return validar()">
            <h1>Crear Cuenta</h1><br><br>
            <div class="inputBox" onchange="return formL(3,2)" id="boxinput">
                <input type="text" name="nombre" id="idnombre">
                <label for="nombre" id="labelf">Nombre</label>
            </div>
            <div class="inputBox" onchange="return formL(4,3)">
                <input type="text" name="apellidos">
                <label for="apellidos" id="labelf">Apellidos</label>
            </div>
            <div class="inputBox" onchange="return formL(5,4)">
                <input type="text" name="correo">
                <label for="coreo" id="labelf">Correo</label>
            </div>
            <div class="inputBox" onchange="return formL(6,5)">
                <input type="password" name="password" id="password">
                <span class="mostrarC" id="omostrar" onclick="mostrarC()"><i class="fas fa-eye-slash"></i></span>
                <label for="password" id="labelp">Contraseña</label>
            </div>

            <input type="radio" name="cargo" id="estudiante" value="estudiante">
            <label for="cargo">Estudiante</label><br>
            <input type="radio" name="cargo" id="profesor" value="profesor">
            <label for="cargo">Profesor</label>


            <div class="errores" id="errores">
            <div class="alert"></div>
            <div class="alert"></div>
            <div class="alert"></div>
            <div class="alert"></div>
            <div class="alert"></div>

            </div>

            <div class="form-text">
                <h3>¡Aviso importante!</h3><br>
                Recuerda que solo los encargados de manejar el sistema escolar de juegos interclases pueden ingresar como administradores, también cabe recordar que las inscripciones de planilla tienen un tiempo limitado. 
            </div>
            <div class="form-estu" >
                <h2>Información extra</h2><br><br>
                <div class="inputBox" onchange="return formL(9,8)">
                    <select name="grado" class='select-grado'>
                        <option value="">Selecciona el grupo que cursas</option>
                        <option value="8-1">8-1</option>
                        <option value="8-2">8-2</option>
                        <option value="8-3">8-3</option>
                        <option value="8-4">8-4</option>
                        <option value="9-1">9-1</option>
                        <option value="9-2">9-2</option>
                        <option value="9-3">9-3</option>
                        <option value="9-4">9-4</option>
                        <option value="10-1">10-1</option>
                        <option value="10-2">10-2</option>
                        <option value="10-3">10-3</option>
                        <option value="10-4">10-4</option>
                        <option value="11-1">11-1</option>
                        <option value="11-2">11-2</option>
                        <option value="11-3">11-3</option>
                        <option value="11-4">11-4</option>
                    </select>
                    <label for="grado">grado</label>
                    <span class="alert"></span>
                </div>
                <br>

                <div class="submit">
                <input type="submit" value="enviar">
                <input type="submit" value="enviar">
                <input type="submit" value="enviar">
                <input type="submit" value="enviar">
            </div>
            </div><br><br>
            <div style="height: 30px">
                <div class="submit" style="height: 0">
                    <input type="submit" value="enviar">
                    <input type="submit" value="enviar">
                    <input type="submit" value="enviar">
                    <input type="submit" value="enviar">
                </div>
            </div>
        </form>



<?php
include "include/footer.php";
?>

<script>
    menu_3(3);
    
    formL(3,2);
    formL(4,3);
    formL(5,4);
    formL(6,5);
    formL(9,8);
    
</script>

<script src="js/validar_cc.js"></script>

<script>

 // mostrar y ocultar contraseña

function mostrarC(){
    var sclick = document.getElementById('omostrar');
    var cambiar = document.getElementById('password');
    var ojo = sclick.getElementsByTagName('i')[0];
    if(cambiar.type == "password"){
        cambiar.type = "text";
        ojo.classList.remove('fa-eye-slash');
        ojo.classList.add('fa-eye');
    }

    else if(cambiar.type == "text"){
        cambiar.type = "password";
        ojo.classList.remove('fa-eye');
        ojo.classList.add('fa-eye-slash');
    }
}
</script>

    
</body>
</html>