<?php

session_start();

require "include/conexionbd.php";
$correo = $_POST['usuario'];
    $contr = $_POST['contraseña'];

    // verificar si el usuario es administrador
if($_POST['tipo'] == 1){
    
    $consult_session = "SELECT id_admin, correoAdmin, contrAdmin FROM administradores WHERE correoAdmin='$correo'";
    $cont_corr = $conn->query($consult_session);
    if($cont_corr->num_rows > 0){
        while($data = $cont_corr->fetch_assoc()){

            if(password_verify($contr, $data['contrAdmin'])){
                $_SESSION['sesion_admin'] = $data['correoAdmin'];
                $_SESSION['sesion_activa'] = true;
                header("location:admin.php");
            }else{
                $data = [0,"la contraseña es equivocada"];

                $data = json_encode($data);

                echo $data;
            }
        }
    }else{
        // echo "<script>alert('el nombre de usuario está equivocado'); window.location = history.back();</script>";

        $data = [1,"el usuario es incorrecto"];

        $data = json_encode($data);

        echo $data;
    }


}else{
    $consult_session = "SELECT * FROM capitanes WHERE correoCapitan='$correo'";
    $cont_corr = $conn->query($consult_session);
    if($cont_corr->num_rows > 0){
        while($data = $cont_corr->fetch_assoc()){

            if(password_verify($contr, $data['contrCapitan'])){
                $_SESSION['sesion_usu'] = $data['correoCapitan'];
                $_SESSION['sesion_activa'] = true;
                header("location:capitan.php");
            }else{
                // echo "<script>alert('La contraseña es incorrecta'); window.location = history.back();</script>";
                $data = [1,"la contraseña es equivocada"];

                $data = json_encode($data);

                echo $data;
            }
        }
    }else{
        // echo "<script>alert('el nombre de usuario está equivocado'); window.location = history.back();</script>";
        $data = [0,"el usuario es incorrecto"];

        $data = json_encode($data);

        echo $data;
    }
}

?>

        