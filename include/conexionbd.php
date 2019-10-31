<?php 

    $servername = "localhost";
    $user = "root";
    $pass = "";
    $bd = "deportes_jesus_rey";

    $conn = new mysqli($servername, $user, $pass, $bd);

    function segF($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?> 