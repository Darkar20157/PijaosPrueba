<nav>
    <div class="container-nav">
        <div class="navigation">
            <ul>
                <li>
                    <a href="dashboard">
                        <span class="icon"><img class="logo" src="vistas/img/ganaCirculo.png" width="40"></span>
                        <span class="title">Gana Points</span>
                    </a>
                </li>
                <li id="1">
                    <a href="dashboard">
                        <span class="icon"><img src="https://img.icons8.com/external-vitaliy-gorbachev-flat-vitaly-gorbachev/28/ffffff/external-dashboard-blogger-vitaliy-gorbachev-flat-vitaly-gorbachev.png"/></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li id="2">
                    <a href="registrarClientes">
                        <span class="icon"><img src="https://img.icons8.com/officel/28/4a90e2/add-user-group-man-man.png"/></span>
                        <span class="title">Registrar Clientes</span>
                    </a>
                </li>
                <?php
                if($_SESSION['TYPE_USER'] == "Administrador"){
                    ?>
                    <li id="3">
                        <a href="registrarEmpleado">
                            <span class="icon"><img src="https://img.icons8.com/fluency/28/ffffff/group-background-selected.png"/></span>
                            <span class="title">Registrar Empleado</span>
                        </a>
                    </li>
                <?php
                }
                ?>
                <li id="4">
                    <a href="parametrizacion">
                        <span class="icon"><img src="https://img.icons8.com/external-icongeek26-flat-icongeek26/28/ffffff/external-coin-netherlands-icongeek26-flat-icongeek26.png"/></span>
                        <span class="title">Parametrizacion</span>
                    </a>
                </li>
                <li id="5">
                    <a href="promociones">
                        <span class="icon"><img src="https://img.icons8.com/fluency/28/ffffff/add-bookmark.png"/></span>
                        <span class="title">Promociones</span>
                    </a>
                </li>
                <li id="6">
                    <a href="publicaciones">
                        <span class="icon"><img src="https://img.icons8.com/fluency/28/ffffff/upload-to-cloud.png"/></span>
                        <span class="title">Publicaciones</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <img src="https://img.icons8.com/external-kmg-design-glyph-kmg-design/35/28A745/external-dashboard-ui-essential-kmg-design-glyph-kmg-design.png"/>
            </div>
            <div class="notifications">
                <img src="https://img.icons8.com/color/35/ffffff/appointment-reminders--v1.png"/>
            </div>
            <div class="user" id="btn">
                <img src="vistas/imgEmpleados/<?php echo $_SESSION['FOTO']; ?>"/>
            </div> 
        </div>
        <div class="view-dropdown">
            <div class="menu-body">
                <div class="foto">
                    <img src="vistas/imgEmpleados/<?php echo $_SESSION['FOTO']; ?>">
                </div>
                <h4><?php echo $_SESSION['NOMBRES'].' '.$_SESSION['APELLIDOS']; ?></h4>
                <h5><?php echo $_SESSION['TYPE_USER'] ?></h5>
                <ul>
                    <li>
                        <a href="perfilEmpleados">
                            <img src="https://img.icons8.com/office/36/ffffff/edit-user-male--v1.png"/>
                            <h6>Mi Perfil</h6>
                        </a>
                    </li>
                    <li>
                        <a href="salir">
                            <img src="https://img.icons8.com/external-tal-revivo-green-tal-revivo/36/ffffff/external-online-account-logout-with-arrow-direction-mark-login-green-tal-revivo.png"/>
                            <h6>Cerrar Sesion</h6>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>