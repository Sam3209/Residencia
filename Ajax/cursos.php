<?php 
require_once "../modelos/Cursos.php";

$cursos=new Cursos();

$id=isset($_POST["idcurso"])? limpiarCadena($_POST["idcurso"]):"";
$name=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$team_id=isset($_POST["idgrupo"])? limpiarCadena($_POST["idgrupo"]):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
	if (empty($id)) {
		$rspta=$cursos->insertar($name,$team_id);
		echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar los datos";
	}else{
         $rspta=$cursos->editar($id,$name,$team_id);
		echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
	}
		break;
	

	case 'desactivar':
		$rspta=$cursos->desactivar($id);
		echo $rspta ? "Datos desactivados correctamente" : "No se pudo desactivar los datos";
		break;
	case 'activar':
		$rspta=$cursos->activar($id);
		echo $rspta ? "Datos activados correctamente" : "No se pudo activar los datos";
		break;
	
	case 'mostrar':
		$rspta=$cursos->mostrar($id);
		echo json_encode($rspta);
		break;

    case 'listar':
        $team_id=$_REQUEST["idgrupo"];

		$rspta=$cursos->listar($team_id);
		
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
            "0"=>'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->id.')"><i class="fa fa-close"></i></button>',
            "1"=>$reg->name
              );
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);   
		break;

		case 'selectCursos':
        $team_id=$_REQUEST["idgrupo"];

		$rspta=$cursos->listar($team_id);
			echo '<option value="0">seleccione...</option>';

			while ($reg = $rspta->fetch_object()) {
				echo '<option value='.$reg->id.'>'.$reg->name.'</option>';
			}
			break;

}
 ?>