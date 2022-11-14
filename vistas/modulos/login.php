<?php
session_unset();
$municipios = ControladorUsuarios::ctrMunicipios();
?>
<div class="main-login">
  <div class="fondo-left-top">
    <img class="img1" src="./vistas/img/login1.png">
  </div>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <img class="icon" src="./vistas/img/logo1.png"/>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <h1>Bienvenido</h1>
      </div>
    </div>
    <form method="POST">
      <div class="row">
        <div class="col-12">
          <h2>Correo <span id="validar2"></span></h2>
          <input class="form-control" type="text" id="ingUsuario" name="ingUsuario" placeholder="ejemplo@gmail.com">
          <span id="validar1"></span>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <h2>Clave</h2>
          <input class="form-control" type="password" id="password" name="password" placeholder="************">
        </div>
      </div>
      <div class="row">
        <div class="col-12" id="mostrar-pass">
          <p>
            Mostrar Contraseña
          </p>
          <input class="form-check-input" type="checkbox" name="mpass" id="mpass" onchange="mostrarPassPerfil(0)">
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <a href="recuperacion">¿Haz olvidado tu contraseña?</a>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <button type="submit" class="btn btn-success" id="ingresar" name="ingresar">Ingresar</button>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <h3 class="register" style="color: #4747d1" data-bs-toggle="modal" href="#exampleModalToggle" role="button">¿No tienes una cuenta?</h3></a>
        </div>
      </div>
      <?php
      $login = new ControladorUsuarios();
      $login->ctrIngresoUsuario();
      ?>
    </form>
  </div>
