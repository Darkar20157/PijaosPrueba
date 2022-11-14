document.addEventListener("DOMContentLoaded", function(){
    let bo = document.getElementById("web");
    bo.addEventListener("contextmenu", function(e){
        //e.preventDefault();
        /*
        if(e.keyCode == 123){
            return false;
        }
        */
    }, false);
    setTimeout(function(){
        let load = document.getElementById("cargando");
        load.style.opacity = 0;
        load.style.zIndex = 0;
    },1500)
})