function mostrarPass(){
    let inputClave = document.getElementById("password");
    if(inputClave.type == 'password'){
        inputClave.type = 'text';
    }else if(inputClave.type == 'text'){
        inputClave.type = 'password';
    }
}
function mostrarPassPerfil(id){
    switch (id) {
        case 0:
            let inputClave0 = document.getElementById("password");
            if(inputClave0.type == 'password'){
                inputClave0.type = 'text';
            }else if(inputClave0.type == 'text'){
                inputClave0.type = 'password';
            }
            break;
        case 1:
            let inputClave1 = document.getElementById("passwordA");
            if(inputClave1.type == 'password'){
                inputClave1.type = 'text';
            }else if(inputClave1.type == 'text'){
                inputClave1.type = 'password';
            }
            break;
        case 2:
            let inputClave2 = document.getElementById("password1");
            if(inputClave2.type == 'password'){
                inputClave2.type = 'text';
            }else if(inputClave2.type == 'text'){
                inputClave2.type = 'password';
            }
            break;
        case 3:
            let inputClave3 = document.getElementById("password2");
            if(inputClave3.type == 'password'){
                inputClave3.type = 'text';
            }else if(inputClave3.type == 'text'){
                inputClave3.type = 'password';
            }
            break;
    }
}