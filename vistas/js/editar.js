function ePerfil(){
    /*================================
    Nombres
    ==================================*/
    let inputNombres = document.getElementById("NOMBRES")
    inputNombres.readOnly = false;
    /*================================
    Apellidos
    ==================================*/
    let inputApellido = document.getElementById("APELLIDOS");
    inputApellido.readOnly = false;
    /*================================
    Ciudad
    ==================================*/
    let inputCiudad = document.getElementById("CIUDAD");
    inputCiudad.disabled = false;
    /*================================
    Fecha Nacimiento
    ==================================*/
    let inputFecha = document.getElementById("FECHA");
    inputFecha.type = "date";
    inputFecha.readOnly = false;
    /*================================
    Celular
    ==================================*/
    let inputCelular = document.getElementById("CELULAR");
    inputCelular.readOnly = false;
    /*================================
    Genero
    ==================================*/
    let inputGenero = document.getElementById("GENERO");
    console.log(inputGenero.value);
    inputGenero.disabled = false;
    /*================================
    Correo
    ==================================*/
    let inputCorreo = document.getElementById("CORREO");
    inputCorreo.readOnly = false

    let buttonActualizar = document.getElementById("actualizar");
    buttonActualizar.disabled = false;
}