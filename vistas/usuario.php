<?php 
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{

require 'header.php';
if ($_SESSION['acceso']==1) {
 ?>
    <div class="content-wrapper">
    <section class="content">

      <!-- Pagina default -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
  <h1 class="box-title">Usuarios <button class="btn btn-success"  id="btnagregar" data-toggle="modal" data-target="#formularioregistros"><i class="fa fa-plus-circle"></i>Agregar</button></h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros">
  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <th>Opciones</th>
      <th>Nombre</th>
      <th>Documento</th>
      <th>Numero Documento</th>
      <th>Telefono</th>
      <th>Email</th>
      <th>Login</th>
      <th>Foto</th>
      <th>Estado</th>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <th>Opciones</th>
      <th>Nombre</th>
      <th>Documento</th>
      <th>Numero Documento</th>
      <th>Telefono</th>
      <th>Email</th>
      <th>Login</th>
      <th>Foto</th>
      <th>Estado</th>
    </tfoot>   
  </table>
</div>
<div class="panel-body modal fade" id="formularioregistros" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Gestion de usuarios</h4>
      </div>
      <div class="modal-body">
        <form action="" name="formulario" id="formulario" method="POST">
          <div class="form-group col-lg-6 col-md-6 col-xs-6">
            <label for="">Nombre(*):</label>
            <input class="form-control" type="hidden" name="idusuario" id="idusuario">
            <input class="form-control" type="text" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" required>
          </div>
          <div class="form-group col-lg-6 col-md-6 col-xs-6">
            <label for="">Apellido(*):</label>
            <input class="form-control" type="text" name="apellido" id="apellido" maxlength="100" placeholder="Apellido" required>
          </div>
          <div class="form-group col-lg-6 col-md-6 col-xs-12">
            <label for="">Email(*): </label>
            <input class="form-control" type="email" name="email" id="email" maxlength="70" placeholder="email" require>
          </div>
          <div class="form-group col-lg-6 col-md-6 col-xs-12">
            <label for="">Imagen:</label>
            <input class="form-control" type="file" name="imagen" id="imagen">
            <input type="hidden" name="imagenactual" id="imagenactual">
            <img src="" alt="" width="150px" height="120" id="imagenmuestra">
          </div>
          
          <ul class="nav nav-pills">
            <li class="active"><a data-toggle="pill" href="#home">Datos personales</a></li>
            <li><a data-toggle="pill" href="#menu1">Seguridad</a></li>
          </ul>  
          <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
              <h3>Datos personales</h3>
              <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <label for="">Tipo Documento(*):</label>
                <select name="tipo_documento" id="tipo_documento" class="form-control select-picker" required>
                  <option value="NINGUNO">NINGUNO</option>
                  <option value="RUC">RUC</option>
                  <option value="CEDULA">CEDULA</option>
                </select>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <label for="">Número de Documento:</label>
                <input type="text" class="form-control" name="num_documento" id="num_documento" placeholder="Documento" maxlength="20">
              </div>
              <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <label for="">Dirección</label>
                <input class="form-control" type="text" name="direccion" id="direccion" placeholder="Dirección" maxlength="70">
              </div>
              <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <label for="">Teléfono</label>
                <input class="form-control" type="text" name="telefono" id="telefono" maxlength="20" placeholder="Número de teléfono">
              </div>
            </div>
            <div id="menu1" class="tab-pane fade">
              <h3>Seguridad</h3>
              <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <label for="">Rol</label>
                <select name="cargo" id="cargo" class="form-control selectpicker" data-live-search="true" required>

                </select>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <label for="">Login(*):</label>
                <input class="form-control" type="text" name="login" id="login" maxlength="20" placeholder="nombre de usuario" required>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <label for="">Clave(*):</label>
                <input class="form-control" type="password" name="clave" id="clave" maxlength="64" placeholder="Clave">
              </div>
            </div>
          </div>

          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>  Guardar</button>
            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--fin centro-->
      </div>
      </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
<?php 
}else{
 require 'noacceso.php'; 
}
require 'footer.php';
 ?>
 <script src="scripts/usuario.js"></script>
 <?php 
}

ob_end_flush();
  ?>
