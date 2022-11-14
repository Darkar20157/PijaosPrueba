let divCod = document.querySelectorAll(".barcode");
let inputCod = document.querySelectorAll(".myCod");
let i = 0;
let array1 = [];
inputCod.forEach(item => {
    array1[i] = item.value;
    i = i + 1;
});
let x = 0;
divCod.forEach(item => {
    JsBarcode(item, array1[x]);
    x = x + 1;
})
function mostrarCod(pun){
    let codigo = document.getElementById("cod").value;
    let fecha = document.getElementById("fecha").value;
    let div = document.getElementById("viewCod");
    let h6 = document.getElementById("producto");
    h6.innerHTML = "<h6>Redimiste: "+pun+"</h6>";
    h6.style.textAlign = 'center';
    let sFecha = document.getElementById("mFecha");
    div.innerHTML = "<svg id='barcode'></svg>";
    sFecha.innerHTML = fecha;
    JsBarcode("#barcode", codigo);
    let svg = document.getElementById("barcode");
    svg.style.marginBottom = "15px";
    svg.style.transitionDelay = "all 800ms ease-out"
    sFecha.style.position = "relative";
    sFecha.style.fontSize = "25px";
    sFecha.style.color = "#959595"; 
    
    /*====================================
        Modal & Screenshot
    ======================================*/
    let barcode = document.getElementById("barcode");
    barcode.addEventListener("click", function(){
        let modal = document.querySelector(".myModal");
        modal.classList.add("active");
    })
    let closeModal = document.getElementById("close");
    closeModal.addEventListener("click", function(){
        let modal = document.querySelector(".myModal");
        modal.classList.remove("active");
    })

    let botonScreen = document.getElementById("screen");
    let objetivoScreen = document.body;
    botonScreen.addEventListener("click", () =>{
        let modal = document.getElementById("myModal");
        modal.style.backgroundColor = "white";
        setTimeout(function(){
            modal.style.backgroundColor = "#0000007a";
            html2canvas(objetivoScreen)
            .then(canvas => {
                let enlace = document.createElement("a");
                enlace.download = "Captura de Pantalla";
                enlace.href = canvas.toDataURL();
                enlace.click();
        })
        },500)
    })

    
}