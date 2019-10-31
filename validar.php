<?php

$vnombre = $vapellidos = $vcorreo = $vcontraseña = $vcargo = "";
$nombre = $apellidos = $correo = $contraseña = $cargo =  "";
$nasterisco = $aasterisco = $casterisco = $pasterisco = $gasterisco = "";
$boolean = "";


if($_SERVER['REQUEST_METHOD'] == "POST"){

    if(empty($_POST['nombre'])){
        $vnombre = "El campo de nombre es requerido";
        $nasterisco = "*";
        $boolean = false;
    }else{
        $nombre = segF($_POST['nombre']);
        if(!preg_match("/^[a-zA-Z ]*$/",$nombre)){
            $vnombre = "el nombre no debe contener numeros o signos";
            $nasterisco = "*";
            $boolean = false;
        }
        $boolean = true;
    }

    if(empty($_POST['apellidos'])){
        $vapellidos = "El campo de apellidos debe ser diligenciado";
        $aasterisco = "*";
        $boolean = false;
    }else{
        $apellidos = segF($_POST['apellidos']);
        if(!preg_match("/^[a-zA-Z ]*$/",$apellidos)){
            $aasterisco = "*";
            $vapellidos = "los apellidos no deben llevar simbolos o numeros";
            $boolean = false;
        }
        $boolean = true;
    }

    if(empty($_POST['correo'])){
        $casterisco = "*";
        $vcorreo = "EL campo de correo debe ser diligenciado";
        $boolean = false;
    }
    else{
        $correo = segF($_POST['correo']);
        if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
            $vcorreo = "La dirección de correo es incorrecta";
            $casterisco = "*";
            $boolean = false;
        }
        $boolean = true;
    }

    if(empty($_POST['password'])){
        $vcontraseña = "crear una contraseña es obligatorio";
        $pasterisco = "*";
        $boolean = false;
    }
    else{
        if(strlen($_POST['password']) < 5){
            $vcontraseña = "la contraseña debe tener almenos 5 caracteres";
            $pasterisco = "*";
            $boolean = false;
        }else{
            $contraseña = segF($_POST['password']);
            $boolean = true;
        }
        
        
    }

    if(empty($_POST['cargo'])){
        $vcargo = "Debe especificar el cargo que ocupa";
        $boolean = false;
    }else{
        $cargo = segF($_POST['cargo']);
        $boolean = true;
    }


    if($cargo == "estudiante"){
        $vgrado = $vtipo = "";
        $grado = $tipo = "";
        
        if(empty($_POST['grado'])){
            $vgrado = "Debe especificar el grado que cursa";
            $boolean = false;
        }
        else{
            $grado = segF($_POST['grado']);
            $boolean = true;
        }

        if(empty($_POST['tipo'])){
            $vtipo = "Debe especificar el sexo al que pertenece";
            $boolean = false;
        }
        else{
            $tipo = segF($_POST['tipo']);
            $boolean = true;
        }
    }

}

function segF($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}



?>