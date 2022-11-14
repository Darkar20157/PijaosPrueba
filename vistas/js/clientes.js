function eliminar(id){
    let ced = id;
    let item1 = "REGISTER_USERS";
    let item2 = "CEDULA";
    let array = {
        "cedula": ced,
        "item1": item1,
        "item2": item2
    }
    Swal.fire({
        title: '¡Ten cuidado!',
        text: 'Estas apunto de eliminar al cliente con la C.C. '+ced,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Si deseo eliminarlo!'
    }).then((result) =>{
        if(result.isConfirmed){
            $.ajax({
                type: "POST",
                url: "/puntosganagana/ajax/usuarios.php",
                data: array,
                success: function(response){
                    if(response == "ok"){
                        Swal.fire(
                            '¡Eliminado!',
                            'El usuario ha sido eliminado',
                            'success'
                        )
                    }
                }
            })
        }
    })
}
function resetear(ced){
    let array = {
        "ced": ced
    }
    $.ajax({
        type: "POST",
        url: "/puntosganagana/ajax/usuarios.php",
        data: array,
        success: function(response){
            console.log(response);
            if(response == "ok"){
                Swal.fire(
                    "Reseteo Exitoso",
                    "Se ha podido resetar el perfil del usuario",
                    "success",
                )
                setTimeout(function(){
                    location.reload();
                }, 2000);
            }
        }
    })
}