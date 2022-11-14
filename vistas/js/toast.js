function quitar(){
    let close = !!document.getElementById("close0");
    if(close == false){
        console.log("No existe")
    }else{
        let close = document.getElementById("close");
        const quitar = document.querySelector(".subtitle");
        close.addEventListener("click", function(){
            quitar.classList.toggle("close");
            window.location.href = 'perfil';
        })
    }
}