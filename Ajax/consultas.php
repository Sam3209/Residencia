<?php 
require_once "../modelos/Consultas.php";
if (strlen(session_id())<1) 
    session_start();

$consulta = new Consultas();


$user_id=$_SESSION["idusuario"];


switch ($_GET["op"]) {
	
 
    case 'lista_asistencia':
        $fecha_inicio=$_REQUEST["fecha_inicio"];
        $fecha_fin=$_REQUEST["fecha_fin"];
        $team_id=$_REQUEST["idgrupo"];

        $range = 0;
        if($fecha_inicio<=$fecha_fin){
            $range= ((strtotime($fecha_fin)-strtotime($fecha_inicio))+(24*60*60)) /(24*60*60);
            if($range>31){
                echo "<p class='alert alert-warning'>El Rango Maximo es 31 Dias.</p>";
                exit(0);
            }
        }else{
            echo "<p class='alert alert-danger'>Rango Invalido</p>";
            exit(0);
        }

        require_once "../modelos/Alumnos.php";
        $alumnos=new Alumnos();
        $team_id=$_REQUEST["idgrupo"];
        $rsptav=$alumnos->verficar_alumno($user_id,$team_id);


        if(!empty($rsptav)){
            // si hay usuarios
            ?>

        <table id="dataw" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
                <th>Nombre</th>
                <?php for($i=0;$i<$range;$i++){?>
                <th>
                <?php echo date("d-M",strtotime($fecha_inicio)+($i*(24*60*60)));?>
                </th>
                <?php }?>
            </thead>
            <?php
            $rspta=$alumnos->listar_calif($user_id,$team_id);
            while ($reg=$rspta->fetch_object()) {
                ?>
                <tr>
                    <td style="width:250px;"><?php echo $reg->name." ".$reg->lastname; ?></td>
                    <?php 
                    for($i=0;$i<$range;$i++){
                    $date_at= date("Y-m-d",strtotime($fecha_inicio)+($i*(24*60*60)));
                    $asist=$consulta->listar_asistencia($reg->idalumn,$team_id,$date_at);
                    $regc=$asist->fetch_object()
                    ?> 
                    <td >
                    <?php
                    if($regc!=null){
                        if($regc->kind_id==1){ echo "<strong>A</stron>"; }
                        else if($regc->kind_id==2){ echo "<strong>T</stron>"; }
                        else if($regc->kind_id==3){ echo "<strong>F</stron>"; }
                        else if($regc->kind_id==4){ echo "<strong>P</stron>"; }
                        
                    }   
                    ?>

                    </td>
                    <?php } ?>
                </tr>
            <?php }?>
        </table>
        <?php

        }else{
            echo "<p class='alert alert-danger'>No hay Alumnos</p>";
        }
        ?>

        <script type="text/javascript">         
            tabla=$('#dataw').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdf'
                    ]
                } );
        </script>
        <?php
    break;

    case 'lista_comportamiento':
        $fecha_inicio=$_REQUEST["fecha_inicioc"];
        $fecha_fin=$_REQUEST["fecha_finc"];
        $team_id=$_REQUEST["idgrupo"];

        $range = 0;
        if($fecha_inicio<=$fecha_fin){
            $range= ((strtotime($fecha_fin)-strtotime($fecha_inicio))+(24*60*60)) /(24*60*60);
            if($range>31){
                echo "<p class='alert alert-warning'>El Rango Maximo es 31 Dias.</p>";
                exit(0);
            }
        }else{
            echo "<p class='alert alert-danger'>Rango Invalido</p>";
            exit(0);
        }

        require_once "../modelos/Alumnos.php";
        $alumnos=new Alumnos();
        $team_id=$_REQUEST["idgrupo"];
        $rsptav=$alumnos->verficar_alumno($user_id,$team_id);


        if(!empty($rsptav)){
            // si hay usuarios
            ?>

        <table id="dataco" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
                <th>Nombre</th>
                <?php for($i=0;$i<$range;$i++){?>
                <th>
                <?php echo date("d-M",strtotime($fecha_inicio)+($i*(24*60*60)));?>
                </th>
                <?php }?>
            </thead>
            <?php
            $rspta=$alumnos->listar_calif($user_id,$team_id);
            while ($reg=$rspta->fetch_object()) {
                ?>
                <tr>
                    <td style="width:250px;"><?php echo $reg->name." ".$reg->lastname; ?></td>
                    <?php 
                    for($i=0;$i<$range;$i++){
                    $date_at= date("Y-m-d",strtotime($fecha_inicio)+($i*(24*60*60)));
                    $asist=$consulta->listar_comportamiento($reg->idalumn,$team_id,$date_at);
                    $regc=$asist->fetch_object()
                    ?> 
                    <td >
                    <?php
                    if($regc!=null){
                        if($regc->kind_id==1){ echo "<strong>N</stron>"; }
                        else if($regc->kind_id==2){ echo "<strong>B</stron>"; }
                        else if($regc->kind_id==3){ echo "<strong>E</stron>"; }
                        else if($regc->kind_id==4){ echo "<strong>M</stron>"; }
                        else if($regc->kind_id==5){ echo "<strong>MM</stron>"; }
                        
                    }   
                    ?>

                    </td>
                    <?php } ?>
                </tr>
            <?php }?>
        </table>
        <?php

        }else{
            echo "<p class='alert alert-danger'>No hay Alumnos</p>";
        }
        ?>

        <script type="text/javascript">         
            tabla=$('#dataco').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdf'
                    ]
                } );
        </script>
        <?php
    break;

    case 'listar_calificacion':

        require_once "../modelos/Alumnos.php";
        $alumnos=new Alumnos();
        $team_id=$_REQUEST["idgrupo"];
        $rsptav=$alumnos->verficar_alumno($user_id,$team_id);
        require_once "../modelos/Cursos.php";
        $cursos=new Cursos();
        $rsptac=$cursos->listar($team_id);
     //           $rsptacurso=$cursos->verficar_curso($team_id);

        if(!empty($rsptav)){


            // si hay usuarios
            ?>

        <table id="dataca" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
            <th>Nombre</th>
            <?php
            //OBTENEMOS LOS DAOTOS DEL CURSO
                while ($reg=$rsptac->fetch_object()) {
                      echo '<th>'.$reg->name.'</th>';
                }?>

            </thead>
            <?php
            //OBTENEMOS LOS DATOS DEL ALUMNO
            $rspta=$alumnos->listar_calif($user_id,$team_id);
            while ($reg=$rspta->fetch_object()) {
                ?>
                <tr>
                <td><?php echo $reg->name." ".$reg->lastname; ?></td>

                 <?php
                 //OBTENEMOS EL ID DEL CURSO
                require_once "../modelos/Cursos.php";
                $cursos=new Cursos();
                $rsptacurso=$cursos->listar($team_id);
                while ($regc=$rsptacurso->fetch_object()) {
                    $idcurso=$regc->id;
                    $idalumno=$reg->idalumn; 

                //OBTENEMOS LAS NOTAS ENVIANDO LOS PARAMETROS ($idcurso Y $idalumno)
                require_once "../modelos/Calificaciones.php";
                $calificaciones=new Calificaciones();
                $rsptacalif=$calificaciones->listar_calificacion($idalumno,$idcurso);
                  $regn=$rsptacalif->fetch_object();?>
                     <td><?php if($regn!=null ){
                                    echo $regn->val; 
                                }
                                 ?></td>




               <?php } ?>


                </tr>

                <?php





            }?>
            </table>
<?php
        }else{
            echo "<p class='alert alert-danger'>No hay Alumnos</p>";
        }
?>
        <script type="text/javascript">         
            tabla=$('#dataca').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdf'
                    ]
                } );
        </script>
<?php


    break;
}
 ?>