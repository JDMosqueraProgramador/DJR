    
    <script>
    document.addEventListener('DOMContentLoaded', function(){
        var load = document.getElementById('loader');
        load.style.display = "none";
    });

    </script>

    <div class="preload" id="loader">
        <div class="bolita"></div>
    </div>
    <nav>
        <div class="container">
            <div class="nav-logo row">
                <img src="imagenes/jesusrey.jpg" alt="" class="circulo logo">
                <h1 class="text-logo title-nav pointer">
                <span>D</span><span class="hidden">e</span><span class="hidden">p</span><span class="hidden">o</span><span class="hidden">r</span><span class="hidden">t</span><span class="hidden">e</span><span class="hidden">s</span><span> </span><span>j</span><span class="hidden">e</span><span class="hidden">s</span><span class="hidden">u</span><span class="hidden">s</span><span> </span><span>r</span><span class="hidden">e</span><span class="hidden">y</span></h1>
            </div>
            <div class="derecha">
                <div class="menuR">
                    <a href=""><i class="far fa-futbol"></i></a>
                    <a onclick="venM()" style="cursor: pointer;">iniciar sesión</a>
                    <a href="javascript:void(0);" class="" onclick="myFunction()"><i class="fa fa-bars"></i></a>
                </div>
                <ul class="row menu1 derecha">
                    <li><a href="">Documentación</a></li>
                    <li><a href="">Externo</a></li>
                    <li><a onclick="venM()" style="cursor: pointer;">Iniciar sesión</a></li>
                </ul>
            </div>
        </div>    

        <div id="menuF">
            <div class="menu2" id="MenuResponsive">
                <div class="container">
                    <ul class="row" id="menu2">
                        <li><a href="programacion.php">Programación</a></li>
                        <li><a href="posiciones.php"> Tabla de posiciones</a></li>
                        <li><a href="equipos.php"> Equipos</a></li>
                        <li><a href="sanciones.php"> Sanciones</a></li>
                        <li><a href="resultados.php"> Resultados</a></li>
                        <li class="res-add"><a href="">Documentación</a></li>
                        <li class="res-add"><a href="">Inventario</a></li>
                        <li class="res-add"><a href="crear-cuenta.php">Crear Cuenta</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="otro-menu container invisible-a" id="menu3">
            <a href="index.php">Inicio</a>
            <a href="quienes-somos.php">Quienes somos</a>
            <!-- <a href="">Responsables</a> -->
            <a href="crear-cuenta.php" class="derecha"><i class="fas fa-users"></i>Crear cuenta</a>
            <a onclick="mcal()" class="derecha pointer">Calendario</a>

            <ul class="calendario" id="calendario">
                    <h1 class="ti-cal">Proximos encuentros</h1>
                    <?php
                    $fecha_hoy = date('Y-m-d');
                    require 'include/conexionbd.php';
                    $select_encuentros = "SELECT * FROM partidos WHERE fechaPartido >= '$fecha_hoy' ORDER BY fechaPartido ASC LIMIT 5";
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
                
                        $momentos = explode("-", $fecha_partido['fechaPartido']); 

                        echo "<li>
                        <div class='fecha-c'>
                        <h3>$momentos[1]<br><span>$momentos[2]</span></h3>
                        </div>
                        <a href='programacion.php'>$nombreLocalF[0] vs $nombreVisitaF[0]</a>
                        </li>";
                    }
                    ?>
                    <!-- <li><div class="fecha-c"><h3>Mes<br><span>00</span></h3></div><a href="programacion.php">Equipo 1 vs Equipo 2</a></li>
                    <li><div class="fecha-c"><h3>Mes<br><span>00</span></h3></div><a href="programacion.php">Equipo 1 vs Equipo 2</a></li>
                    <li><div class="fecha-c"><h3>Mes<br><span>00</span></h3></div><a href="programacion.php">Equipo 1 vs Equipo 2</a></li>
                    <li><div class="fecha-c"><h3>Mes<br><span>00</span></h3></div><a href="programacion.php">Equipo 1 vs Equipo 2</a></li>
                    <li><div class="fecha-c"><h3>Mes<br><span>00</span></h3></div><a href="programacion.php">Equipo 1 vs Equipo 2</a></li> -->
                </ul>
        </div>
    </nav>

    <div class="nuev-prog pag-1" id="nuev-progr">
        <i class="fas fa-times-circle derecha" id="close-ventana" onclick="venM()"></i>
        <fieldset>
            <img src="imagenes/jesusrey.jpg" width="70px" height="70px" class="circulo"><br>
            <form action="iniciar-sesion.php" method="post" onsubmit="return formF()" id="iniciar-sesion">
                <h2><strong> Iniciar Sesión</strong></h2><br><br>
                <div class="inputBox" onchange="return formL(0,0)">
                    <input type="text" name="usuario"  id="usuario">
                    <label for="usuario" id="labelf">Correo</label>
                </div>
                <div class="inputBox" onchange="return formL(1,1)">
                    <input type="password" name="contraseña" id="pass">
                    <label for="contraseña" id="labelp">Contraseña</label>
                </div>
                <div class="inputBox">
                        <select name="tipo" id="tipo">
                            <option value="1">Profesor</option>
                            <option value="2">Estudiante</option>
                        </select>
                    </div><br>
                    <input type="submit" value="Entrar" class="btn-large" id='btn-env'>
            </form>
        </fieldset>
    </div>

    <script>
        // document.getElementById('btn-env').addEventListener('click', function(){
        //     var inputUsuario = document.getElementById('usuario');
        //     var inputPass = document.getElementById('pass');
        //     var selectCargo = document.getElementById('tipo');
        //     alert(inputPass.value + "  " + inputUsuario.value);

        //     if(inputPass.value == ""){
        //         inputPass.style.borderBottomColor = "red";
        //     }else{
        //         inputPass.style.borderBottomColor = "#450797";
        //     }

        //     if(inputUsuario.value == ""){
        //         inputUsuario.style.borderBottomColor = "red";
        //     }else{
        //         inputUsuario.style.borderBottomColor = "#450797";
        //     }

        //     if(inputPass.value != "" && inputUsuario.value != ""){
        //         http = new XMLHttpRequest;
                
        //         http.addEventListener('readystatechange', function(){

        //             if(this.readyState == 4 && this.status == 200){
        //                 var data = JSON.parse(this.responseText);
        //                 console.log(data);
        //             }
        //         });
        //         http.open('POST','iniciar-sesion.php', true);
        //         http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        //         http.send("usuario="+inputUsuario.value+"&contraseña="+inputPass.value+"&tipo="+selectCargo.value);

        //     }

        // });

    
    </script>