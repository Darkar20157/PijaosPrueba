<div class="main-container">
    <div class="container">
        <div class="row">
            <div class="col-12" id="col">
                <h3><img src="https://img.icons8.com/external-bearicons-glyph-bearicons/28/000000/external-User-essential-collection-bearicons-glyph-bearicons.png"/> Perfil de Usuario</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-3" id="col">
                <h4>Foto</h4>
                <input class="form-control" type="file" id="photo" name="photo" onchange="getImage(event)">
                <label class="photo-view" for="photo">
                    <div class="preview">
                        <img src="https://img.icons8.com/cute-clipart/120/000000/add-image.png"/>
                    </div>
                </label>
            </div>
            <div class="col-4" id="col">
                <h4>Nombre de Usuario</h4>
                <input class="form-control form-control-lg" type="text" id="user" name="user">
            </div>
            <div class="col-4" id="col">
                <h4>Nombres</h4>
                <input class="form-control form-control-lg" type="text" id="nombre" name="nombre">
            </div>
        </div>
        <div class="row">
            <div class="col-4" id="col">
                <h4>Apellidos</h4>
                <input class="form-control" type="text" id="apellido" name="apellido">
            </div>
            <div class="col-4" id="col">
                <h4>Correo</h4>
                <input type="email" class="form-control" name="correo" id="correo">
            </div>
            <div class="col-3" id="col">
                <h4>Celular</h4>
                <input type="number" class="form-control" placeholder="Celular" aria-label="Username" aria-describedby="basic-addon1">
            </div>
        </div>
        <div class="row">
            <div class="col-4" id="col">
                <h4>Genero</h4>
                <select class="form-select" name="ciudad" id="ciudad">
                    <option value="">Seleccione una Opcion</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Masculino">Masculino</option>
                </select>
            </div>
            <div class="col-4" id="col">
                <h4>Ciudad</h4>
                <select class="form-select" name="ciudad" id="ciudad">
                    <option value="">Seleccione una Opcion</option>
                    <option value="Ibague">Ibague</option>
                </select>
            </div>
            <div class="col-3" id="col">
                <h4>Fecha Nacimiento</h4>
                <input class="form-control" type="date" id="fecha" name="fecha">
            </div>
        </div>
        <div class="row">
            <div class="col-6" id="col">
                <h4>Clave</h4>
                <input class="form-control" type="password" id="pass" name="pass">
            </div>
            <div class="col-6" id="col">
                <h4>Confirmar Clave</h4>
                <input class="form-control" type="password" id="Cpass" name="Cpass">
            </div>
        </div>
    </div>
</div>