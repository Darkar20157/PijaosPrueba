/*==========================
Mostrar points
============================*/
let ced = document.getElementById("ced").value;
let array = {
    "ced": ced
}
$.ajax({
    type: "POST",
    url: "/puntosganagana/ajax/puntos.php",
    data: array,
    cache: false,
    success: function(response){
        console.log(response);
        if(response == 0){
            $("#puntos").val(" Puntos: "+0);   
        }else{
            $("#puntos").val(" Puntos: "+response);
        }
    }
})
/*=====================================
Validar si tiene los puntos suficientes
=======================================*/
function validarPuntos(id, nombre, correo){
    let idProducto = id;
    let nomProducto = nombre;
    let ced = document.getElementById("ced").value;
    let nom = document.getElementById("nom").value;
    let array = {
        "ced": ced,
        "nom": nom,
        "idProducto": idProducto,
        "nomProduto": nomProducto,
        "correo": correo
    }
    $.ajax({
        type: "POST",
        url: "/puntosganagana/ajax/puntos.php",
        data: array,
        cache: false,
        success: function(response){
            console.log(response);

            if(response == "Incorrecto"){
                Swal.fire(
                    "Oops",
                    "¡Ah sucedido algo!, Intenta mas tarde",
                    "error"
                )
                setTimeout(function(){
                    location.reload();
                }, 2000);
            }else if(response == 'no ok'){
                Swal.fire(
                    "Oops",
                    "No tienes puntos suficientes",
                    "error"
                )
            }else{
                let array = JSON.parse(response);
                Swal.fire({
                    title: '¿Estas apunto de redimir?',
                    text: "Gastaras tus puntos en un"+array.nom_producto+". ¿Estas Seguro?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Canjear!'
                  }).then((result) => {
                      /*======================
                        Redencion de puntos
                      ========================*/
                    if(result.isConfirmed){
                        let call = new redimirPuntos;
                        let result = call.canjearPromocion(array);
                    }
                })
            }
        }
    })
}
class redimirPuntos{
    canjearPromocion(array){
        $.ajax({
            type: "POST",
            url: "/puntosganagana/ajax/generarCodBarras.php",
            data: array,
            cache: false,
            success: function(response){
                console.log(response);
                if(response == 'Correcto'){
                    Swal.fire(
                        '¡Canjeado!',
                        'Te daremos un codigo barras para que reclames en uno de nuestros puntos de venta',
                        'success'
                    )
                    setTimeout(function(){
                        window.location.href = 'codBarras';
                    }, 3000)
                }else{
                    Swal.fire(
                        "Oops",
                        "¡Ah sucedido algo!",
                        "error"
                    )
                }
            }
        })
    }
}