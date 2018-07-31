<div class="modal fade agregarproveedor rounded-0" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header rounded-0">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">REGISTRO PROVEEDOR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <div class="modal-body">

                <form method="post" id="frmregistrarproveedor" name="frmregistrarproveedor">
                    <input type="text" id="id_proveedor" name="id_proveedor" value="0" hidden />
                    <input type="text" id="id_direccion" name="id_direccion" value="0" hidden />

                       <div class="row">
                        <div class="form-group col-md-6">
                            <label>Nombre Comercial</label>
                            <input type="text" class="form-control rounded-0" id="nombre_comercial" name="nombre_comercial"  maxlength="35" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>R.F.C.</label>
                            <input type="text" class="form-control rounded-0" id="rfc" name="rfc" maxlength="13" required>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Calle</label>
                            <input type="text" class="form-control rounded-0" id="calle" name="calle" maxlength="50" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Número</label>
                            <input type="number" class="form-control rounded-0" id="numero" name="numero" min=1 required>
                        </div>
                        <div class="form-group col-md-2">
                            <label>N° Interior</label>
                            <input type="number" class="form-control rounded-0" id="numero_interior" name="numero_interior" min=1>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Colonia</label>
                            <input type="text" class="form-control rounded-0" id="colonia" name="colonia" maxlength="50" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Ciudad</label>
                            <input type="text" class="form-control rounded-0" id="ciudad" name="ciudad" maxlength="50" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Estado</label>
                            <input type="text" class="form-control rounded-0" id="estado" name="estado" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Télefono</label>
                            <input type="number" class="form-control rounded-0" id="telefono" name="telefono" maxlength="10" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Correo</label>
                            <input type="email" class="form-control rounded-0" id="correo" name="correo"  maxlength="50" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Página web</label>
                            <input type="text" class="form-control rounded-0" id="pagina_web" name="pagina_web" maxlength="50" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>¿Maneja crédito?</label>
                            <select class="form-control rounded-0" id="maneja_credito" name="maneja_credito">
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5>Datos de contacto dentro de la empresa</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Nombre Completo</label>
                                    <input type="text" class="form-control rounded-0" id="nombre_contacto" name="nombre_contacto" maxlength="100" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Télefono</label>
                                    <input type="text" class="form-control rounded-0" id="telefono_contacto" name="telefono_contacto" maxlength="10" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Correo</label>
                                    <input type="email" class="form-control rounded-0" id="correo_contacto" name="correo_contacto" maxlength="35" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="form-group col-12">
                            <input type="submit" class="btn btn-secondary rounded-0 float-right" id="btnregistrarproveedor" name="btnregistrarproveedor">
                            <a type="button" class="btn btn-secondary rounded-0 float-right mr-3 text-white" data-dismiss="modal">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade perfilproveedor rounded-0" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header rounded-0">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">PERFIL PROVEEDOR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <div class="modal-body">
            <div class="row" id="contenedorperfil"> 
                </div>
                   <div class="row mt-3">
                        <div class="form-group col-12">
                            <a type="button" class="btn btn-secondary rounded-0 float-right mr-3 text-white" data-dismiss="modal">Cancelar</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">var urlproveedor="<?php echo site_url('proveedores/Administrar_proveedor'); ?>";</script>