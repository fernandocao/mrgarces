    <div class="container-fluid">
        <div class="card rounded-0 mt-5 mb-5">
            <div class="card-header bg-dark text-white">
                <p class="h3 text-center">REGISTRO PROVEEDOR</p>
            </div>
            <div class="card-body">
                <form method="" id="frmregistroproveedor" name="frmregistroproveedor">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Nombre Comercial</label>
                            <input type="text" class="form-control rounded-0" id="nombre_comercial" name="nombre_comercial" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>R.F.C.</label>
                            <input type="text" class="form-control rounded-0" id="rfc" name="rfc" required>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Calle</label>
                            <input type="text" class="form-control rounded-0" id="calle" name="calle" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Número</label>
                            <input type="number" class="form-control rounded-0" id="numero" name="numero" min=1 required>
                        </div>
                        <div class="form-group col-md-2">
                            <label>N° Interior</label>
                            <input type="number" class="form-control rounded-0" id="numero" name="numero" min=1>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Colonia</label>
                            <input type="text" class="form-control rounded-0" id="colonia" name="colonia" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Ciudad</label>
                            <input type="text" class="form-control rounded-0" id="ciudad" name="ciudad" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Estado</label>
                            <input type="text" class="form-control rounded-0" id="estado" name="estado" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Télefono</label>
                            <input type="text" class="form-control rounded-0" id="telefono" name="telefono" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Correo</label>
                            <input type="email" class="form-control rounded-0" id="correo" name="correo" required>
                        </div>
                                        
                        <div class="form-group col-md-4">
                            <label>Página web</label>
                            <input type="text" class="form-control rounded-0" id="pagina_web" name="pagina_web" required>
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
                                    <input type="text" class="form-control rounded-0" id="nombre_contacto" name="nombre_contacto" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Télefono</label>
                                    <input type="text" class="form-control rounded-0" id="telefono_contacto" name="telefono_contacto" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Correo</label>
                                    <input type="email" class="form-control rounded-0" id="correo_contacto" name="correo_contacto" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="form-group col-12">
                            <input type="submit" class="btn btn-secondary rounded-0 float-right" value="Registrar usuario" id="btnregistrarproveedor" name="btnregistrarproveedor">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>