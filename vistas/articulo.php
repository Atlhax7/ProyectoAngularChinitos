<?php 
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{

require 'header.php';
if ($_SESSION['almacen']==1) {
 ?>
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
  <h1 class="box-title">Articulo <button class="btn btn-success" id="btnagregar" data-toggle="modal" data-target="#formularioregistros"><i class="fa fa-plus-circle"></i>Agregar</button> <a target="_blank" href="../reportes/rptarticulos.php"><button class="btn btn-info">Reporte</button></a></h1>
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
      <th>Categoria</th>
      <th>Codigo</th>
      <th>Stock</th>
      <th>Imagen</th>
      <th>Descripcion</th>
      <th>Estado</th>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
       <th>Opciones</th>
      <th>Nombre</th>
      <th>Categoria</th>
      <th>Codigo</th>
      <th>Stock</th>
      <th>Imagen</th>
      <th>Descripcion</th>
      <th>Estado</th>
    </tfoot>   
  </table>
</div>
<div class="panel-body modal fade" id="formularioregistros" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Gestion de productos</h4>
      </div>
      <div class="modal-body">
        <form action="" name="formulario" id="formulario" method="POST">
          <div class="form-group col-lg-6 col-md-6 col-xs-12">
            <label for="">Nombre(*):</label>
            <input class="form-control" type="hidden" name="idarticulo" id="idarticulo">
            <input class="form-control" type="text" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" required>
          </div>
          <div class="form-group col-lg-6 col-md-6 col-xs-12">
            <label for="">Imagen:</label>
            <input class="form-control" type="file" name="imagen" id="imagen">
            <input type="hidden" name="imagenactual" id="imagenactual">
            <img src="" alt="" width="150px" height="120" id="imagenmuestra">
          </div>

          <ul class="nav nav-pills">
            <li class="active"><a data-toggle="pill" href="#home">Descripcion</a></li>
            <li><a data-toggle="pill" href="#menu1">Codigo</a></li>
          </ul>
          <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
              <h3>Descripci??n</h3>
              <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <label for="">Descripci??n</label>
                <input class="form-control" type="text" name="descripcion" id="descripcion" maxlength="256" placeholder="Descripcion">
              </div>
              <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <label for="">Categoria(*):</label>
                <select name="idcategoria" id="idcategoria" class="form-control selectpicker" data-Live-search="true" required></select>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <label for="">Stock</label>
                <input class="form-control" type="number" name="stock" id="stock"  required>
              </div>
            </div>
            <div id="menu1" class="tab-pane fade">
              <h3>Codigo</h3>
              <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <label for="">Codigo:</label>
                <input class="form-control" type="text" name="codigo" id="codigo" placeholder="codigo del prodcuto" required>
                <button class="btn btn-success" type="button" onclick="generarbarcode()">Generar</button>
                <button class="btn btn-info" type="button" onclick="imprimir()">Imprimir</button>
                <div id="print">
                  <svg id="barcode"></svg>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>  Guardar</button>
            <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
          </div>
        </form>
      </div>
      <div class="modal-footer ">
      
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
require 'footer.php'
 ?>
 <script src="../public/js/JsBarcode.all.min.js"></script>
 <script src="../public/js/jquery.PrintArea.js"></script>
 <script src="scripts/articulo.js"></script>

 <?php 
}

ob_end_flush();
  ?>