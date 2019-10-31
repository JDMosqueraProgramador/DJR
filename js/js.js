// const
const id = document.getElementById.bind(document);
const classNames = document.getElementsByClassName.bind(document);
const tagNames = document.getElementsByTagName.bind(document);

// slider

var slideIndex = 0;

function carousel() {
	let i;
	var x = classNames("mySlides");
	for (i = 0; i < x.length; i++) {
		x[i].style.display = "none";
	}
	slideIndex++;
	if (slideIndex > x.length) {
		slideIndex = 1;
	}
	x[slideIndex - 1].style.display = "block";
	setTimeout(carousel, 5000);
}

// menu Responsive

function myFunction() {
	var x = id("MenuResponsive");
	if (x.className == "menu2") {
		x.className += " menualv";
	} else {
		x.className = "menu2";
	}
}

function mcal() {
	var calendario = id("calendario");
	calendario.classList.toggle("mcalendario");

	window.addEventListener('click', function(e){
		if(e.target != calendario){
			calendario.classList.remove('mcalendario');
		}
	}, true);
}



// scroll menu

function ScrollMenu() {
	var menu3 = id("menu3");
	var menu = id("menuF");
	var altura = menu3.offsetTop + menu3.offsetHeight;
	window.addEventListener("scroll", function () {
		if (window.pageYOffset > altura) {
			menu.classList.add("fixed");
		} else {
			menu.classList.remove("fixed");
		}
	});
}

// scroollMenu Partido{
function MenuVerScroll() {
	var menuV = id("menuVp");
	var alturaV = menuV.offsetTop;
	window.addEventListener("scroll", function () {
		if (window.pageYOffset > alturaV) {
			menuV.style.top = "90px";
		} else {
			menuV.style.top = "auto";
		}
	});
}

function AnimationFooter() {
	var footer = id("footer");
	var scroll = footer.offsetHeight;
}

// drop clic

function drop() {
	id("activeDrop").classList.toggle("responsive");
}

// ventana modal

function venM() {
	id("nuev-progr").classList.toggle("top-o");
}

// tabs

//arrastrar

function allowDrop(ev) {
	ev.preventDefault();
}

function drag(ev) {
	ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
	ev.preventDefault();
	var data = ev.dataTransfer.getData("text");
	ev.target.appendChild(document.id(data));
}

// Formularios

function formF() {
	var formi = id("iniciar-sesion");
	var inputf = formi.getElementsByTagName("input")[0].value,
		inputf = formi.getElementsByTagName("input")[0],
		inputf1 = formi.getElementsByTagName("input")[1].value,
		inputfs1 = formi.getElementsByTagName("input")[1];

	if (inputf1 == "") {
		inputfs1.style.borderBottom = "solid 1px red";
		return false;
	} else {
		inputf1.style.borderBottom = "solid 1px purple";
	}

	if (inputf == "") {
		inputfs.style.borderBottom = "solid 1px red";
		return false;
	} else {
		inputf.style.borderBottom = "solid 1px purple";
	}
}

// labels

function formL(i, l) {
	var input = tagNames("input")[i].value;
	var label = tagNames("label")[l];

	if (input != "") {
		label.classList.add("focus");
	} else {
		label.classList.remove("focus");
	}
}

function menu_2(x) {
	var menu = id("menu2");
	var y = menu.getElementsByTagName("li")[x];
	y.classList.add("active-menu2");
}

function menu_3(x) {
	var menu = id("menu3");
	var y = menu.getElementsByTagName("a")[x];
	y.classList.add("active-link");
}

// Calendario

function pasarCalendario() {
	let fecha = new Date();
	var numCal = fecha.getMonth();
	var mes = classNames("mes");
	var next = id("nextC");
	var pre = id("preC");

	next.addEventListener("click", function CalendarioN() {
		numCal++;
		if (numCal >= mes.length) {
			numCal = 0;
		}

		if (mes[numCal - 1]) {
			mes[numCal - 1].style.display = "none";
		} else {
			mes[mes.length - 1].style.display = "none";
			mes[0].style.display = "none";
		}
		if (mes[numCal + 1]) {
			mes[numCal + 1].style.display = "none";
		} else {
			mes[mes.length - 1].style.display = "none";
			mes[0].style.display = "none";
		}

		mes[numCal].style.display = "block";
	});

	pre.addEventListener("click", function CalendarioP() {
		numCal--;
		if (numCal < 0) {
			numCal = mes.length - 1;
		}

		if (mes[numCal + 1]) {
			mes[numCal + 1].style.display = "none";
		} else {
			mes[mes.length - 1].style.display = "none";
			mes[0].style.display = "none";
		}
		if (mes[numCal - 1]) {
			mes[numCal - 1].style.display = "none";
		} else {
			mes[mes.length - 1].style.display = "none";
			mes[0].style.display = "none";
		}
		mes[numCal].style.display = "block";
	});

	mes[numCal].style.display = "block";
}
