<?php

    session_start();

    if(!isset($_POST['nombre']) || !isset($_POST['apellidos']) || !isset($_POST['grado']) || !isset($_POST['correo']) || !isset($_POST['password'])){
        header("location:crear-cuenta.php");
    }

    require '../include/conexionbd.php';


    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(segF($_POST['cargo']) == "estudiante"){
            $_SESSION['nombrej'] = segF($_POST['nombre']);
            $_SESSION['apellidosj'] = segF($_POST['apellidos']);
            $_SESSION['gradoj'] = segF($_POST['grado']);
            $_SESSION['correoj'] = segF($_POST['correo']);
            $_SESSION['contrj'] = segF($_POST['password']);
            header("location:../crear-equipo.php");
        }
        elseif(segF($_POST['cargo']) == "profesor"){
            
            $ver_correo = $conn->prepare("SELECT correoAdmin FROM administradores WHERE correoAdmin=?");
            $ver_correo->bind_param('s', $_POST['correo']);
            $ver_correo->execute();
            $ver_correo->bind_result($corrV);
            $ver_correo->fetch();

            if($corrV == $_POST['correo']){
                echo "<script>alert('El correo ya no se encuentra disponible');
                window.location = '../crear-cuenta.php';</script>";

                die();
            }
            $ver_correo->close();
            $verf_cod = explode('-', $_POST['password']);
            if(count($verf_cod) == 2){
                if($verf_cod[1] == "admin_cod"){

                    $insert_admin = $conn->prepare("INSERT INTO administradores (nombreAdmin, apellidosAdmin, correoAdmin, contrAdmin) VALUES (?,?,?,?)");
                    $insert_admin->bind_param("ssss", $nomAd, $apAd, $corAd, $contAd);
                    $nomAd = segF($_POST['nombre']);
                    $apAd = segF($_POST['apellidos']);
                    $corAd = segF($_POST['correo']);
                    $contAd = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $insert_admin->execute();
                    $insert_admin->close();
                    
                    $_SESSION['sesion_admin'] = $corAd;
                    $_SESSION['sesion_activa'] = true;
                    
                    header("location:../admin.php");
                }else{
                    echo "<script>alert('no cuenta con el permiso para ser administrador');
                    window.location = window.history.back();
                     </script>";
                }
            }else{
                echo "<script>window.alert('no cuenta con el permiso para ser administrador');
                window.location = window.history.back(); </script>";
            }
            
        }
    }

?>