</div>
<form class="formulario" method="POST" id="formular">
  <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalToggleLabel">Datos Principales </h2>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-6 col-md-4 col-md-6">
              <h4>Tipo Documento</h4>
              <select class="form-select" name="tipDoc" id="tipDoc" required>
                <option>Seleccione una Opcion</option>
                <option value="Cedula Ciudadania">Cédula Ciudadania</option>
                <option value="Cedula Extrangeria">Cédula Extrangeria</option>
              </select>
            </div>
            <div class="col-6 col-md-4 col-md-6">
              <h4 id="validacion">Cédula</h4>
              <input class="form-control" type="number" id="cedula" name="cedula" required>
            </div>
          </div>
          <div class="row">
            <div class="col-6 col-md-6">
              <h4>Nombres</h4>
              <input class="form-control" type="text" id="nombres" name="nombres" required>
            </div>
            <div class="col-6 col-md-6">
              <h4>Apellidos</h4>
              <input class="form-control" type="text" id="apellidos" name="apellidos" required>
            </div>
          </div>
          <div class="row">
            <div class="col-6 col-md-6">
              <h4>Celular</h4>
              <input class="form-control" type="number" id="celular" name="celular" placeholder="320xxxxxxx" required>
            </div>
            <div class="col-6 col-md-6">
              <h4>Correo</h4>
              <input class="form-control" type="email" id="correo" name="correo" placeholder="ejemplo@gmail.com" required>
            </div>
          </div>
          <div class="row">
            <div class="col-6 col-md-6">
              <h4>Fecha de Nacimiento</h4>
              <input class="form-control" type="date" id="fnacimiento" name="fnacimiento" required>
            </div>
            <div class="col-6 col-md-6">
              <h4>Fecha de Expedición del Documento</h4>
              <input class="form-control" type="date" id="fexpedicion" name="fexpedicion" placeholder="ejemplo@gmail.com" required>
            </div>
          </div> 
          <div class="row">
            <div class="col-6 col-md-4 col-md-6">
              <h4>Genero</h4>
              <select class="form-select" name="genero" id="genero" required>
                <option>Seleccione una Opcion</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
                <option value="Otro">Otro</option>
              </select>
            </div>
            <div class="col-6 col-md-4 col-md-6">
              <h4>Residencia</h4>
              <select class="form-select" name="residencia" id="residencia" required>
                <option>Seleccione un municipio</option>
                <?php
                for ($i=0; $i < count($municipios); $i++) {
                ?>
                  <option value="<?php echo $municipios[$i]['CODIGO_CIUDAD'] ?>"><?php echo $municipios[$i]['CIUDAD'] ?></option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          <!--
          <div class="row">
            <div class="col-6 col-md-6">
              <h4>Direccion</h4>
              <input class="form-control" type="text">
            </div>
            <div class="col-6 col-md-6">
              <h4>Codigo Referido</h4>
              <input class="form-control" type="text">
            </div>
          </div>       
          <div class="row">
            <div class="col-6 col-md-6">
              <h4>Area</h4>
              <select class="form-select" name="area" id="area" onchange="areaSubprocesos()" required>
                <option value="">Selecciona una Opcion</option>
                <option value="Gerencia Estrategica">Gerencia Estrategica</option>
                <option value="Gerencia Administrativa">Gerencia Administrativa</option>
                <option value="Gerencia Financiera">Gerencia Financiera</option>
                <option value="Gerencia Comercial">Gerencia Comercial</option>
              </select>
            </div>
            <div class="col-6 col-md-6" id="subProceso">
            </div>
          </div>
          -->
          <div class="row">
            <div class="col-12 col-md-12" id="terminos_y_condiciones">
            </div>
          </div>
        </div>
        <div class="modal-footer" id="button">
          <span class="btn btn-primary" style="width: 100%" onclick="validarCedula()">Validar información</span>
        </div>
      </div>
    </div>
  </div>
  <?php
  ControladorUsuarios::ctrRegistrarCliente();
  ?>
</form>
<!-- Modal -->
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalToggleLabel2" style="font-weight: 700;">Tratamiento de Datos y Terminos de Condiciones</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h5>AUTORIZACIÓN TRATAMIENTO DE DATOS PERSONALES</h5>
        <p>
        He sido informado que SEAPTO S.A., es el responsable del tratamiento de los datos 
        personales obtenidos a través del diligenciamiento del presente formulario y que he 
        leído la Política de Tratamiento de Datos Personales disponible en el sitio web 
        <a href="https://www.ganagana.com.co/index.php/empresa/normatividad">https://www.ganagana.com.co/index.php/empresa/normatividad</a> 
        Por ello, consiento y autorizo de manera previa, expresa e inequívoca que mis datos 
        personales sean tratados con sujeción a lo establecido en la ya mencionada 
        Política, atendiendo a las finalidades en ellas señaladas, entre las que se 
        encuentran SEAPTO S.A. recolectará, usará y tratará los datos personales de manera 
        leal y lícita para cumplir las actividades propias del objeto social de la sociedad 
        en especial la contratación, ejecución y comercialización de los bienes y servicios 
        de la compañía y sus filiales. SEAPTO S.A. también podrá tratar los datos personales 
        para los siguientes fines :  -Efectuar las gestiones pertinentes para el desarrollo 
        de la etapa precontractual, contractual y pos contractual con SEAPTO S.A., respecto 
        de cualquiera de los procesos y productos ofrecidos por la empresa que haya o no 
        adquirido o respecto de cualquier relación negocia al subyacente que tenga con ella, 
        así como dar cumplimiento a la ley colombiana o extranjera y a las órdenes de 
        autoridades judiciales o administrativas.- Realizar actividades de tele marketing 
        (mercadeo telefónico), servicio al cliente, actividades de activación de marca, 
        premios y promociones.- - Implementar estrategias de CRM 
        (customer relationship management), que comprende, entre otras, (i) un modelo de 
        gestión de toda la organización, basada en la orientación al cliente y marketing 
        relacional; (ii) Crear bases de datos o sistemas informáticos de apoyo a la gestión 
        de las relaciones con los clientes, a la venta y al marketing. Como Titular de esta 
        información tengo derecho a conocer, actualizar y rectificar mis datos personales, 
        solicitar prueba de la autorización otorgada para su tratamiento, ser informado 
        sobre el uso que se ha dado a los mismos,  revocar la autorización y/o solicitar 
        la supresión de mis datos en los casos en que sea procedente y acceder en forma 
        gratuita a los mismos mediante puede dirigir comunicación escrita dirigida a las 
        oficinas de SEAPTO S.A. (GANAGANA), ubicadas en la Calle 10 No 3-56 de la ciudad 
        de Ibagué, o a los correos electrónicos: seapto.notificaciones@ganagana.com.co  
        y servicio.alcliente@ganagana.com.co o comunicarse al teléfono 2610014
        </p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Volver</button>
      </div>
    </div>
  </div>
</div>