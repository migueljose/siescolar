<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pensum_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('pensum_model');
		$this->load->library('form_validation');
		//$this->load->database('default');
	}

	
	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		//$this->load->view('estudiantes/registrar2');
		$this->template->load('roles/rol_administrador_vista', 'pensum/pensum_vista');
	}

	public function insertar(){

        $this->form_validation->set_rules('id_grado', 'grado', 'required|numeric');
        $this->form_validation->set_rules('id_asignatura', 'asignatura', 'required|numeric');
        $this->form_validation->set_rules('intensidad_horaria', 'horas', 'required|numeric');
        $this->form_validation->set_rules('ano_lectivo', 'año lectivo', 'required|min_length[1]|max_length[4]');
        $this->form_validation->set_rules('estado_pensum', 'estado', 'required|alpha_spaces');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	//obtengo el ultimo id de pensum + 1 
        	 $ultimo_id = $this->pensum_model->obtener_ultimo_id();

        	  //array para insertar en la tabla pensum----------
        	$pensum = array(
        	'id_pensum' =>$ultimo_id,	
			'id_grado' =>$this->input->post('id_grado'),
			'id_asignatura' =>$this->input->post('id_asignatura'),
			'intensidad_horaria' =>$this->input->post('intensidad_horaria'),
			'ano_lectivo' =>$this->input->post('ano_lectivo'),
			'estado_pensum' =>$this->input->post('estado_pensum'));

			if ($this->pensum_model->validar_existencia($this->input->post('id_grado'),$this->input->post('id_asignatura'))){

				$respuesta=$this->pensum_model->insertar_pensum($pensum);

				if($respuesta==true){

					echo "registroguardado";
				}
				else{

					echo "registronoguardado";
				}

			}
			else{

				echo "pensum ya existe";
			}

        }

	}

	public function mostrarpensum(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'pensum' => $this->pensum_model->buscar_pensum($id,$inicio,$cantidad),

		    'totalregistros' => count($this->pensum_model->buscar_pensum($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}

	public function eliminar(){

	  	$id =$this->input->post('id'); 

        if(is_numeric($id)){

			
	        $respuesta=$this->pensum_model->eliminar_pensum($id);
	        
          	if($respuesta==true){
              
              	echo "eliminado correctamente";
          	}else{
              
              	echo "no se pudo eliminar";
          	}
          
        }else{
          
          	echo "digite valor numerico para identificar un pensum";
        }
    }

    public function modificar(){

    	//array para insertar en la tabla pensum----------
        $pensum = array(
        'id_pensum' =>$this->input->post('id_pensum'),	
		'id_grado' =>$this->input->post('id_grado'),
		'id_asignatura' =>$this->input->post('id_asignatura'),
		'intensidad_horaria' =>$this->input->post('intensidad_horaria'),
		'ano_lectivo' =>$this->input->post('ano_lectivo'),
		'estado_pensum' =>$this->input->post('estado_pensum'));

		$id = $this->input->post('id_pensum');
		$grado_buscado = $this->pensum_model->obtener_id_grado($id);
		$asignatura_buscada = $this->pensum_model->obtener_id_asignatura($id);
		//$ano_lectivo_buscado = $this->pensum_model->obtener_ano_lectivo($id);

        if(is_numeric($id)){

        	if ($grado_buscado == $this->input->post('id_grado') && $asignatura_buscada == $this->input->post('id_asignatura')){

	        	$respuesta=$this->pensum_model->modificar_pensum($this->input->post('id_pensum'),$pensum);

				 if($respuesta==true){

					echo "registro actualizado";

	             }else{

					echo "registro no se pudo actualizar";

	             }
	        }
	        else{

	        	if($this->pensum_model->validar_existencia($this->input->post('id_grado'),$this->input->post('id_asignatura'))){

	        		$respuesta=$this->pensum_model->modificar_pensum($this->input->post('id_pensum'),$pensum);

	        		if($respuesta==true){

	        			echo "registro actualizado";

	        		}else{

	        			echo "registro no se pudo actualizar";
	        		}



	        	}else{

	        		echo "pensum ya existe";

	        	}

				
			}    
                
         
        }else{
            
            echo "digite valor numerico para identificar un pensum";
        }




    }

    public function llenarcombo_anos_lectivos(){

    	$consulta = $this->pensum_model->llenar_anos_lectivos();
    	echo json_encode($consulta);
    }

    public function llenarcombo_asignaturas(){

    	$consulta = $this->pensum_model->llenar_asignaturas();
    	echo json_encode($consulta);
    }

    public function llenarcombo_grados(){

    	$consulta = $this->pensum_model->llenar_grados();
    	echo json_encode($consulta);
    }


}