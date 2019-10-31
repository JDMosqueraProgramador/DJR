<?php
require 'control-entrada/menu.ct.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'include/links.php' ?>
    <link rel="stylesheet" href="css/quienes-somos.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quienes Somos</title>


</head>
<body>
<?php include "include/menu.php"; ?>

<section class="bandw" id="bandw" onmousemove="moverB(event)">
	<div class="pointerbaw" id="pbw"></div>
	<div class="white  col-a6">
		<h1>Misión</h1>
		<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea maiores perferendis culpa facilis repellat similique iusto incidunt, officia at laboriosam voluptatum et aliquam explicabo quod quis itaque est facere aperiam cum delectus ad? Blanditiis iusto ex minus placeat tempora atque? Nemo recusandae nobis similique possimus est deserunt omnis aspernatur ab.</p>
	</div>
	<div class="black  col-a6">
		<h1>visión</h1>
		<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea maiores perferendis culpa facilis repellat similique iusto incidunt, officia at laboriosam voluptatum et aliquam explicabo quod quis itaque est facere aperiam cum delectus ad? Blanditiis iusto ex minus placeat tempora atque? Nemo recusandae nobis similique possimus est deserunt omnis aspernatur ab.</p>
	</div>
</section>

<section>

	<h1>Integrantes</h1>

	<div class="row">
		
		<div class="card-qs">
			<div class="imagen">
				<img src="imagenes/yo.jpg">
			</div>
			<div class="informacion">
				<div class="contenido">

					<h2>Juan David <br><span>Mosquera Muñoz</span></h2>
					<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis, dignissimos!</p>
					
					<ul>
						<li><a href="" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
						<li><a href="" target="_blank"><i class="fab fa-twitter"></i></a></li>
						<li><a href="" target="_blank"><i class="fab fa-instagram"></i></a></li>
					</ul>
				</div>
					
			</div>
		</div>

<!-- 
		<div class="card-qs">
			<div class="imagen">
				<img src="imagenes/mela.jpg">
			</div>
			<div class="informacion">
				<div class="contenido">

					<h2>Melany <br><span>Tamayo Monsalve</span></h2>
					<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis, dignissimos!</p>
					
					<ul>
						<li><a href="" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
						<li><a href="" target="_blank"><i class="fab fa-twitter"></i></a></li>
						<li><a href="" target="_blank"><i class="fab fa-instagram"></i></a></li>
					</ul>
				</div>
					
			</div>
		</div> -->

	</div>

	<!-- <div class="row">

		<div class="card-qs">
			<div class="imagen">
				<img src="imagenes/rive.jpg">
			</div>
			<div class="informacion">
				<div class="contenido">

					<h2>Sebastian <br><span>Rivera Cardona</span></h2>
					<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis, dignissimos!</p>
					
					<ul>
						<li><a href="" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
						<li><a href="" target="_blank"><i class="fab fa-twitter"></i></a></li>
						<li><a href="" target="_blank"><i class="fab fa-instagram"></i></a></li>
					</ul>
				</div>
					
			</div>
		</div>



		<div class="card-qs">
			<div class="imagen">
				<img src="imagenes/vale.jpg">
			</div>
			<div class="informacion">
				<div class="contenido">

					<h2>Valentina <br><span>Cadavid Zabala</span></h2>
					<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis, dignissimos!</p>
					
					<ul>
						<li><a href="" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
						<li><a href="" target="_blank"><i class="fab fa-twitter"></i></a></li>
						<li><a href="" target="_blank"><i class="fab fa-instagram"></i></a></li>
					</ul>
				</div>
					
			</div>
		</div>

	</div> -->

</section>



<?php include "include/footer.php"; ?>
    <script>
    menu_3(1);
	</script>

	<script>
	function moverB(es){
		var and = document.getElementById('bandw');
		var bola = document.getElementById('pbw');
		var px = es.clientX;
		var py = es.clientY;
		
		if(px > 150 && py > 0 && px < and.clientWidth - 150){
			bola.style.top = py + "px";
			bola.style.left = px + "px";
		}
	}
    
	</script>


</body>
</html>