<?php
require 'control-entrada/menu.ct.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php include 'include/links.php' ?>
	<title>Documentación</title>
	<meta charset="utf-8">
	<style type="text/css">
		*{
			padding: 0;
			margin: 0;
			box-sizing: border-box;
		}
		section{
			padding: 30px;
			width: 70%;
			margin: auto;
			box-shadow: 10px 10px 10px rgba(0,0,0,0.5);
		}
		section img{
			border-radius: 50%;
			float: left;
			shape-outside: circle(140px at 150px 150px);
		}
		
		object ::-webkit-scrollbar{
			width: 10px;
			background: black;
		}
		object ::-webkit-scrollbar-thumb{
			width: 10px;
			background: black;
		}
	</style>
</head>
<body>
<?php
require "include/menu.php";
?>

<form action="" method="post" enctype="multipart/form-data">
	<label for="documentacion">Reglamento del torneo:</label>
	<input type="file" name='documentacion'>
	<input type="submit" value="subir">
</form>

<?php 
include 'include/footer.php';
?>
<script>
</script>

</body>
</html>