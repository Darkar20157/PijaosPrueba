let puntos = document.getElementById("points");
puntos.addEventListener("mousemove", function(){
    let spanPuntos = document.getElementById("punt");
    spanPuntos.innerText = puntos.value;
})
let cantidad = document.getElementById("amount");
cantidad.addEventListener("mousemove", function(){
    let spanCantidad = document.getElementById("cant");
    spanCantidad.innerText = cantidad.value;
})
