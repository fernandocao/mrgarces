
<!-- Modal registrar cliente -->
<div class="modal fade" id="modalagregarpersonal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="card-header">
                    <p class="h4">Registro</p>
                </div>
                <form method="post" id="frmregistrarbarbero" name="frmregistrarbarbero">
                    <div class="card-body">                        
                        <input type="text" id="id_persona" name="id_persona" value="0" hidden />
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group col-md-12 text-center" style="color:#AAA" id="div_foto">
                                        <a href="#" class="fa fa-user-circle-o fa-5x" id="btnfalso" data-toggle="file" aria-hidden="true"><img src="" id="fotografia"></a>
                                        <input value="Añadir foto" id="btn_foto" name="btn_foto" type="file" hidden />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Nombre</label>
                                <input type="text" class="form-control rounded-0" id="nombre" name="nombre" required />
                            </div>
                            <div class="form-group col-md-4">
                                <label>A. Paterno</label>
                                <input type="text" class="form-control rounded-0" id="apellido_paterno" name="apellido_paterno" required />
                            </div>
                            <div class="form-group col-md-4">
                                <label>A. Materno</label>
                                <input type="text" class="form-control rounded-0" id="apellido_materno" name="apellido_materno" />
                            </div>
                        </div>
                        <!-- Solo clientes -->
                        <div id="divclientes" hidden>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Fecha de Nacimiento</label>
                                    <input type="date" class="form-control rounded-0" id="fecha_de_nacimiento" name="fecha_de_nacimiento" />
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Correo</label>
                                    <input type="email" class="form-control rounded-0" id="correo" name="correo" />
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Telefono</label>
                                    <input type="number" class="form-control rounded-0" id="telefono" name="telefono" />
                                </div>
                            </div>
                            <div class="row" id="redessociales" >
                                <div class="form-group col-md-6">
                                    <label>Facebook</label>
                                    <input type="text" class="form-control rounded-0" id="facebook" name="facebook" value="NA" />
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Instagram</label>
                                    <input type="text" class="form-control rounded-0" id="instagram" name="instagram" value="NA" />
                                </div>
                            </div>    
                        </div>                    
                        <!-- Solo personal -->
                        <div id="divpersonal" hidden>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Calle</label>
                                    <input type="text" class="form-control rounded-0" id="calle" name="calle">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>N° Int</label>
                                    <input type="number" class="form-control rounded-0" id="numero_interior" name="numero_interior">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Colonia</label>
                                    <input type="text" class="form-control rounded-0" id="colonia" name="colonia">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Ciudad</label>
                                    <input type="text" class="form-control rounded-0" id="ciudad" name="ciudad">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Estado</label>
                                    <input type="text" class="form-control rounded-0" id="estado" name="estado">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Usuario</label>
                                    <input type="text" class="form-control rounded-0" id="usuario" name="usuario">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Contraseña</label>
                                    <input type="password" class="form-control rounded-0" id="password" name="password">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Tipo</label>
                                    <select class="form-control rounded-0" id="tipo" name="tipo">
                                        <option value="0">Seleccione una opción</option>
                                        <option value="1">Usuario del sistema</option>
                                        <option value="2">Barbero</option>
                                        <option value="3">Empleado</option>
                                        <option value="5" hidden>Clientes</option>
                                    </select>
                                </div>
                            </div>  

                            <hr class="featurette-divider">
                            <p class="h3 text-center">Contacto de emergencia</p>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control rounded-0" id="nombrecontacto" name="nombrecontacto">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>A. Paterno</label>
                                    <input type="text" class="form-control rounded-0" id="paternocontacto" name="paternocontacto">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>A. Materno</label>
                                    <input type="text" class="form-control rounded-0" id="maternocontacto" name="maternocontacto">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Calle</label>
                                    <input type="text" class="form-control rounded-0" id="callecontacto" name="callecontacto">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>N° Int</label>
                                    <input type="number" class="form-control rounded-0" id="numerointeriorcontacto" name="numerointeriorcontacto">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Colonia</label>
                                    <input type="text" class="form-control rounded-0" id="coloniacontacto" name="coloniacontacto">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Ciudad</label>
                                    <input type="text" class="form-control rounded-0" id="ciudadcontacto" name="ciudadcontacto">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Estado</label>
                                    <input type="text" class="form-control rounded-0" id="estadocontacto" name="estadocontacto">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Parentesco</label>
                                    <select class="form-control rounded-0" id="parentescocontacto" name="parentescocontacto">
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Telefono</label>
                                    <input type="number" class="form-control rounded-0" id="telefonocontacto" name="telefonocontacto">
                                </div>
                            </div>



                            <hr class="featurette-divider">
                            <div class="row">
                                <h5 class="modal-title text-white" id="exampleModalLabel">Historial medico</h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Tipo sangre</label>
                                    <select class="form-control rounded-0" id="tiposangre" name="tiposangre" >
                                          <option value="NA" disabled selected>seleccione una opción</option>
                                          <option >A+</option>
                                          <option >A-</option>
                                          <option >B+</option>
                                          <option >B-</option>
                                          <option >O+</option>
                                          <option >O-</option>
                                          <option >AB+</option>
                                          <option >AB-</option>
                                      </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>¿Algun padecimiento?</label>
                                    <select class="form-control rounded-0" id="padecimiento" name="padecimiento">                                      
                                          <option value="1">No</option>
                                          <option value="2">Sí</option>
                                      </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Especifique</label>
                                    <input type="text" class="form-control rounded-0" id="especifiquepadecimiento" name="especifiquepadecimiento" disabled >
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>¿Alergico algun medicamento?</label>
                                    <select class="form-control rounded-0" id="medicamento" name="medicamento">                                      
                                          <option value="1">No</option>
                                          <option value="2">Sí</option>
                                      </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Especifique</label>
                                    <input type="text" class="form-control rounded-0" id="especifiquemedicamento" name="especifiquemedicamento" disabled >
                                </div>
                            </div>
                                
                            <div id="divbarbero" hidden>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>Habilidades y/o técnicas de Barbería</label>
                                        <input type="text" class="form-control rounded-0" id="descripcion_habilidad" name="descripcion_habilidad">
                                        <a class="btn btn-secondary rounded-0" id="btnagregarhabilidad">Agregar</a> 

                                        <a class="btn btn-secondary rounded-0" id="btnquitarhabilidad">Quitar</a>                             
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <select class="form-control rounded-0" rows="4" multiple id="habilidades" name="habilidades[]">
                                            
                                        </select>
                                    </div>
                                </div>                             
                            </div>                                                 
                        </div>
                    </div>
         
                    <div class="modal-footer">
                        <div class="form-group col-12">
                            <input type="submit" class="btn btn-secondary rounded-0 float-right" value="Registrar usuario" id="btnregistrarbarbero" name="registrarbarbero">
                            <a type="button" class="btn btn-outline-secondary rounded-0 float-right mr-3"  data-dismiss="modal">Cerrar</a>
                        </div>
                    </div>
                </form>
            </div>                
        </div>
    </div> <!-- container wrapper cabecera   -->          
</div>

<div class="modal fade" id="modalverperfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="card-header">
                    <p class="h4">Ver perfil</p>
                </div>
                <div class="card-body">   
                    <div class="row"id="contenedorperfil"> </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group col-md-12">
                        <a type="button" class="btn btn-secondary rounded-0 float-right mr-3 text-white" data-dismiss="modal">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>