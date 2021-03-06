<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estudiantes_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('estudiantes_model');
		$this->load->library('form_validation');
		//$this->load->database('default');
	}

	
	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		$this->template->load('roles/rol_administrador_vista', 'estudiantes/registrar');
	}

	public function index2()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		$this->template->load('roles/rol_administrador_vista', 'estudiantes/consultar');
	}


	public function insertar(){

		$this->form_validation->set_rules('identificacion', 'Identificación', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('nombres', 'Nombres', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido1', 'Primer Apellido', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido2', 'Segundo Apellido', 'required|alpha_spaces');
        $this->form_validation->set_rules('sexo', 'Sexo', 'required|min_length[1]|max_length[1]');
        $this->form_validation->set_rules('fecha_nacimiento', 'Fecha De Nacimiento', 'required');
        $this->form_validation->set_rules('departamento_nacimiento', 'Dpto. De Nacimiento', 'required');
        $this->form_validation->set_rules('municipio_nacimiento', 'Mcpio. De Nacimiento', 'required');
        $this->form_validation->set_rules('tipo_sangre', 'Tipo De Sangre', 'required');
        $this->form_validation->set_rules('eps', 'Eps', 'required|alpha_spaces');
        $this->form_validation->set_rules('poblacion', 'Poblacion', 'required|alpha_spaces');
        $this->form_validation->set_rules('correo', 'Correo', 'required|alpha_spaces');
        $this->form_validation->set_rules('direccion', 'Dirección', 'required|alpha_spaces');
        $this->form_validation->set_rules('telefono', 'Telefono', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('barrio', 'Barrio', 'required|alpha_spaces');
        $this->form_validation->set_rules('institucion_procedencia', 'I.E. De Procedencia', 'required|alpha_spaces');
        $this->form_validation->set_rules('discapacidad', 'Discapacidad', 'required|alpha_spaces');
        $this->form_validation->set_rules('grado_cursado', 'Grado Cursado', 'required');
        $this->form_validation->set_rules('anio', 'Año', 'required|numeric|max_length[4]');
        //Padre
        $this->form_validation->set_rules('identificacion_padre', 'Identificación Del Padre', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('nombres_padre', 'Nombres Del Padre', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido1_padre', 'Primer Apellido Del Padre', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido2_padre', 'Segundo Apellido Del Padre', 'required|alpha_spaces');
        $this->form_validation->set_rules('telefono', 'Telefono Del Padre', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('direccion_padre', 'Dirección Del Padre', 'required|alpha_spaces');
        $this->form_validation->set_rules('barrio_padre', 'Barrio Del Padre', 'required|alpha_spaces');
        $this->form_validation->set_rules('ocupacion_padre', 'Ocupacion Del Padre', 'required|alpha_spaces');
        $this->form_validation->set_rules('telefono_trabajo_padre', 'Telefono Trabajo Del Padre', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('direccion_trabajo_padre', 'Dirección Trabajo Del Padre', 'required|alpha_spaces');

        //Madre
        $this->form_validation->set_rules('identificacion_madre', 'Identificación De la madre', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('nombres_madre', 'Nombres De la madre', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido1_madre', 'Primer Apellido De la madre', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido2_madre', 'Segundo Apellido De la madre', 'required|alpha_spaces');
        $this->form_validation->set_rules('telefono', 'Telefono De la madre', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('direccion_madre', 'Dirección De la madre', 'required|alpha_spaces');
        $this->form_validation->set_rules('barrio_madre', 'Barrio De la madre', 'required|alpha_spaces');
        $this->form_validation->set_rules('ocupacion_madre', 'Ocupacion De la madre', 'required|alpha_spaces');
        $this->form_validation->set_rules('telefono_trabajo_madre', 'Telefono Trabajo De la madre', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('direccion_trabajo_madre', 'Dirección Trabajo De la madre', 'required|alpha_spaces');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();
        }
        else{
        	//obtengo el ultimo id de persona + 1 
        	 $ultimo_id = $this->estudiantes_model->obtener_ultimo_id();

        	 //obtengo el ultimo id de padres + 1 
        	 $ultimo_id_padre = $this->estudiantes_model->obtener_ultimo_id_padres();

        	 //obtengo el ultimo id de madres + 1 
        	 $ultimo_id_madre = $this->estudiantes_model->obtener_ultimo_id_madres();

        	 //array para insertar en la tabla personas----------
        	$estudiante = array(
        	'id_persona' =>$ultimo_id,	
			'identificacion' =>$this->input->post('identificacion'),
			'tipo_id' =>$this->input->post('tipo_id'),
			'fecha_expedicion' =>$this->input->post('fecha_expedicion'),
			'departamento_expedicion' =>$this->input->post('departamento_expedicion'),
			'municipio_expedicion' =>$this->input->post('municipio_expedicion'),
			'nombres' =>ucwords(strtolower($this->input->post('nombres'))),
			'apellido1' =>ucwords(strtolower($this->input->post('apellido1'))),
			'apellido2' =>ucwords(strtolower($this->input->post('apellido2'))),
			'sexo' =>$this->input->post('sexo'),
			'fecha_nacimiento' =>$this->input->post('fecha_nacimiento'),
			'departamento_nacimiento' =>$this->input->post('departamento_nacimiento'),
			'municipio_nacimiento' =>$this->input->post('municipio_nacimiento'),
			'tipo_sangre' =>$this->input->post('tipo_sangre'),
			'eps' =>ucwords(strtolower($this->input->post('eps'))),
			'poblacion' =>$this->input->post('poblacion'),
			'telefono' =>$this->input->post('telefono'),
			'email' =>$this->input->post('correo'),
			'direccion' =>ucwords(strtolower($this->input->post('direccion'))),
			'barrio' =>ucwords(strtolower($this->input->post('barrio'))));

        	//array para insertar en la tabla estudiantes
			$estudiante2 = array(
			'id_persona' =>$ultimo_id,
			'discapacidad' =>$this->input->post('discapacidad'),
			'institucion_procedencia' =>ucwords(strtolower($this->input->post('institucion_procedencia'))),
			'grado_cursado' =>$this->input->post('grado_cursado'),
			'anio' =>$this->input->post('anio'));

			//aqui creamos el username de un estudiante
			$user = strtolower(substr($this->input->post('nombres'), 0, 2));
			$name = strtolower($this->input->post('apellido1'));
			$username = $user.$name.$ultimo_id;

			//array para insertar en la tabla usuarios
			$usuario = array(
			'id_usuario' =>$ultimo_id,
			'id_persona' =>$ultimo_id,
			'id_rol' => 2,
			'username' =>$username,
			'password' =>sha1($this->input->post('identificacion')),
			'acceso' =>0);

			//array del padre - para insertar en la tabla padres
			$padre = array(
			'id_padre' =>$ultimo_id_padre,
			'identificacion_p' =>$this->input->post('identificacion_padre'),
			'nombres_p' =>ucwords(strtolower($this->input->post('nombres_padre'))),
			'apellido1_p' =>ucwords(strtolower($this->input->post('apellido1_padre'))),
			'apellido2_p' =>ucwords(strtolower($this->input->post('apellido2_padre'))),
			'telefono_p' =>$this->input->post('telefono_padre'),
			'direccion_p' =>ucwords(strtolower($this->input->post('direccion_padre'))),
			'barrio_p' =>ucwords(strtolower($this->input->post('barrio_padre'))),
			'ocupacion_p' =>ucwords(strtolower($this->input->post('ocupacion_padre'))),
			'telefono_trabajo_p' =>$this->input->post('telefono_trabajo_padre'),
			'direccion_trabajo_p' =>ucwords(strtolower($this->input->post('direccion_trabajo_padre'))));

			//array de la madre - para insertar en la tabla madres
			$madre = array(
			'id_madre' =>$ultimo_id_madre,
			'identificacion_m' =>$this->input->post('identificacion_madre'),
			'nombres_m' =>ucwords(strtolower($this->input->post('nombres_madre'))),
			'apellido1_m' =>ucwords(strtolower($this->input->post('apellido1_madre'))),
			'apellido2_m' =>ucwords(strtolower($this->input->post('apellido2_madre'))),
			'telefono_m' =>$this->input->post('telefono_madre'),
			'direccion_m' =>ucwords(strtolower($this->input->post('direccion_madre'))),
			'barrio_m' =>ucwords(strtolower($this->input->post('barrio_madre'))),
			'ocupacion_m' =>ucwords(strtolower($this->input->post('ocupacion_madre'))),
			'telefono_trabajo_m' =>$this->input->post('telefono_trabajo_madre'),
			'direccion_trabajo_m' =>ucwords(strtolower($this->input->post('direccion_trabajo_madre'))));

			$estudiantes_padres = array(
			'id_estudiante' =>$ultimo_id,
			'id_padre' =>$ultimo_id_padre,
			'id_madre' =>$ultimo_id_madre);


			if ($this->estudiantes_model->validar_existencia($this->input->post('identificacion'))){

				$respuesta=$this->estudiantes_model->insertar_estudiante($estudiante,$estudiante2,$usuario,$padre,$madre,$estudiantes_padres);
				

				if($respuesta==true){

					echo "registroguardado";

				}
				else{
					echo "registronoguardado";
				}


			}
			else{

				echo "estudianteyaexiste";
			}



        }
        

	}

	public function mostrarestudiantes(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		//---------FORMA PARA JSON ARRAY---------
		//$consulta = $data['buscado'] = $this->estudiantes_model->buscar_estudiante($id);
		
		//---------FORMA PARA JSON OBJECTH---------
		$data = array(

			'estudiantes' => $this->estudiantes_model->buscar_estudiante($id,$inicio,$cantidad),

		    'totalregistros' => count($this->estudiantes_model->buscar_estudiante($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}

	public function modificar(){

		$this->form_validation->set_rules('identificacion', 'Identificación', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('nombres', 'Nombres', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido1', 'Primer Apellido', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido2', 'Segundo Apellido', 'required|alpha_spaces');
        $this->form_validation->set_rules('sexo', 'Sexo', 'required|min_length[1]|max_length[1]');
        $this->form_validation->set_rules('fecha_nacimiento', 'Fecha De Nacimiento', 'required');
        $this->form_validation->set_rules('departamento_nacimiento', 'Dpto. De Nacimiento', 'required');
        $this->form_validation->set_rules('municipio_nacimiento', 'Mcpio. De Nacimiento', 'required');
        $this->form_validation->set_rules('tipo_sangre', 'Tipo De Sangre', 'required');
        $this->form_validation->set_rules('eps', 'Eps', 'required|alpha_spaces');
        $this->form_validation->set_rules('poblacion', 'Poblacion', 'required|alpha_spaces');
        $this->form_validation->set_rules('correo', 'Correo', 'required|alpha_spaces');
        $this->form_validation->set_rules('direccion', 'Dirección', 'required|alpha_spaces');
        $this->form_validation->set_rules('telefono', 'Telefono', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('barrio', 'Barrio', 'required|alpha_spaces');
        $this->form_validation->set_rules('institucion_procedencia', 'I.E. De Procedencia', 'required|alpha_spaces');
        $this->form_validation->set_rules('discapacidad', 'Discapacidad', 'required|alpha_spaces');
        $this->form_validation->set_rules('grado_cursado', 'Grado Cursado', 'required');
        $this->form_validation->set_rules('anio', 'Año', 'required|numeric|max_length[4]');
        //Padre
        $this->form_validation->set_rules('identificacion_padre', 'Identificación Del Padre', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('nombres_padre', 'Nombres Del Padre', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido1_padre', 'Primer Apellido Del Padre', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido2_padre', 'Segundo Apellido Del Padre', 'required|alpha_spaces');
        $this->form_validation->set_rules('telefono', 'Telefono Del Padre', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('direccion_padre', 'Dirección Del Padre', 'required|alpha_spaces');
        $this->form_validation->set_rules('barrio_padre', 'Barrio Del Padre', 'required|alpha_spaces');
        $this->form_validation->set_rules('ocupacion_padre', 'Ocupacion Del Padre', 'required|alpha_spaces');
        $this->form_validation->set_rules('telefono_trabajo_padre', 'Telefono Trabajo Del Padre', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('direccion_trabajo_padre', 'Dirección Trabajo Del Padre', 'required|alpha_spaces');

        //Madre
        $this->form_validation->set_rules('identificacion_madre', 'Identificación De la madre', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('nombres_madre', 'Nombres De la madre', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido1_madre', 'Primer Apellido De la madre', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido2_madre', 'Segundo Apellido De la madre', 'required|alpha_spaces');
        $this->form_validation->set_rules('telefono', 'Telefono De la madre', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('direccion_madre', 'Dirección De la madre', 'required|alpha_spaces');
        $this->form_validation->set_rules('barrio_madre', 'Barrio De la madre', 'required|alpha_spaces');
        $this->form_validation->set_rules('ocupacion_madre', 'Ocupacion De la madre', 'required|alpha_spaces');
        $this->form_validation->set_rules('telefono_trabajo_madre', 'Telefono Trabajo De la madre', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('direccion_trabajo_madre', 'Dirección Trabajo De la madre', 'required|alpha_spaces');


        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();
        }
        else{

			//array para actualizar en la tabla personas----------
			$estudiante = array(
	    	'id_persona' =>$this->input->post('id_persona'),	
			'identificacion' =>$this->input->post('identificacion'),
			'tipo_id' =>$this->input->post('tipo_id'),
			'fecha_expedicion' =>$this->input->post('fecha_expedicion'),
			'departamento_expedicion' =>$this->input->post('departamento_expedicion'),
			'municipio_expedicion' =>$this->input->post('municipio_expedicion'),
			'nombres' =>ucwords(strtolower($this->input->post('nombres'))),
			'apellido1' =>ucwords(strtolower($this->input->post('apellido1'))),
			'apellido2' =>ucwords(strtolower($this->input->post('apellido2'))),
			'sexo' =>$this->input->post('sexo'),
			'fecha_nacimiento' =>$this->input->post('fecha_nacimiento'),
			'departamento_nacimiento' =>$this->input->post('departamento_nacimiento'),
			'municipio_nacimiento' =>$this->input->post('municipio_nacimiento'),
			'tipo_sangre' =>$this->input->post('tipo_sangre'),
			'eps' =>ucwords(strtolower($this->input->post('eps'))),
			'poblacion' =>$this->input->post('poblacion'),
			'telefono' =>$this->input->post('telefono'),
			'email' =>strtolower($this->input->post('correo')),
			'direccion' =>ucwords(strtolower($this->input->post('direccion'))),
			'barrio' =>ucwords(strtolower($this->input->post('barrio'))));

			//array para actualizar en la tabla estudiantes----------
			$estudiante2 = array(
			'id_persona' =>$this->input->post('id_persona'),
			'discapacidad' =>$this->input->post('discapacidad'),
			'institucion_procedencia' =>ucwords(strtolower($this->input->post('institucion_procedencia'))),
			'grado_cursado' =>$this->input->post('grado_cursado'),
			'anio' =>$this->input->post('anio'));

			//aqui creamos el username de un estudiante
			$id_persona = $this->input->post('id_persona');
			$user = strtolower(substr($this->input->post('nombres'), 0, 2));
			$name = strtolower($this->input->post('apellido1'));
			$username = $user.$name.$id_persona;

			//array para actualizar en la tabla usuarios----------	
			$usuario = array(
			'id_usuario' =>$this->input->post('id_persona'),
			'id_persona' =>$this->input->post('id_persona'),
			'id_rol' => 2,
			'username' =>$username,
			'password' =>sha1($this->input->post('identificacion')),
			'acceso' =>0);

			//array del padre - para insertar en la tabla padres
			$padre = array(
			'id_padre' =>$this->input->post('id_padre'),
			'identificacion_p' =>$this->input->post('identificacion_padre'),
			'nombres_p' =>ucwords(strtolower($this->input->post('nombres_padre'))),
			'apellido1_p' =>ucwords(strtolower($this->input->post('apellido1_padre'))),
			'apellido2_p' =>ucwords(strtolower($this->input->post('apellido2_padre'))),
			'telefono_p' =>$this->input->post('telefono_padre'),
			'direccion_p' =>ucwords(strtolower($this->input->post('direccion_padre'))),
			'barrio_p' =>ucwords(strtolower($this->input->post('barrio_padre'))),
			'ocupacion_p' =>ucwords(strtolower($this->input->post('ocupacion_padre'))),
			'telefono_trabajo_p' =>$this->input->post('telefono_trabajo_padre'),
			'direccion_trabajo_p' =>ucwords(strtolower($this->input->post('direccion_trabajo_padre'))));

			//array de la madre - para insertar en la tabla madres
			$madre = array(
			'id_madre' =>$this->input->post('id_madre'),
			'identificacion_m' =>$this->input->post('identificacion_madre'),
			'nombres_m' =>ucwords(strtolower($this->input->post('nombres_madre'))),
			'apellido1_m' =>ucwords(strtolower($this->input->post('apellido1_madre'))),
			'apellido2_m' =>ucwords(strtolower($this->input->post('apellido2_madre'))),
			'telefono_m' =>$this->input->post('telefono_madre'),
			'direccion_m' =>ucwords(strtolower($this->input->post('direccion_madre'))),
			'barrio_m' =>ucwords(strtolower($this->input->post('barrio_madre'))),
			'ocupacion_m' =>ucwords(strtolower($this->input->post('ocupacion_madre'))),
			'telefono_trabajo_m' =>$this->input->post('telefono_trabajo_madre'),
			'direccion_trabajo_m' =>ucwords(strtolower($this->input->post('direccion_trabajo_madre'))));
			
			$id_persona = $this->input->post('id_persona');
	    	$identificacion = $this->input->post('identificacion');
	    	$identificacion_buscada = $this->estudiantes_model->obtener_identificacion($id_persona);

	        if(is_numeric($identificacion)){

	        	if ($identificacion_buscada == $identificacion) {

	        		$respuesta=$this->estudiantes_model->modificar_estudiante($this->input->post('id_persona'),$this->input->post('id_padre'),$this->input->post('id_madre'),$estudiante,$estudiante2,$usuario,$padre,$madre);
	            
		            if($respuesta==true){
		                
		                echo "registro actualizado";
		            }else{
		               
		            	echo "registro no se pudo actualizar";
		            }
	        		
	        	}
	        	else{

	        		if ($this->estudiantes_model->validar_existencia($identificacion)){

	        			$respuesta=$this->estudiantes_model->modificar_estudiante($this->input->post('id_persona'),$this->input->post('id_padre'),$this->input->post('id_madre'),$estudiante,$estudiante2,$usuario,$padre,$madre);
	            
			            if($respuesta==true){
			                
			                echo "registro actualizado";
			            }else{
			               
			            	echo "registro no se pudo actualizar";
			            }


	        		}
	        		else{

	        			echo "estudiante ya existe";

	        		}

	        	}
	          
	            
	         
	        }else{
	            
	            echo "digite valor numerico para la Identificacion";
	        }

	    }
	        
    }


    public function eliminar(){

	  	$id =$this->input->post('id'); 

        if(is_numeric($id)){

			
	        $respuesta=$this->estudiantes_model->eliminar_estudiante($id);
	        	
          	if($respuesta==true){
              
              	echo "eliminado correctamente";
          	}else{
              
              	echo "no se pudo eliminar";
          	}
          //redirect(base_url());
        }else{
          
          	echo "digite valor numerico para la cedula";
        }
    }

    public function llenarcombo_departamentos(){

    	$consulta = $this->estudiantes_model->llenar_departamentos();
    	echo json_encode($consulta);
    }

    public function llenarcombo_municipios(){

    	$id =$this->input->post('id');
    	$consulta = $this->estudiantes_model->llenar_municipios($id);
    	echo json_encode($consulta);
    }





	
}