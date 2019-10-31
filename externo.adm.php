<?php
require 'control-entrada/admin.ct.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Evento Externo</title>
    <?php require 'include/links.php' ?>
    <link rel="stylesheet" href="css/admin.css">

    <style>
    form{
        max-width: 500px;
        margin: auto;
        text-align: center;
        padding: 20px;
        box-shadow: 0 0 10px black;
    }
    input{
        border: none;
        color: black !important;
        border-bottom: solid 2px rgba(0, 0, 0, .5);
    }
    .inputBox{
        width: 50%;
        text-align: center;

    }
    .inputBox:nth-child(1){
        margin: auto;
    }
    </style>
</head>
<body>

    <?php require 'include/menuadmin.php'; ?>
    
    <form action="" method="post" enctype="multipart/form-data">
        <h2 style="margin: 15px 0;"><strong style=" font-weight: bolder">Evento: </strong></h2>
        <div class="inputBox" style='margin: auto;'>
            <input type="text" name='nombreEvento'>
            <label for='nombreEvento'>Nombre del evento:</label>
        </div>

        

        <span>Fecha del evento o pdf de programación: </span><br>
        <div class="row">
            <div class="inputBox">
                <input type="date" name="fecha" style="width: 70% !important;
        margin: auto;">
            </div>
            <div class="inputBox">
                <label for="archivo" style='text-align: center; border: solid 1px blue;'>PDF:</label>
                <input type="file" name="archivo" style="overflow: hidden; position: absolute; opacity: 0; top: 0;left: 0" accept="document/pdf">
            </div>
        </div>

        <label for="conv">Convocatoria:</label>
        <input type="checkbox" name="conv"><br><br>

        
    </form>
        
    <?php require 'include/footer.php'; ?>
</body>
</html>