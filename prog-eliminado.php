
<head>
    <link rel="stylesheet" href="css/diseño.css">
    <link rel="stylesheet" href="css/cubo.css">
    <link rel="stylesheet" href="css/logins.css">
<style>
.card-p{
    max-width: 600px;
    text-align: center;
    border: solid 1px gainsboro;
    border-radius: 20px;
    justify-content: center;
    margin: 20px auto 20px auto;
    background: rgba(216, 214, 214, 0.568);
    z-index: 1;
}
.card-p .row{
    margin: 0 !important;
    font-weight: 600;
}

.card-p .titulo{
    border-top-right-radius: 20px;
    border-top-left-radius: 20px;
    padding: 20px;
    font-weight: 600;
    transition: 0.5s;
    position: relative;
    overflow: hidden;
    background: transparent;
}

.card-p .titulo::before{
    content: "";
    width: 100%;
    height: 0;
    background: #270355;
    position: absolute;
    top: 0;
    left: 0;
    z-index: -1;
    transition: 0.8s;
}

.vs-p{
    width: 40px;
    border-radius: 100%;
    background: #270355;
    padding: 10px;
    margin: auto;
    color: #fff;
    font-size: 20px;
}
.cuerpo{
    position: relative;
    overflow: hidden;
}

.cuerpo::before{
    content: "";
    bottom: 0;
    left: 0;
    background: #fff;
    position: absolute;
    width: 100%;
    height: 0;
    z-index: -1;
}
.cuerpo .col-4:nth-child(2){
    font-weight: 600;
    padding-top: 5%;
}

.equipos-p div{
    padding: 20px;
    font-weight: 600;
}

.equipos-p div:last-child{
    border-bottom-right-radius: 20px;
    transition: 1s;
    position: relative;
    overflow: hidden;
}

