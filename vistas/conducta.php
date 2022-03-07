<?php 
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{

require 'header.php';
if ($_SESSION['grupos']==1) {

   /* if(isset($_GET['idgrupo'])) {
      $_SESSION['idgrupo'] = $_GET['idgrupo'];
    };*/
        $idgrupo=$_GET['idgrupo'];

  require_once "../modelos/Grupos.php";
  $grupos = new Grupos();
  $rspta = $grupos->mostrar_grupo($idgrupo);
  $reg=$rspta->fetch_object();
  $nombre_grupo=$reg->nombre;


 ?>
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
  <h1 class="box-title">Registro de conducta <?php echo $nombre_grupo; ?></h1>
  <div class="box-tools pull-right">
    <a href="../vistas/vista_grupo.php?idgrupo=<?php echo $idgrupo; ?>"><button class="btn btn-success"><i class='fa fa-arrow-circle-left'></i> Volver</button></a>
    <a href="../vistas/grupos.php"><button class="btn btn-info"><i class='fa fa-th-large'></i> Grupos</button></a>
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros">
  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <th>Opciones</th>
      <th>Imagen</th>
      <th>Nombre</th>
      <th>Apellidos</th>
      <th>Telefono</th>
      <th>Conducta</th>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <th>Opciones</th>
      <th>Imagen</th>
      <th>Nombre</th>
      <th>Apellidos</th>
      <th>Telefono</th>
      <th>Conducta</th>
    </tfoot>   
  </table>
</div>
<!--fin centro-->
      </div>
      </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>



  <!--Modal-->
  <div class="modal fade" id="getCodeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Seleccione...</h4>
        </div>
        <div class="modal-body">
  <form action="" name="formulario_asis" id="formulario_asis" method="POST">
      <div class="form-group col-lg-12 col-md-12 col-xs-12">
      <label for="">Descripcion(*):</label>
        <input type="hidden" id="idconducta" name="idconducta">
        <input type="hidden" id="alumn_id" name="alumn_id">
        <input type="hidden" id="fecha_conducta" name="fecha_conducta"> 
        <input type="hidden" id="idgrupo" name="idgrupo" value="<?php echo $_GET["idgrupo"];?>">
        <select class="form-control " id="tipo_conducta"  name="tipo_conducta">        
          <option value="1"> Normal</option>
          <option value="2"> Buena</option>
          <option value="3"> Excelente</option>
          <option value="4"> Mala</option>
          <option value="5"> Muy Mala</option>
        </select>

    </div>
    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar_asis"><i class="fa fa-save"></i>  Guardar</button>
      <button class="btn btn-danger pull-right" data-dismiss="modal" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>

    </div>
        </form>
        </div>
        <div class="modal-footer">

        </div>
      </div>
    </div>
  </div>








<?php 
}else{
 require 'noacceso.php'; 
}
require 'footer.php'
 ?>
 <script src="scripts/conducta.js"></script>

 <?php 
}

ob_end_flush();
  ?>