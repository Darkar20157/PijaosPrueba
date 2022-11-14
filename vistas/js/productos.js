function validacionProducto(){
    let serie = document.getElementById("serie");
    let colilla = document.getElementById("colilla");
    let id = document.getElementById("producto");
    let btn = document.getElementById("validar");
    btn.innerHTML = "<div class='spinner-border spinner-border-sm text-info' role='status'><span class='visually-hidden'>Loading...</span></div>"
    serie.readOnly = true;
    colilla.readOnly = true;
    id.style.backgroundColor = '#e9ecef';
    id.style.pointerEvents = 'none';
    id.style.touchAction = 'none';
    let array = {
        "serie": serie.value,
        "colilla": colilla.value,
        "idProducto": id.value
    }
    $.ajax({
        type: "POST",
        url: "/puntosganagana/ajax/producto.php",
        data: array,
        success: function(response){
            btn.innerHTML = 'Validar datos';
            if(response == "Registrado"){
                Swal.fire({
                    title: 'Ups',
                    text: "Lo siento la serie y la colilla ingresada ya fue registrada por otro usuario",
                    icon: 'error',
                    confirmButtonColor: '#3085d6',
                  }).then((result) => {
                    if (result.isConfirmed) {
                      location.reload();
                    }
                })
            }else{
                switch (id.value){
                    case '24444 RASPA':
                        let array1 = JSON.parse(response);
                        if(array1.SERIE == serie.value && array1.COLILLA == colilla.value){
                            let div = document.getElementById("botonRegistrar");
                            div.innerHTML = "<button class='btn btn-success' style='font-size: .7rem' name='registrar' id='registrar'>Registrar Raspa</button>";
                            document.getElementById("valor").value = array1.VLR_APOSTADO;
                        }else{
                            Swal.fire(
                                'Oops',
                                'Lo siento la serie y la colilla ingresada no son correctas',
                                'error'
                            )
                            serie.readOnly = false;
                            colilla.readOnly = false;
                            id.style.backgroundColor = '#ffffff';
                            id.style.pointerEvents = 'auto';
                            id.style.touchAction = 'auto';
                        }
                        break;
                    case '12072 BALOTO':
                        let array2 = JSON.parse(response);
                        if(array2.SERIE == serie.value && array2.COLILLA == colilla.value){
                            let div = document.getElementById("botonRegistrar");
                            div.innerHTML = "<button class='btn btn-success' style='font-size: .7rem' name='registrar' id='registrar'>Registrar Raspa</button>";
                            document.getElementById("valor").value = array2.VLR_TOTAL_RECAUDO;
                        }else{
                            Swal.fire(
                                'Oops',
                                'Lo siento la serie y la colilla ingresada no son correctas',
                                'error'
                            )
                            serie.readOnly = false;
                            colilla.readOnly = false;
                            id.style.backgroundColor = '#ffffff';
                            id.style.pointerEvents = 'auto';
                            id.style.touchAction = 'auto';
                        }
                        break;
                    case '6780 CELSIA':
                        let array3 = JSON.parse(response);
                        if(array3.SERIE == serie.value && array3.COLILLA == colilla.value){
                            let div = document.getElementById("botonRegistrar");
                            div.innerHTML = "<button class='btn btn-success' style='font-size: .7rem' name='registrar' id='registrar'>Registrar Raspa</button>";
                            document.getElementById("valor").value = array3.VLR_TOTAL_RECAUDO;
                        }else{
                            Swal.fire(
                                'Oops',
                                'Lo siento la serie y la colilla ingresada no son correctas',
                                'error'
                            )
                            serie.readOnly = false;
                            colilla.readOnly = false;
                            id.style.backgroundColor = '#ffffff';
                            id.style.pointerEvents = 'auto';
                            id.style.touchAction = 'auto';
                        }
                        break;
                }
            }
        }
    })
}