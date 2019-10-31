<?php
//Equipo
    $nombreEquipoV = $_POST['nombreEquipo'];
    $verif_nomEquipo = "SELECT nombreEquipo FROM equipos WHERE nombreEquipo='$nombreEquipoV'";
    $verif_nomEquipoConn = $conn->query($verif_nomEquipo); 
    if($verif_nomEquipoConn->num_rows != 0){
        echo "El nombre del equipo ya ha sido seleccionado";
        die();
    }

    
    function insert_escudo(){
        $dirr = "escudos/";
        $file = $dirr . basename($_FILES['escudo']['name']);
        $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        $ver = getimagesize($_FILES['escudo']['tmp_name']);

        try{
            if($ver != true){
                throw new Exception("No es posible aceptar el archivo, por favor cambie el logo de su equipo");
            }elseif($extension != "png" && $extension != "jpg" && $extension != "jpeg"){
                throw new Exception("La extensión del achivo no es de imagen");
            }
        } catch (Exception $th) {
            echo $th->getMessage();
            die();
        }

        if(move_uploaded_file($_FILES['escudo']['tmp_name'], $file) === true){
            rename($file,"escudos/".$_POST['nombreEquipo'].".png");
        }
    }
    insert_escudo();
    

    $consult_e = $conn->prepare("INSERT INTO equipos(nombreEquipo, escudo) values (?,?)");
    $consult_e->bind_param("ss",$nombreEquipo, $escudo);
    $nombreEquipo = segF($_POST['nombreEquipo']);
    $escudo = "escudos/".$_POST['nombreEquipo'].".png";
    $consult_e->execute();
    $consult_e->close();

    ?>
