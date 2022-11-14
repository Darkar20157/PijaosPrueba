//Saber en que ruta estoy
/*=======================================
let ruta = window.location.pathname;
let string = "/";
let position = ruta.lastIndexOf(string);
let rutaFinal = ruta.slice(position+1);
=========================================*/
/*=====================================
Si es menor 768px quita el menu lateral
=======================================*/
if(window.screen.availWidth < 768){
    let navigation = document.querySelector('.navigation');
    let main = document.querySelector('.main');
    let mainContainer = document.querySelector('.main-container');
    let row = document.querySelectorAll('.row');
    let bodydropdown =  document.querySelector(".view-dropdown");
    navigation.classList.toggle('active');
    main.classList.toggle('active');
    mainContainer.classList.toggle('active');
    bodydropdown.classList.toggle('active');
    row.forEach((item2) =>
    item2.classList.toggle('active'));
}
/*==============================
hover del menu lateral blanco
================================*/
li();
function li(){
    if(window.location.pathname == "/puntosganagana/dashboard"){
        let li = document.getElementById("1");
        li.classList.add('hovered');
    }
    if(window.location.pathname == "/puntosganagana/registrarClientes"){
        let li = document.getElementById("2");
        li.classList.add('hovered');
    }
    if(window.location.pathname == "/puntosganagana/parametrizacion"){
        let li = document.getElementById("4");
        li.classList.add('hovered');
    }
    if(window.location.pathname == "/puntosganagana/novedades"){
        let li = document.getElementById("5");
        li.classList.add('hovered');
    }
    if(window.location.pathname == "/puntosganagana/publicaciones"){
        let li = document.getElementById("6");
        li.classList.add('hovered');
    }
}

let toggle = document.querySelector('.toggle');
let navigation = document.querySelector('.navigation');
let main = document.querySelector('.main');
let mainContainer = document.querySelector('.main-container');
let row = document.querySelectorAll('.row');
let bodydropdown =  document.querySelector(".view-dropdown");
toggle.onclick = function(){
    navigation.classList.toggle('active');
    main.classList.toggle('active');
    mainContainer.classList.toggle('active');
    bodydropdown.classList.toggle('active');
    row.forEach((item2) =>
    item2.classList.toggle('active'));
}
let list = document.querySelectorAll('.navigation li');

function activeLink(){
    list.forEach((item) =>
    item.classList.remove('hovered'));
    li();
}
list.forEach((item) =>
item.addEventListener('mouseover', activeLink));

let dropdown = document.querySelector('.view-dropdown');
btn.addEventListener("click", function(){
    dropdown.classList.toggle("drop");
})

//============================Select2=============================//
$('.form-select').select2();