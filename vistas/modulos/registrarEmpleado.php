<div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-12" id="col">
                    <button class="btn btn-success" style="width: 100%;" data-bs-toggle="modal" data-bs-target="#exampleModal">Agregar Empleado <img src="https://img.icons8.com/officel/28/4a90e2/add-user-group-man-man.png"/></button>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12" id="col">
                    <table class="table table-striped">
                        <thead>
                            <th>Cedula</th>
                            <th>Nombres</th>
                            <th>Apeliidos</th>
                            <th>Correo</th>
                            <th>Celular</th>
                            <th>Direccion</th>
                            <th>Password</th>
                            <th>Estado</th>
                        </thead>
                        <tbody>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Register Users -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Registrar Cliente</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="form-register">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Datos del Nuevo Cliente</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h5>Cedula</h5>
                                <input class="form-control" type="number" id="cedula" name="cedula">
                            </div>
                            <div class="col-md-4">
                                <h5>Nombres</h5>
                                <input class="form-control" type="text" id="nombres" name="nombres">
                            </div>
                            <div class="col-md-4">
                                <h5>Apellidos</h5>
                                <input class="form-control" type="text" id="apellidos" name="apellidos">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h5>Celular</h5>
                                <input class="form-control" type="number" id="celular" name="celular">
                            </div>
                            <div class="col-md-4">
                                <h5>Correo Electrónico</h5>
                                <input class="form-control" type="email" id="correo" name="correo">
                            </div>
                            <div class="col-md-4">
                                <h5>Estado</h5>
                                <select class="form-select" name="estado" id="estado">
                                    <option value="">Seleccione una Opcion</option>
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="register()">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>