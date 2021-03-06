<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Matriculas_model extends CI_Model {


	public function insertar_matricula($matricula,$est_acud){
		if ($this->db->insert('matriculas', $matricula) && $this->db->insert('estudiantes_acudientes', $est_acud)) 
			return true;
		else
			return false;
	}

	public function validar_existencia($id_persona,$ano_lectivo){

		$this->db->where('id_estudiante',$id_persona);
		$this->db->where('ano_lectivo',$ano_lectivo);
		$query = $this->db->get('matriculas');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}

	public function buscar_matricula($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->like('personas.identificacion',$id,'after');
		$this->db->or_like('personas.nombres',$id,'after');
		$this->db->or_like('personas.apellido1',$id,'after');
		$this->db->or_like('grados.nombre_grado',$id,'after');
		$this->db->or_like('grupos.nombre_grupo',$id,'after');
		$this->db->or_like('matriculas.jornada',$id,'after');
		$this->db->or_like('anos_lectivos.nombre_ano_lectivo',$id,'after');

		$this->db->order_by('matriculas.ano_lectivo', 'desc');
		$this->db->order_by('matriculas.fecha_matricula', 'asc');

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');
		$this->db->join('cursos', 'matriculas.id_curso = cursos.id_curso');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('anos_lectivos', 'matriculas.ano_lectivo = anos_lectivos.id_ano_lectivo');

		$this->db->select('matriculas.id_matricula,matriculas.fecha_matricula,matriculas.ano_lectivo,matriculas.id_estudiante,matriculas.id_curso,grados.nombre_grado,grupos.nombre_grupo,matriculas.jornada,matriculas.id_acudiente,matriculas.parentesco,matriculas.observaciones,matriculas.estado_matricula,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2,anos_lectivos.nombre_ano_lectivo');
		
		$query = $this->db->get('matriculas');

		return $query->result();
		
	}

	public function eliminar_matricula($id,$id_estudiante,$ano_lectivo){

       	$this->db->trans_start();
		$this->db->where('id_matricula',$id);
		$this->db->delete('matriculas');

		$this->db->where('id_estudiante',$id_estudiante);
		$this->db->where('ano_lectivo',$ano_lectivo);
		$this->db->delete('estudiantes_acudientes');
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){

			return false;
		}
		else{

			return true;
		}
    }

    public function modificar_matricula($id,$matricula,$est_acud,$id_estudiante,$ano_lectivo){

		$this->db->trans_start();
		$this->db->where('id_matricula',$id);
		$this->db->update('matriculas', $matricula);

		$this->db->where('id_estudiante',$id_estudiante);
		$this->db->where('ano_lectivo',$ano_lectivo);
		$this->db->update('estudiantes_acudientes', $est_acud);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){

			return false;
		}
		else{

			return true;
		}
	}


	public function obtener_ultimo_id(){

		$this->db->select_max('id_matricula');
		$query = $this->db->get('matriculas');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_matricula'];
        return $data['query'];
	}


	public function buscar_estudiante($id){

		$this->db->where('personas.identificacion',$id);

		$this->db->join('estudiantes', 'personas.id_persona = estudiantes.id_persona');

		$this->db->select('personas.id_persona,personas.identificacion,personas.nombres,personas.apellido1,personas.apellido2');
		$query = $this->db->get('personas');

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		else{
			return false;
		}

	}


	public function llenar_cursos($jornada){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('cursos.jornada',$jornada);
		$this->db->where('cursos.ano_lectivo',$ano_lectivo);

		$this->db->order_by('grados_educacion.id_grado_educacion', 'asc');
		
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('salones', 'cursos.id_salon = salones.id_salon');
		$this->db->join('grados_educacion', 'grados.nombre_grado = grados_educacion.nombre_grado');//para organizar grados

		$this->db->select('cursos.id_curso,cursos.id_grado,cursos.id_grupo,cursos.id_salon,grados.nombre_grado,grupos.nombre_grupo,cursos.cupo_maximo');

		$query = $this->db->get('cursos');
		$row = $query->result_array();
		$total = $query->num_rows();
		$listaArray = array();

		for ($i=0; $i < $total ; $i++) { 
			
			$id_curso = $row[$i]['id_curso'];
			$cupo_maximo = $row[$i]['cupo_maximo'];
			$total_curso_matricula = $this->matriculas_model->total_cursos_matricula($id_curso);

			if ($total_curso_matricula < $cupo_maximo) {
			
				$this->db->where('id_curso',$id_curso);

				$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
				$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');

				$this->db->select('cursos.id_curso,cursos.id_grado,cursos.id_grupo,cursos.id_salon,grados.nombre_grado,grupos.nombre_grupo,cursos.jornada');

				$query2 = $this->db->get('cursos');

				$listaArray[] =$query2->row();

			}
		}

		return $listaArray;
	}


	public function validar_existencia_por_identificacion($identificacion,$ano_lectivo){

		$this->db->where('personas.identificacion',$identificacion);
		$this->db->where('ano_lectivo',$ano_lectivo);

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');
		$query = $this->db->get('matriculas');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}


	//Esta funcion me permite obtener el total de matriculas por salon de un respectivo año
	public function total_cursos_matricula($id_curso){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('id_curso',$id_curso);
		$this->db->where('ano_lectivo',$ano_lectivo);

		$query = $this->db->get('matriculas');

		return count($query->result());

	}


	//Esta Funcion me permite obtener el grado por el salon registrado en la tabla matricula
	public function obtener_gradoPorcurso($id_curso){

		$this->db->where('matriculas.id_curso',$id_curso);

		$this->db->join('cursos', 'matriculas.id_curso = cursos.id_curso');
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');

		$this->db->select('grados.id_grado');

		$query = $this->db->get('matriculas');

		if ($query->num_rows() > 0) {
		
			$row = $query->result_array();
        	return $row[0]['id_grado'];
		}
		else{
			return false;
		}

	}


	//Esta funcion me permite obtener las materias a cursar por un determinado grado dependiendo del pensum
	public function obtener_asignaturasPorgrados($id_grado){

		$this->db->where('id_grado',$id_grado);

		$this->db->select('pensum.id_asignatura');

		$query = $this->db->get('pensum');

		if ($query->num_rows() > 0) {
		
			return $query->result_array();
		}
		else{
			return false;
		}
		
	}


	//Esta Funcion me permite registrar las materias a cursar, por un estudiante, en la tabla notas
	public function insertar_asignaturasPorestudiantes($ano_lectivo,$id_estudiante,$id_grado,$id_asignatura){

		$sql= "INSERT INTO notas(ano_lectivo, id_estudiante, id_grado, id_asignatura) VALUES('". $ano_lectivo."','". $id_estudiante ."','". $id_grado ."','".$id_asignatura."')";

		if ($this->db->query($sql)) 
			return true;
		else
			return false;

	}


	//esta funcion me permite obtener informacion informacion de una matricula
	public function obtener_informacion_matricula($id_matricula){

		$this->db->where('id_matricula',$id_matricula);
		$query = $this->db->get('matriculas');

		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		else{
			return false;
		}

	}


	//esta funcion me permite eliminar las materias ya registradas a cursar por un estudiante en la tabla notas
	public function eliminar_asignaturasPorestudiantes($ano_lectivo,$id_estudiante){

     	$this->db->where('ano_lectivo',$ano_lectivo);
     	$this->db->where('id_estudiante',$id_estudiante);
		$consulta = $this->db->delete('notas');
       	if($consulta==true){

           return true;
       	}
       	else{

           return false;
       	}
    }

    //Esta funcion me permite obtener los acudientes activos
    public function llenar_acudientes(){

    	$this->db->where('acudientes.estado_acudiente',"Activo");
		$this->db->join('acudientes', 'personas.id_persona = acudientes.id_persona');
		$query = $this->db->get('personas');
		return $query->result();
	}

	
	public function llenar_cursos_actualizar($jornada,$ano_lectivo){

		$this->db->where('cursos.jornada',$jornada);
		$this->db->where('cursos.ano_lectivo',$ano_lectivo);
		
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('salones', 'cursos.id_salon = salones.id_salon');

		$this->db->select('cursos.id_curso,cursos.id_grado,cursos.id_grupo,cursos.id_salon,grados.nombre_grado,grupos.nombre_grupo,cursos.jornada');

		$query = $this->db->get('cursos');
		return $query->result_array();

	}


	//****************************************** FUNCIONES PARA MATRICULAR ESTUDIANTES ANTIGUOS ***************************************

	//Esta Funcion Permite Comprobar Si El Estudiante Es Nuevo O Antiguo.
	public function comprobar_NuevoAntiguo($identificacion){

		$this->db->where('personas.identificacion',$identificacion);

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');
		$query = $this->db->get('matriculas');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}

	//Esta Funcion Permite Obtener La Ultima Matricula De Un Estudiante.
	public function UltimaMatricula($identificacion){

		$this->db->where('personas.identificacion',$identificacion);

		$this->db->join('personas', 'matriculas.id_estudiante = personas.id_persona');

		$this->db->select_max('id_matricula');

		$query = $this->db->get('matriculas');

		if ($query->num_rows() > 0) {
			$row = $query->result_array();
			return $row[0]['id_matricula'];
		}
		else{
			return false;
		}

	}


	public function obtener_informacion_grado($id_grado){

		$this->db->where('id_grado',$id_grado);
		$query = $this->db->get('grados');

		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		else{
			return false;
		}

	}

	// Esta Funcion Permite Obtener El Proximo Grado A Cursar Por Un Estudiante.
	public function obtener_proximo_grado($nombre_grado){

		$this->db->where('nombre_grado',$nombre_grado);
		$query = $this->db->get('grados_educacion');

		if ($query->num_rows() > 0) {

			$consulta = $query->result_array();
			$id_grado_educacion = $consulta[0]['id_grado_educacion'];

			if ($id_grado_educacion == "14") {
				
				$id_grado_educacion_proximo = "1";

				$this->db->where('id_grado_educacion',$id_grado_educacion_proximo);
				$query2 = $this->db->get('grados_educacion');

				if ($query2->num_rows() > 0) {

					$row1 = $query2->result_array();
					return $row1[0]['nombre_grado'];
				}
				else{
					return false;
				}


			}
			else {
				
				$id_grado_educacion_proximo = $id_grado_educacion + 1;

				$this->db->where('id_grado_educacion',$id_grado_educacion_proximo);
				$query2 = $this->db->get('grados_educacion');

				if ($query2->num_rows() > 0) {

					$row2 = $query2->result_array();
					return $row2[0]['nombre_grado'];
				}
				else{
					return false;
				}
			}

			
		}
		else{
			return false;
		}

	}

  	//Esta Funcion Permite Obtener Los Cursos Que Puede Cursar Un Estudiante Antiguo, Dependiendo Del Estado Su Ultima Matricula.
	public function llenar_cursosA($jornada,$nombre_grado){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('cursos.jornada',$jornada);
		$this->db->where('cursos.ano_lectivo',$ano_lectivo);
		$this->db->where('grados.nombre_grado',$nombre_grado);

		$this->db->order_by('grupos.nombre_grupo', 'asc');
		
		$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
		$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');
		$this->db->join('salones', 'cursos.id_salon = salones.id_salon');

		$this->db->select('cursos.id_curso,cursos.id_grado,cursos.id_grupo,cursos.id_salon,grados.nombre_grado,grupos.nombre_grupo,cursos.cupo_maximo');

		$query = $this->db->get('cursos');
		$row = $query->result_array();
		$total = $query->num_rows();
		$listaArray = array();

		for ($i=0; $i < $total ; $i++) { 
			
			$id_curso = $row[$i]['id_curso'];
			$cupo_maximo = $row[$i]['cupo_maximo'];
			$total_curso_matricula = $this->matriculas_model->total_cursos_matricula($id_curso);

			if ($total_curso_matricula < $cupo_maximo) {
			
				$this->db->where('id_curso',$id_curso);

				$this->db->join('grados', 'cursos.id_grado = grados.id_grado');
				$this->db->join('grupos', 'cursos.id_grupo = grupos.id_grupo');

				$this->db->select('cursos.id_curso,cursos.id_grado,cursos.id_grupo,cursos.id_salon,grados.nombre_grado,grupos.nombre_grupo,cursos.jornada');

				$query2 = $this->db->get('cursos');

				$listaArray[] =$query2->row();

			}
		}

		return $listaArray;
	}


}