<?php
function manejarErrores($nivel_error, $mensaje_error){
    echo "<b>Error:</b> [$nivel_error] $mensaje_error";
    die();
}

?>

<a href="subr.php?id=1">pues mis insectos andan en la calle y sabemos en el carro que tu andas </a>

    <?php
    $servidor = "localhost";
    $usuario = "root";
    $contraseña = "0000";
    $base_de_datos = "mybd";

    $conbd = new mysqli($servidor, $usuario, $contraseña, $base_de_datos);

    if($conbd->connect_error){
        echo "no se puede extablecer la conexión sql";
    }
    else{
        echo "conexión establecida";
    }

    /* $crear_tabla = "CREATE TABLE DiezUno (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(30) NOT NULL,
        apellidos VARCHAR(30) NOT NULL,
        grado VARCHAR(30) NOT NULL,
        goles VARCHAR(30) NOT NULL
    )";

    if($conbd->query($crear_tabla) === true){
        echo "<br> la tabla fue creada exitosamente y esta aprendiendo de una forma buena";
    }
    else{
        echo "<br> la tabla no fue creada, sigue intentando";
    } */

    // $añadir_datos = "INSERT INTO Diezuno (nombre, apellidos, grado, goles)
    //  VALUES ('Juan David', 'Mosquera Muñoz', '10-1', '16');";
    
    // $añadir_datos .="INSERT INTO DiezUno (nombre, apellidos, grado, goles)
    // VALUES ('Sebastían', 'Rivera Cardona', '10-1', '0')";

    // if($conbd->multi_query($añadir_datos) === true){
    //     echo "<br>datos cargados exitosamente";
    // }
    // else{
    //     echo "<br>datos no cargados :c vos sos capaz prro";
    // }

    // preparando declaraciones

    $prep = $conbd->prepare("INSERT INTO diezuno (nombre, apellidos, grado, goles) VALUES (?,?,?,?)");
    $prep->bind_param("sssi", $nombre, $apellidos, $grado, $goles);

    // $nombre = "Juan Pablo";
    // $apellidos = "Gallego Valencia";
    // $grado = "10-1";
    // $goles = "7";
    // $prep->execute();

    // $nombre = "Brandon";
    // $apellidos = "Patiño Gutierrez";
    // $grado = "10-3";
    // $goles = "8";
    // $prep->execute();

    $_GET['id'] = 1;

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>subir fotico</title>
    <script>
    var inputa = document.getElementById('foto');
    var validate = document.querySelector('div');

    inputa.addEventListener('change', MostrarImagenSeleccionada);

    function MostrarImagenSeleccionada(){
        
        var xd = inputa.files;
        
        for(i = 0; i < xd.length; i++){
            var image = document.createElement('img');
            image.src = window.URL.createObjectURL(xd[i]);
            
            var body = document.querySelector('body');
            
            validate.appendChild(image);
        }
    }
        
    </script>
</head>



<body>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
<input type="text" name="nombre" id="nombre">
<input type="file" name="foto" id="foto">
<input type="submit" value="enviar">
</form>
<div></div>

<?php
    // $nombre = "Alejandro";
    // $apellidos = "Quintero Charlotk";
    // $grado = "10-1";
    // $goles = "9";
    // $prep->execute();

    // $nombre = "Brandon";
    // $apellidos = "Patiño Gutierrez";
    // $grado = "10-3";
    // $goles = "8";
    // $prep->execute();

    $sobrescribir = "UPDATE diezuno SET apellidos='Velez Correa' WHERE id=2";

    IF($conbd->query($sobrescribir) == true){
        echo "El campo de apellidos ha sido actualizado <br>";
    }

    $select = "SELECT nombre, goles FROM diezuno";

    $guardatos = $conbd->query($select);

    // $borrar = "DELETE FROM diezuno WHERE id=6";

    // if($conbd->query($borrar) == true){
    //     echo "borrado";
    // }

    $cambiar_id = "UPDATE diezuno SET id='5' WHERE id=7";

    if($conbd->query($cambiar_id) == true){
        echo "id de alejandro es correcto";
    }

    if($guardatos->num_rows > 0){
        while($row = $guardatos->fetch_assoc()){
            echo "El jugador " . $row['nombre'] . " ha anotado ". $row['goles']. " goles en el torneo <br>";
        }
    }
    

    $nombre = "Sebastian";
    $apellidos = "Rivera Cardona";
    $grado = "10-1";
    $goles = "0";
    $prep->execute(); 




    $prep->close();
    $conbd->close();
?>


<?php

set_error_handler("manejarErrores");

if($_SERVER['REQUEST_METHOD'] == "POST"){

    mkdir($_POST['nombre'], 0777) or die("no se pudo crear la carpeta");

    if(file_exists($_POST['nombre'])){

    }

    $carpeta =  $_POST['nombre']."/";
    $direccion = $carpeta . basename($_FILES['foto']['name']);
    $cont = 1;
    $tipo_de_imagen = strtolower(pathinfo($direccion, PATHINFO_EXTENSION));
    
    if(isset($_POST['submit'])){
        $verificar = setimagesize($_FILES['foto']['tmp_name']);
        
        if($verificar !== true){
            echo "la carga de la imagen corre bien <br>";
            $cont = 1;
        }
        else{
            echo "la imagen presentará problemas en la carga <br>";
            $cont = 0;
        }
        
    }
    
    if(file_exists($direccion)){
        $cont = 0;
        echo "ya existe esa joda <br>";
    }
    
    if($tipo_de_imagen != "png" && $tipo_de_imagen != "jpg" && $tipo_de_imagen != "gif" && $tipo_de_imagen != "jpeg"){
        $cont = 0;
        echo "el archivo que intentas subir, no es una imagen <br>";
    }
    
    if($cont == 0){
        echo "la imgen no se pudo subir <br>";
    }else{
        if(move_uploaded_file($_FILES['foto']['tmp_name'], $direccion)){
            echo "la imagen fue subida con exito";
        }
    }
    
}

    
?>

    <img src="<?php echo $direccion ?>" alt="">




</body>
</html>