.equipos-p div:last-child::before{
    content: "";
    top: 0;
    right: 0;
    position: absolute;
    height: 100%;
    width: 0;
    z-index: -1;
    background: linear-gradient(#ffdd00, #1f649e);
    transform-origin: right;
    transition: 0.8s;
}

.equipos-p div:first-child{
    border-bottom-left-radius: 20px;
    transition: 1s;
    position: relative;
    overflow: hidden;
}

.equipos-p div:first-child::before{
    content: "";
    top: 0;
    left: 0;
    position: absolute;
    height: 100%;
    width: 0;
    z-index: -1;
    background: linear-gradient(white, red);
    transform-origin: right;
    transition: 0.8s;
   
}

/* hover */

.card-p:hover .titulo{
    color: #fff;
}
.card-p:hover .titulo::before{
    height: 100%;
    transition: 0.8s;
}

.card-p:hover .equipos-p div:first-child{
    color: #fff;
}

.card-p:hover .cuerpo::before{
    height: 100%;
    transition: 0.8s;
}

.card-p:hover .equipos-p div:first-child::before, .card-p:hover .equipos-p div:last-child::before{
    width: 100%;
}

.tabla-partidos{
    margin: auto;
    box-shadow: -5px -3px 10px rgba(219, 218, 218, 0.904);
    max-width: 650px;
    border-radius: 30px;
    padding: 30px;
    border-right: solid 1px rgba(173, 172, 172, 0.904);
    border-left: solid 1px rgba(173, 172, 172, 0.904);
    margin-top: 30px;
}


.linea{
    text-align: center;
}

.linea img{
    margin-right: 5px;
    margin-top: 2px;
}
.linea:first-child{
    border-top-left-radius: 30px;
    border-top-right-radius: 30px;
}

.linea:last-child{
    border-bottom-left-radius: 30px;
    border-bottom-right-radius: 30px; 
}

.fecha{
    margin: 0;
}



/* Rotación */

.rotation{
    width: 200px;
    height: 200px;
    margin: 200px auto;
    position: relative;
    padding: 60px;
    box-sizing: initial;
    background: transparent;
    z-index: -2;
}

.tierra{
    width: 200px;
    height: 200px;
    background: url(imagenes/tierra.png);
    background-size: cover;
    border-radius: 50%;
}

.balon{
    width: 60px;
    height: 60px;
    background: url(imagenes/balon-fondo.jpg);
    background-size: cover;
    position: absolute;
    border-radius: 50%;
    top: 0;
    left: 0;
    box-shadow: 20px 20px 10px 2px #000000cc;
    animation: ro 4s infinite;
}

@keyframes ro{
    50%{
        left:  calc(100% - 60px);
        top: calc(100% - 60px);
    }
    100%{
        z-index: -1;
    }
}


.ver{
    width: 100%;
    border: none;
    position: relative;
    overflow: hidden;
    outline: none;
}
.ver:hover{
    background: none;
    color: #651f9e;
}
.ver::before{
    content: "";
    width: 40%;
    height: 2px;
    background: rgb(117, 10, 204);
    position: absolute;
    left: 0;
    top: 15px;
    z-index: -1;
}

.ver::after{
    content: "";
    width: 40%;
    height: 2px;
    background: rgb(117, 10, 204);
    position: absolute;
    right: 0;
    top: 15px;
    z-index: -1;
}


.pro-c{
    height: 0;
    opacity: 0;
}
.pro-c div{
    opacity: 0;
    z-index: -100;
    position: absolute;
    
}

.h-0{
    opacity: initial;
    height: fit-content;
}

.h-0 div{
    height: auto !important;
    width: auto !important;
    z-index: initial;
    opacity: initial;
    position: initial;
}

</style>
</head>
<body>
    
    
    <div class="nuev-prog pag-1" id="nuev-progr">
        <i class="fas fa-times-circle derecha" id="close-ventana" onclick="venM()"></i>
        <fieldset>
            <img src="imagenes/jesusrey.jpg" width="70px" height="70px" class="circulo"><br>
            <form action="" onsubmit="return formF()"  onmousemove="return labelA()">
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
    
    <div class="row">
        
        <div class="card-p">
            <div class="titulo">
                Partido de hoy
            </div>
            <div class="cuerpo row">
                <div class="col-4">
                    <img src="imagenes/river.png" width="200px">
                </div>
                <div class="col-4">
                    enero 1 de 2019 <br><br>
                    <div class="vs-p">vs</div><br>
                    Lorem ipsum dolor sit amet
                </div>
                
                <div class="col-4">
                    <img src="imagenes/boca.png" height="200px">
                </div>
            </div>
            <div class="equipos-p row">
                <div class="col-6">River</div> <div class="col-6">Boca</div>
            </div>
        </div>
        
        <div class="card-p">
            <div class="titulo">
                Partido de mañana
            </div>
            <div class="cuerpo row">
                <div class="col-4">
                    <img src="imagenes/river.png" width="200px">
                </div>
                <div class="col-4">
                    enero 2 de 2019 <br><br>
                <div class="vs-p">vs</div><br>
                Lorem ipsum dolor sit amet
            </div>
            
            <div class="col-4">
                <img src="imagenes/boca.png" height="200px">
            </div>
        </div>
            <div class="equipos-p row">
                <div class="col-6">River</div> <div class="col-6">Boca</div>
            </div>
        </div>
        
    </div>
    
    
    <div class="row">
        <div class="col-b6">
            <div class="tabla-partidos">
                <div class="title-tabla linea">
                    <span><strong>Partidos de la Semana</strong></span>
                    <span class="derecha"><img src="imagenes/jesusrey.jpg" width="25px" height="25px" class="circulo"></span>
                </div>
                <div class="title linea">
                    <a href="partidos.html">
                        <span class="equipos izquierda">Equipo 1</span>
                        <span class="vs izquierda">vs</span>
                        <span class="equipos izquierda">Equipo 2</span>
                        <span class="fecha">d/m/a</span>
                        <span class="derecha invisible-a"><i class="fas fa-arrow-right"></i></span>
                        <span class="derecha btn btn-tp invisible-a">Ir al partido</span>
                    </a>
                </div>
                <div class="title linea">
                    <a href="partidos.html">
                        <span class="equipos izquierda">Equipo 1</span>
                        <span class="vs izquierda">vs</span>
                        <span class="equipos izquierda">Equipo 2</span>
                        <span class="fecha">d/m/a</span>
                        <span class="derecha invisible-a"><i class="fas fa-arrow-right"></i></span>
                        <span class="derecha btn btn-tp invisible-a">Ir al partido</span>
                    </a>
                </div>
                <div class="title linea">
                    <a href="partidos.html">
                        <span class="equipos izquierda">Equipo 1</span>
                        <span class="vs izquierda">vs</span>
                        <span class="equipos izquierda">Equipo 2</span>
                        <span class="fecha">d/m/a</span>
                        <span class="derecha invisible-a"><i class="fas fa-arrow-right"></i></span>
                        <span class="derecha btn btn-tp invisible-a">Ir al partido</span>
                    </a>
                </div>
                <div class="title linea">
                    <a href="partidos.html">
                        <span class="equipos izquierda">Equipo 1</span>
                        <span class="vs izquierda">vs</span>
                        <span class="equipos izquierda">Equipo 2</span>
                        <span class="fecha">d/m/a</span>
                        <span class="derecha invisible-a"><i class="fas fa-arrow-right"></i></span>
                        <span class="derecha btn btn-tp invisible-a">Ir al partido</span>
                    </a>
                </div>
                <div class="title linea">
                    <a href="partidos.html">
                        <span class="equipos izquierda">Equipo 1</span>
                        <span class="vs izquierda">vs</span>
                        <span class="equipos izquierda">Equipo 2</span>
                        <span class="fecha">d/m/a</span>
                        <span class="derecha invisible-a"><i class="fas fa-arrow-right"></i></span>
                        <span class="derecha btn btn-tp invisible-a">Ir al partido</span>
                    </a>
                </div>
            </div>

            
            <div class="tabla-partidos">
                <div class="title-tabla linea">
                    <span><strong>Semana entrante</strong></span>
                    <span class="derecha"><img src="imagenes/jesusrey.jpg" width="25px" height="25px" class="circulo"></span>
                </div>
                <div class="title linea">
                    <a href="partidos.html">
                        <span class="equipos izquierda">Equipo 1</span>
                        <span class="vs izquierda">vs</span>
                        <span class="equipos izquierda">Equipo 2</span>
                        <span class="fecha">d/m/a</span>
                        <span class="derecha invisible-a"><i class="fas fa-arrow-right"></i></span>
                        <span class="derecha btn btn-tp invisible-a">Ir al partido</span>
                    </a>
                </div>
                <div class="title linea">
                    <a href="partidos.html">
                        <span class="equipos izquierda">Equipo 1</span>
                        <span class="vs izquierda">vs</span>
                        <span class="equipos izquierda">Equipo 2</span>
                        <span class="fecha">d/m/a</span>
                        <span class="derecha invisible-a"><i class="fas fa-arrow-right"></i></span>
                        <span class="derecha btn btn-tp invisible-a">Ir al partido</span>
                    </a>
                </div>
                <div class="title linea">
                    <a href="partidos.html">
                        <span class="equipos izquierda">Equipo 1</span>
                        <span class="vs izquierda">vs</span>
                        <span class="equipos izquierda">Equipo 2</span>
                        <span class="fecha">d/m/a</span>
                        <span class="derecha invisible-a"><i class="fas fa-arrow-right"></i></span>
                        <span class="derecha btn btn-tp invisible-a">Ir al partido</span>
                    </a>
                </div>
                <div class="title linea">
                    <a href="partidos.html">
                        <span class="equipos izquierda">Equipo 1</span>
                        <span class="vs izquierda">vs</span>
                        <span class="equipos izquierda">Equipo 2</span>
                        <span class="fecha">d/m/a</span>
                        <span class="derecha invisible-a"><i class="fas fa-arrow-right"></i></span>
                        <span class="derecha btn btn-tp invisible-a">Ir al partido</span>
                    </a>
                </div>
                <div class="title linea">
                    <a href="partidos.html">
                        <span class="equipos izquierda">Equipo 1</span>
                        <span class="vs izquierda">vs</span>
                        <span class="equipos izquierda">Equipo 2</span>
                        <span class="fecha">d/m/a</span>
                        <span class="derecha invisible-a"><i class="fas fa-arrow-right"></i></span>
                        <span class="derecha btn btn-tp invisible-a">Ir al partido</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-b6">
            
        </div>
    </div>
    
    <button class="btn ver" id="but" onclick="proc()">ver Programación completa</button>
    
    <div class="pro-c" id="progr"> 
        <div class="tabla-partidos">
            <div class="title-tabla linea">
                <span><strong>Semana entrante</strong></span>
                <span class="derecha"><img src="imagenes/jesusrey.jpg" width="25px" height="25px" class="circulo"></span>
            </div>
            <div class="title linea">
                <a href="partidos.html">
                    <span class="equipos izquierda">Equipo 1</span>
                    <span class="vs izquierda">vs</span>
                    <span class="equipos izquierda">Equipo 2</span>
                    <span class="fecha">d/m/a</span>
                    <span class="derecha invisible-a"><i class="fas fa-arrow-right"></i></span>
                    <span class="derecha btn btn-tp invisible-a">Ir al partido</span>
                </a>
            </div>
            <div class="title linea">
                <a href="partidos.html">
                    <span class="equipos izquierda">Equipo 1</span>
                    <span class="vs izquierda">vs</span>
                    <span class="equipos izquierda">Equipo 2</span>
                    <span class="fecha">d/m/a</span>
                    <span class="derecha invisible-a"><i class="fas fa-arrow-right"></i></span>
                    <span class="derecha btn btn-tp invisible-a">Ir al partido</span>
                </a>
            </div>
            <div class="title linea">
                <a href="partidos.html">
                    <span class="equipos izquierda">Equipo 1</span>
                    <span class="vs izquierda">vs</span>
                    <span class="equipos izquierda">Equipo 2</span>
                    <span class="fecha">d/m/a</span>
                    <span class="derecha invisible-a"><i class="fas fa-arrow-right"></i></span>
                    <span class="derecha btn btn-tp invisible-a">Ir al partido</span>
                </a>
            </div>
            <div class="title linea">
                <a href="partidos.html">
                    <span class="equipos izquierda">Equipo 1</span>
                    <span class="vs izquierda">vs</span>
                    <span class="equipos izquierda">Equipo 2</span>
                    <span class="fecha">d/m/a</span>
                    <span class="derecha invisible-a"><i class="fas fa-arrow-right"></i></span>
                    <span class="derecha btn btn-tp invisible-a">Ir al partido</span>
                </a>
            </div>
            <div class="title linea">
                <a href="partidos.html">
                    <span class="equipos izquierda">Equipo 1</span>
                    <span class="vs izquierda">vs</span>
                    <span class="equipos izquierda">Equipo 2</span>
                    <span class="fecha">d/m/a</span>
                    <span class="derecha invisible-a"><i class="fas fa-arrow-right"></i></span>
                    <span class="derecha btn btn-tp invisible-a">Ir al partido</span>
                </a>
            </div>
        </div>
    </div>
</body>