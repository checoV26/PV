<?php include "views/template/header.php"; ?>
<h1 class="h3 mb-2 text-gray-800">Proveedores</h1>
<div class="mb-2">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalP" id="btnP" name="btnP"><i class="fas fa-user-plus"></i></button>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista de proveedores</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-light" id="proveedorTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Pagina web</th>
                        <th>Descripción</th>
                        <th></th>
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
<div class="modal fade" id="modalP" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalPLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModalP">Nuevo proveedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="modalClose">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                    <label for="idProveedor">id</label>
                    <input type="text" id="idProveedor" name="idProveedor" class="form-control" readonly>
                </div>
                <form action="" id="formNewProveedor" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 justify-content-start d-flex row">

                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" pattern="[A-Za-z ]+" title="Solo se permiten letras" class="form-control" required>
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <label for="telefono">Teléfono</label>
                        <input type="text"  id="telefono" name="telefono" pattern="[0-9]{10}" title="Por favor ingresa 10 dígitos numéricos" class="form-control" required>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <label for="correo">Correo</label>
                        <input type="email" id="correo" name="correo" title="Solo se permiten letras" class="form-control" required>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <label for="pWeb">Pagina web</label>
                        <input type="url" id="pWeb" name="pWeb" class="form-control">
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <label for="desc">Descripción</label>
                        <input type="text" id="desc" name="desc" title="Solo se permiten letras" class="form-control">
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 justify-content-center d-flex mt-3">
                        <button type="reset" class="btn btn-secondary mr-2" id="btnLimpiarF">Limpiar</button>
                        <button type="submit" class="btn btn-success" id="savePro">Guardar</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
<?php include "views/template/footer.php"; ?>
<script src="<?php echo base_url; ?>assets/js/proveedores.js"></script>
</body>

</html>