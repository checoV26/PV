<?php include "views/template/header.php"; ?>
<h1 class="h3 mb-2 text-gray-800">Usuarios</h1>
<div class="mb-2">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalU" id="btnNA" name="btnNA"><i class="fas fa-user-plus"></i></button>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista de usuarios</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-light" id="userTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Usuarios</th>
                        <th>Caja</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalU" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalULabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModalUsuario">Nuevo usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="modalClose">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4" hidden>
                    <label for="idUser">id</label>
                    <input type="text" id="idUser" name="idUser" class="form-control" readonly>
                </div>
                <form action="" id="formNewUser" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 justify-content-start d-flex row">

                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" pattern="[A-Za-z ]+" title="Solo se permiten letras" class="form-control" required>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <label for="apellidoP">Apellido paterno</label>
                        <input type="text" id="apellidoP" name="apellidoP" pattern="[A-Za-z]+" title="Solo se permiten letras" class="form-control" required>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <label for="apellidoM">Apellido materno</label>
                        <input type="text" id="apellidoM" name="apellidoM" pattern="[A-Za-z]+" title="Solo se permiten letras" class="form-control" required>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <label for="caja">Caja</label>
                        <select id="caja" name="caja" class="form-control" required>
                        </select>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4"></div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4"></div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <label for="user">Usuario</label>
                        <input type="text" id="user" name="user" pattern="[A-Za-z0-9]+" title="Solo se permiten letras y números" class="form-control" required>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <label for="pass">Contraseña</label>
                        <input type="password" id="pass" name="pass" pattern="[A-Za-z0-9]+" title="Solo se permiten letras y números" class="form-control">
                        <p class="text-muted" id="mPass"></p>
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <label for="cPass">Confirmar contraseña</label>
                        <input type="password" id="cPass" name="cPass" pattern="[A-Za-z0-9]+" title="Solo se permiten letras y números" class="form-control">
                        <p class="text-muted" id="mCPass"></p>
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 justify-content-center d-flex mt-3">
                        <button type="reset" class="btn btn-secondary mr-2" id="btnLimpiarF">Limpiar</button>
                        <button type="submit" class="btn btn-success" id="saveUser">Guardar</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>


<?php include "views/template/footer.php"; ?>
<script src="<?php echo base_url; ?>assets/js/usuarios.js"></script>
</body>

</html>