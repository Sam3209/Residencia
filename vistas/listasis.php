<?php
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{


require 'header.php';

if ($_SESSION['grupos']==1) {

 ?>
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<!--box-header-->
<!--centro-->
 

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <input type="hidden" id="idgrupo" name="idgrupo" value="<?php echo $_GET["idgrupo"];?>">
          <!-- Custom Tabs (Pulled to the right) -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li class="bg-green">
                 <a href="../vistas/vista_grupo.php?idgrupo=<?php echo $_GET["idgrupo"]; ?>"><i class='fa fa-arrow-circle-left'></i> Volver</a>
              </li>
              <li class="bg-aqua"><a href="#tab_1-1" data-toggle="tab" aria-expanded="false">Calificaciones</a></li>
              <li class="bg-yellow"><a href="#tab_2-2" data-toggle="tab" aria-expanded="false">Comportamiento</a></li>
              <li class="active bg-green"><a href="#tab_3-2" data-toggle="tab" aria-expanded="true">Asistencia</a></li>
              <li class="pull-left header"><i class="fa fa-list"></i> Listas</li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane" id="tab_1-1">

                <div class="panel-body table-responsive" id="listadoregistroscalif">
                  <div id="datacalif">

                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2-2">
                <div class="table-responsive" id="listadoregistros">
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Fecha Inicio</label>
                    <input type="date" class="form-control" name="fecha_inicioc" id="fecha_inicioc" value="<?php echo date("Y-m-d"); ?>">
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Fecha Fin</label>
                    <input type="date" class="form-control" name="fecha_finc" id="fecha_finc" value="<?php echo date("Y-m-d"); ?>">
                  </div>
                </div>
                <div class="panel-body table-responsive" id="listadoregistrosc">
                  <div id="datac">

                  </div>
                </div>
              </div>

              <!-- /.tab-pane -->
              <div class="tab-pane active" id="tab_3-2">
                <div class="table-responsive" id="listadoregistros">
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Fecha Inicio</label>
                    <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" value="<?php echo date("Y-m-d"); ?>">
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Fecha Fin</label>
                    <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" value="<?php echo date("Y-m-d"); ?>">
                  </div>
                </div>
                <div class="panel-body table-responsive" id="listadoregistros">
                  <div id="data">

                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
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
 <script src="scripts/listasis.js"></script>
 <?php 
}

ob_end_flush();
  ?>

