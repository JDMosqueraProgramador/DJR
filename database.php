<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/diseño.css">
    <title>Mi primer Database</title>
</head>
<body>
    <?php
    $servername = "localhost";
    $usuario = "root";
    $contraseña = "0000";
    $bdname = "mybd";
    
    $conbd = new mysqli($servername, $usuario, $contraseña, $bdname);

    if($conbd->connect_error){
        echo "no se pudo conectar con la base de datos";
    }
    else{
        echo "conectada exitosamente<br>";
    }

    // $create_table = "CREATE TABLE posiciones (
    //     EquipoiD INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    //     NombreEquipo VARCHAR(30) NOT NULL,
    //     PartidosJugados INT(6),
    //     Puntos VARCHAR(30)
    // )";

    

    // if($conbd->query($create_table) == true){
    //     echo "tabla creada<br>";
    // }

    $prepare = $conbd->prepare("INSERT INTO posiciones (NombreEquipo, PartidosJugados, Puntos) VALUES (?,?,?)");
    $prepare->bind_param("sis", $nombre, $num_part, $puntos);
 
    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $nombre = $_POST['nombre'];
        $num_part += $_POST['num_part'];
        $puntos += $_POST['puntos'];
        $prepare->execute();
    }
    
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <input type="text" name="nombre" id="">
    <input type="text" name="num_part" id="">
    <input type="text" name="puntos" id="">
    <input type="submit" value="enviar">
    </form>


    <?php

    $daf = "UPDATE posiciones SET NombreEquipo='Arsenal' WHERE EquipoiD=3 ";

    if($conbd->query($daf) == true ){
        echo "alv";
    }

    $mostrar = "SELECT * FROM posiciones";

    $datos = $conbd->query($mostrar);


    if($datos->num_rows > 0){
        $x = 0;
        echo "<table class='t-pos'><tr><th>Posicion</th><th>Nombre</th><th>Partidos jugados</th><th>Puntos</th></tr>";
        while($row = $datos->fetch_assoc()){
            $x++;
            echo "<tr><td>". $x ."</td><td>". $row['NombreEquipo'] ."</td>" . "<td>". $row['PartidosJugados'] ."</td>" ."<td>". $row['Puntos'] ."</td></tr>";
        }
        echo "</table>";
    }








    $conbd->close();
    $prepare->close();
    
    ?>

    <form action="programacion.php" method="post">
        <input type="text" name="nombre" >
        <input type="radio" name="estudio" value="Futbol">
        <input type="radio" name="estudio" value="Basquet">
        <input type="radio" name="estudio" value="voley">
        <input type="submit" value="enviar">
    </form>
</body>
</html>