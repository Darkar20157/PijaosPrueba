if(window.location.pathname == "/puntosganagana/publicaciones"){
    $(document).ready(function(){
        let i = 1;
        let j = 1;
        paginar1(i);
        paginar2(j);
    })
}
function paginar1(i){
    let array1 = {
        "id1": i
    }
    $.ajax({
        type: "POST",
        url: "/puntosganagana/ajax/paginador.php",
        data: array1,
        success: function(response){
            let div = document.getElementById("promos");
            div.innerHTML = response;
        }
    })
    return false;
}
function paginar2(j){
    let array2 = {
        "id2": j
    }
    $.ajax({
        type: "POST",
        url: "/puntosganagana/ajax/paginador.php",
        data: array2,
        success: function(response){
            let div = document.getElementById("productos");
            div.innerHTML = response;
        }
    })
    return false;
}
function eliminarPromo1(id1){
    Swal.fire({
        title: 'Estas Seguro?',
        text: "Eliminaras este producto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar!'
      }).then((result) => {
        if(result.isConfirmed) {
            let array = {
                "idDelete1": id1
            }
            $.ajax({
                type: "POST",
                url: "/puntosganagana/ajax/paginador.php",
                data: array,
                success: function(response){
                    console.log(response);
                    if(response == "Correcto"){
                        Swal.fire(
                            'Enhorabuena',
                            'Se ha eliminado la promocion',
                            'success'
                        )
                        setTimeout(function(){
                            location.reload();
                        }, 2000)
                    }else{
                        Swal.fire(
                            'Oops',
                            'Algo ha sucedido, intenta mas tarde',
                            'error'
                        )
                    }
                }
            })
        }
    })
}
function eliminarPromo2(id){
    Swal.fire({
        title: 'Estas Seguro?',
        text: "Eliminaras este producto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar!'
      }).then((result) => {
        if(result.isConfirmed) {
            let array = {
                "idDelete2": id
            }
            $.ajax({
                type: "POST",
                url: "/puntosganagana/ajax/paginador.php",
                data: array,
                success: function(response){
                    console.log(response);
                    if(response == "Correcto"){
                        Swal.fire(
                            'Enhorabuena',
                            'Se ha eliminado el producto',
                            'success'
                        )
                        setTimeout(function(){
                            location.reload();
                        }, 2000)
                    }else{
                        Swal.fire(
                            'Oops',
                            'Algo ha sucedido, intenta mas tarde',
                            'error'
                        )
                    }
                }
            })
        }
    })
}
function reclamar(id, ced){
    document.getElementById('ID').value = id;
    document.getElementById('CED').value = ced;
}