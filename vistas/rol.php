<?php 
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{
  
require 'header.php';
if ($_SESSION['acceso']==1) {
 ?>
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
  <h1 class="box-title">Roles <button id="btnagregar" class="btn btn-success" data-toggle="modal" data-target="#formularioregistrosrol"><i class="fa fa-plus-circle"></i>Agregar</button></h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros">
  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
     <th>Nombre</th>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <th>Nombre</th>

    </tfoot>   
  </table>
</div>
<!--fin centro-->
<!--inicio modal -->
<div class="panel-body modal fade" id="formularioregistrosrol" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Gestion roles</h4>
      </div>
      <!--inicio cuerpo modal-->
      <div class="modal-body">
        <form action="" name="FormularioRol" id="FormularioRol" method="POST">
          <div class="form-group col-lg-6 col-md-6 col-xs-6">
            <label for="">Codigo Rol</label>
            <input class="form-control" type="text" name="Codigo_perfil" id="Codigo_perfil" maxlength="100" placeholder="" required>
          </div>
          <div class="form-group col-lg-6 col-md-6 col-xs-6">
            <label for="">Rol</label>
            <input class="form-control" type="text" name="Descripcion_perfil" id="Descripcion_perfil" maxlength="100" placeholder="" required>
          </div>
          <div class="form-group col-lg-6 col-md-6 col-xs-6">
            <label for="">Descripcion de rol a crear</label>
            <input class="form-control" type="text" name="Observaciones" id="Observaciones" maxlength="100" placeholder="" required>
          </div>
          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <button class="btn btn-primary" type="submit" id="btnGuardarRol"><i class="fa fa-save"></i>  Guardar</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
      <!--fin cuerpo modal-->
    </div>
  </div>
</div>
<!--seccion de creacion de rol-->
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
require 'footer.php'
 ?>
 <script src="scripts/permisos.js"></script>
 <?php 
}

ob_end_flush();
  ?>
