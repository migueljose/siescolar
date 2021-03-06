<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configuraciones_model extends CI_Model {


	public function insertar_datos_institucion($institucion){
		if ($this->db->insert('datos_institucion', $institucion)) 
			return true;
		else
			return false;
	}

	public function validar_existencia(){

		$query = $this->db->get('datos_institucion');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}

	public function modificar_datos_institucion($institucion){

		if ($this->db->update('datos_institucion', $institucion))

			return true;
		else
			return false;
	}


	public function obtener_ultimo_id(){

		$this->db->select_max('id');
		$query = $this->db->get('datos_institucion');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id'];
        return $data['query'];
	}


	public function buscar_datos_institucion(){

		$query = $this->db->get('datos_institucion');

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		else{
			return false;
		}

	}


	//**************************** FUNCIONES PERIODOS DE EVALUACION ****************************************
	public function validar_existencia_actividad($nombre,$ano_lectivo){

		$this->db->where('nombre_actividad',$nombre);
		$this->db->where('ano_lectivo',$ano_lectivo);
		$query = $this->db->get('cronogramas');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}


	public function obtener_ultimo_idactividad(){

		$this->db->select_max('id_actividad');
		$query = $this->db->get('cronogramas');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_actividad'];
        return $data['query'];
	}


	public function insertar_periodo($actividad){
		if ($this->db->insert('cronogramas', $actividad)) 
			return true;
		else
			return false;
	}


	public function buscar_periodo($id,$inicio = FALSE,$cantidad = FALSE){

		$this->load->model('funciones_globales_model');
		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

		$this->db->where('cronogramas.ano_lectivo',$ano_lectivo);

		$this->db->where("(cronogramas.nombre_actividad LIKE '".$id."%' OR cronogramas.estado_actividad LIKE '".$id."%')", NULL, FALSE);

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->select('cronogramas.id_actividad,cronogramas.nombre_actividad,cronogramas.fecha_inicial,cronogramas.fecha_final,cronogramas.estado_actividad,');
		
		$query = $this->db->get('cronogramas');

		return $query->result();
		
	}


	public function modificar_periodo($id_actividad,$actividad){

	
		$this->db->where('id_actividad',$id_actividad);

		if ($this->db->update('cronogramas', $actividad))

			return true;
		else
			return false;
	}


	//**************************** FUNCIONES AÑO LECTIVO ****************************************

	public function validar_existencia_anolectivo($nombre_ano_lectivo){

		$this->db->where('nombre_ano_lectivo',$nombre_ano_lectivo);
		$query = $this->db->get('anos_lectivos');

		if ($query->num_rows() > 0) {
			return false;
		}
		else{
			return true;
		}

	}


	public function obtener_ultimo_idanolectivo(){

		$this->db->select_max('id_ano_lectivo');
		$query = $this->db->get('anos_lectivos');

    	$row = $query->result_array();
        $data['query'] = 1 + $row[0]['id_ano_lectivo'];
        return $data['query'];
	}


	public function insertar_anolectivo($anolectivo){
		if ($this->db->insert('anos_lectivos', $anolectivo)) 
			return true;
		else
			return false;
	}


	public function buscar_anolectivo($id,$inicio = FALSE,$cantidad = FALSE){

		$this->db->like('nombre_ano_lectivo',$id,'after');
		$this->db->or_like('fecha_inicio',$id,'after');
		$this->db->or_like('fecha_fin',$id,'after');
		$this->db->or_like('estado_ano_lectivo',$id,'after');
		$this->db->or_like('seleccionado',$id,'after');

		$this->db->order_by('nombre_ano_lectivo', 'asc');

		if ($inicio !== FALSE && $cantidad !== FALSE) {
			$this->db->limit($cantidad,$inicio);
		}

		$this->db->select('id_ano_lectivo,nombre_ano_lectivo,fecha_inicio,fecha_fin,estado_ano_lectivo,seleccionado');
		
		$query = $this->db->get('anos_lectivos');

		return $query->result();
		
	}


	public function llenar_anolectivo(){

		$this->db->select_max('nombre_ano_lectivo');
		$query = $this->db->get('anos_lectivos');

		$row = $query->result_array();
		$nuevo_anolectivo = 1 + $row[0]['nombre_ano_lectivo'];

		//Utilizo un array para enviar el nuevo anolectivo en forma de result() o result_array()
		$array_anolectivo[] = array('nombre_ano_lectivo' => $nuevo_anolectivo);

		return $array_anolectivo;
	}


	public function modificar_anolectivo($id_ano_lectivo,$anolectivo){

		$this->db->where('id_ano_lectivo',$id_ano_lectivo);

		if ($this->db->update('anos_lectivos', $anolectivo))

			return true;
		else
			return false;
	}


	public function seleccionar_anolectivo($id_ano_lectivo){

		$seleccionado = array('seleccionado' => "Si");
		$noseleccionado = array('seleccionado' => "No");

		$this->db->trans_start();
		$this->db->where('seleccionado',"Si");
		$this->db->update('anos_lectivos', $noseleccionado);

		$this->db->where('id_ano_lectivo',$id_ano_lectivo);
		$this->db->update('anos_lectivos', $seleccionado);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){

			return false;
		}
		else{

			return true;
		}

    }


    //Esta Funcion me permite obtener el numero total de anoslectivos con estado activo
    public function anoslectivosActivos(){

    	$this->db->where('estado_ano_lectivo',"Activo");
		$query = $this->db->get('anos_lectivos');

		if ($query->num_rows() > 0) {
			return count($query->result());
		}
		else{
			return false;
		}

	}


	// Esta Funcion me permite obtener el estado de un anolectivo
	public function estado_anolectivo($id_ano_lectivo){

		$this->db->where('id_ano_lectivo',$id_ano_lectivo);
		$query = $this->db->get('anos_lectivos');

		if ($query->num_rows() > 0) {

			$row = $query->result_array();
			$estado = $row[0]['estado_ano_lectivo'];

			return $estado;
		}
		else{
			return false;
		}

	}
}