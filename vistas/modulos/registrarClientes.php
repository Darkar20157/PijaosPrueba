<?php
$consult = ModeloUsuarios::mdlListarClientes();
?>
<div class="main-container">
    <div class="container">
        <div class="row">
            <div class="col-12" id="col">
                <button class="btn btn-success" style="width: 100%;" data-bs-toggle="modal" data-bs-target="#exampleModal">Agregar Usuarios <img src="https://img.icons8.com/officel/28/4a90e2/add-user-group-man-man.png"/></button>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12" id="col">
                <h3>Lista de Clientes</h3>
                <div class="table-responsive">
                <table class="table table-bordered table-hover table-sm">
                    <thead>
                        <tr class="table-dark">
                            <th>Cedula</th>
                            <th>Nombres</th>
                            <th>Apeliidos</th>
                            <th>Celular</th>
                            <th>Correo</th>
                            <th>Ciudad</th>
                            <th>Genero</th>
                            <th>Fecha Nacimiento</th>
                            <th>Estado</th>
                            <th>Confirmacion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($row = oci_fetch_array($consult, OCI_ASSOC)){
                            ?>
                            <tr>
                                <td><?php echo $row['CEDULA']; ?></td>
                                <td><?php echo $row['NOMBRES'] ?></td>
                                <td><?php echo $row['APELLIDOS'] ?></td>
                                <td><?php if(empty($row['CELULAR'])){echo "(Vacio)";}else{echo $row['CELULAR'];} ?></td>
                                <td><?php echo $row['CORREO'] ?></td>
                                <td><?php if(empty($row['CIUDAD'])){echo "(Vacio)";}else{echo $row['CIUDAD'];} ?></td>
                                <td><?php if(empty($row['GENERO'])){echo "(Vacio)";}else{echo $row['GENERO'];} ?></td>
                                <td><?php if(empty($row['FECHA_NAC'])){echo "(Vacio)";}else{echo $row['FECHA_NAC'];} ?></td>
                                <td><?php 
                                        if($row['ESTADO'] == "1"){
                                            echo "Activo";
                                        }elseif($row['ESTADO'] == "0"){
                                            echo "Inactivo";
                                        }
                                    ?>
                                </td>
                                <td><?php 
                                        if($row['CONFIRMACION'] == "1"){
                                            echo "Si";
                                        }elseif($row['CONFIRMACION'] == "0"){
                                            echo "No";
                                        }
                                    ?>
                                </td>
                                <td class="acciones">
                                    <button class="btn btn-primary" onclick="resetear(<?php echo $row['CEDULA'] ?>)">
                                        <img src="https://img.icons8.com/ios-filled/20/ffffff/recurring-appointment.png"/>
                                    </button>
                                    <button class="btn btn-danger" id="borrar" name="borrar" onclick="eliminar(<?php echo $row['CEDULA']; ?>)"><img src="https://img.icons8.com/ios-glyphs/20/ffffff/delete.png"/></button>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>                        
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Register Users -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="padding: 15px 25px;">
                <h2 class="modal-title" id="exampleModalLabel">Registrar Cliente</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <div class="row" style="width: 100%;">
                        <div class="col-md-12">
                            <h2>Datos del Nuevo Cliente</h2>
                        </div>
                    </div>
                    <div class="row" style="width: 100%;">
                        <div class="col-md-4">
                            <h3>Tipo Documento</h3>
                            <select class="form-select" name="tipDoc" id="tipDoc">
                                <option value="">Selecciona una Opcion</option>
                                <option value="Cedula de ciudadania">Cedula de ciudadania</option>
                                <option value="Cedula de extrajeria">Cedula de extrajeria</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <h3>Cedula</h3>
                            <input class="form-control" type="number" id="cedula" name="cedula">
                        </div>
                        <div class="col-md-4">
                            <h3>Nombres</h3>
                            <input class="form-control" type="text" id="nombres" name="nombres">
                        </div>
                    </div>
                    <div class="row" style="width: 100%;">
                        <div class="col-md-4">
                            <h3>Apellidos</h3>
                            <input class="form-control" type="text" id="apellidos" name="apellidos">
                        </div>
                        <div class="col-md-4">
                            <h3>Correo Electrónico</h3>
                            <input class="form-control" type="email" id="correo" name="correo">
                        </div>
                        <div class="col-md-4">
                            <h3>Acepta terminos y condiciones</h3>
                            <input class="form-check-input" type="checkbox" id="terminos" name="terminos" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding: 5px;">
                    <button type="submit" class="btn btn-success" id="confirmar" name="confirmar">Agregar Cliente</button>
                </div>
                <?php
                $registrarCliente = new ControladorUsuarios();
                $registrarCliente->ctrRegistrarCliente();
                if($registrarCliente == "Correcto"){
                    echo "Correcto";
                ?>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
                <?php
                }
                ?>
            </form>
        </div>
    </div>
</div>
