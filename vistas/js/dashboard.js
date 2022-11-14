localStorage.setItem("nombre", "Danny");
/*========================================================
    Sub - Modulos
===========================================================*/
let botonOpciones = document.querySelector(".opciones");
let div = document.querySelector(".sub-modulos");
let subModulo = document.querySelectorAll(".sub-modulo");
botonOpciones.addEventListener("click", function(){
    div.classList.toggle('active');
    subModulo.forEach(element => {
        element.classList.toggle('active');
    });
});
/*
let tutorial = document.getElementById("tutorial")
tutorial.addEventListener("click", function(){
    div.classList.remove('active');
    subModulos1.classList.remove('active');
    subModulos2.classList.remove('active');
    subModulos3.classList.remove('active');
    subModulos4.classList.remove('active');
})
*/

/*========================================================
    Modulos
===========================================================*/
let botonModulo1 = document.querySelector(".modulo-1");
botonModulo1.addEventListener("click", function(){
    botonModulo1.classList.add("active");
    setTimeout(function(){
        botonModulo1.classList.remove("active");
    },800)
})
let botonModulo2 = document.querySelector(".modulo-2");
botonModulo2.addEventListener("click", function(){
    botonModulo2.classList.add("active");
    setTimeout(function(){
        botonModulo2.classList.remove("active");
    },800)
})
let botonModulo3 = document.querySelector(".modulo-3");
botonModulo3.addEventListener("click", function(){
    botonModulo3.classList.add("active");
    setTimeout(function(){
        botonModulo3.classList.remove("active");
    },800)
})
let botonModulo4 = document.querySelector(".modulo-4");
botonModulo4.addEventListener("click", function(){
    botonModulo4.classList.add("active");
    setTimeout(function(){
        botonModulo4.classList.remove("active");
    },800)
})
let