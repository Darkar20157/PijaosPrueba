let form = document.getElementById("formular");
form.addEventListener("submit", function(e){
    setTimeout(function(){
        let boton = document.getElementById("confirmar");
        boton.disabled = true;
        let timerInterval
            Swal.fire({
            icon: 'success',
            title: 'Registrandote...',
            html: 'Espera a que tu registro se termine <h1></h1> segundos',
            timer: 4000,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('h1');
                timerInterval = setInterval(() => {
                  b.textContent = Swal.getTimerLeft()
                }, 100)
            },
            willClose: () => {
                clearInterval(timerInterval)
            }
            }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
                console.log('I was closed by the timer');
            }
        })
    })
})
/*
function areaSubprocesos(){
    let area = document.getElementById("area").value;
    let divSubProceso = document.getElementById("subProceso");
    switch(area){
        case 'Gerencia Comercial':
            divSubProceso.innerHTML = ""+
            "<h4>Sub Proceso</h4>"+
            "<select class='form-select' name='subProceso' id='subProceso' required>"+
                "<option value=''>Selecciona una Opcion</option>"+
                "<option value='Raspa'>Raspa</option>"+
                "<option value='Analistas'>Analistas</option>"+
                "<option value='Mercadeo'>Mercadeo</option>"+
                "<option value='TICs'>TICs</option>"+
                "<option value='Call Center'>Call Center</option>"+
                "<option value='Ventas'>Ventas</option>"+
                "<option value='Canal Alternativo'>Canal Alternativo</option>"+
            "</select>";
            return false;
        break;
        case 'Gerencia Financiera':
            divSubProceso.innerHTML = ""+
            "<h4>Sub Proceso</h4>"+
            "<select class='form-select' name='subProceso' id='subProceso' required>"+
                "<option value=''>Selecciona una Opcion</option>"+
                "<option value='Financiera'>Financiera</option>"+
                "<option value='Recaudo'>Recaudo</option>"+
                "<option value='Cartera'>Cartera</option>"+
                "<option value='Contable'>Contable</option>"+
            "</select>";
            return false;
        break;
        case 'Gerencia Administrativa':
            divSubProceso.innerHTML = ""+
            "<h4>Sub Proceso</h4>"+
            "<select class='form-select' name='subProceso' id='subProceso' required>"+
                "<option value=''>Selecciona una Opcion</option>"+
                "<option value='Infraestructura'>Infraestructura</option>"+
                "<option value='Talento Humano'>Talento Humano</option>"+
                "<option value='CCTV'>CCTV</option>"+
                "<option value='SST-Calidad'>SST-Calidad</option>"+
            "</select>";
            return false;
        break;
        case 'Gerencia Estrategica':
            divSubProceso.innerHTML = ""+
            "<h4>Sub Proceso</h4>"+
            "<select class='form-select' name='subProceso' id='subProceso' required>"+
                "<option value=''>Selecciona una Opcion</option>"+
                "<option value='General'</option>"+
                "<option value='Auditoria'>Auditoria</option>"+
                "<option value='Cumplimiento'>Cumplimiento</option>"+
                "<option value='Juridica'>Juridica</option>"+
                "<option value='Susolución'>Susolución</option>"+
                "<option value='Invercomes'>Invercomes</option>"+
                "<option value='Negocios'>Negocios</option>"+
                "<option value='Operaciones'>Operaciones</option>"+
            "</select>";
            return false;
        break;
        default:
            Swal.fire(
                'Oops',
                'Tienes que ingresar algun Area valida',
                'error'
            )
            divSubProceso.innerHTML = ""
        break;
    }
}
*/
function validarCedula(){
    let ced = document.getElementById("cedula").value;
    if(ced == ""){
        Swal.fire(
            'Oops',
            'No haz ingresado ninguna cedula',
            'error'
        );
        return false;
    }else{
        let array= {
            "ced": ced
        }
        $.ajax({
            type: "POST",
            url: "ajax/validaciones.php",
            data: array,
            success: function(responsive){
                if(responsive == 'Incorrecto'){
                    Swal.fire(
                        'Oops',
                        'La cedula que ingresaste ya existe',
                        'error'
                    );
                    return false;
                }else{
                    validarUsuario();
                }
            }
        })
    }
}
/*======================================================================================*/
function validarUsuario(){
    let correo = document.getElementById("correo").value;
    if(correo == ""){
        Swal.fire(
            'Oops',
            'No haz ingresado ningun correo',
            'error'
        );
        return false;
    }else{
        let array= {
            "correo": correo
        }
        $.ajax({
            type: "POST",
            url: "ajax/validaciones.php",
            data: array,
            success: function(responsive){
                if(responsive == 'Incorrecto'){
                    Swal.fire(
                        'Oops',
                        'El correo que ingresaste ya existe',
                        'error'
                    );
                    return false;
                }else{
                    Swal.fire(
                        '¡Datos Correctos!',
                        'Ahora solo tienes que aceptar nuestras políticas y trataminetos de datos',
                        'warning'
                    );
                    let divTerminos = document.getElementById("terminos_y_condiciones");
                    divTerminos.innerHTML = "<p><input type='checkbox' name='terminos' id='terminos' required> He leído y acepto la autorización de <a href='#' data-bs-target='#exampleModalToggle2' data-bs-toggle='modal' data-bs-dismiss='modal'>Tratamiento de Datos, Terminos y Condiciones</a></p>"
                    let div = document.getElementById("button");
                    div.innerHTML = "<button type='submit' id='confirmar' name='confirmar' class='btn btn-success'>Registrarse</button>"
                }
            }
        })   
    }
}
function consultCedYCorreo(){
    let ced = document.getElementById("cedula").value;
    let correo = document.getElementById("correo").value;
    let fexpedicion = document.getElementById("fexpedicion").value;
    let array = {
        "rCed": ced,
        "rCorreo": correo,
        "fexpedicion": fexpedicion
    }
    $.ajax({
        type: "POST",
        url: "ajax/validaciones.php",
        data: array,
        success: function(responsive){
            let array = JSON.parse(responsive)
            if(array.CEDULA == ced && array.CORREO == correo){
                Swal.fire(
                    '¡Datos Correctos!',
                    'Los datos ingresados son correctos. Dale click en → Enviar Clave ← al correo',
                    'success'
                )
                let boton = document.getElementById("boton");
                boton.innerHTML = "<button class='btn btn-success' type='submit' name='recuperar'>Enviar clave</button>";
            }else{
                Swal.fire(
                    '¡Datos Erroneos!',
                    'Revisa los datos ingresados',
                    'error'
                )
            }
        }
    })
}
/*let form = document.getElementById("formular");
form.addEventListener("submit", function(e){
    e.preventDefault();
})*/