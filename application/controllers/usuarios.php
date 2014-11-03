<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('usuario');
		$this->load->library('form_validation');
	}

	public function index()
	{
		if ($this->input->post('del')) {
			$this->usuario->delete($this->input->post('del'));
			$this->session->set_flashdata('msg_success', 'Los usuarios han sido eliminados de manera permanente.');
			redirect('usuarios');
		}

		$default = array('buscar', 'offset');
		$param   = $this->uri->uri_to_assoc(3, $default);
		$num_results = 15;

		$param['buscar'] = ($this->input->post('buscar') != '') ? $this->input->post('buscar', TRUE):$param['buscar'];

		$this->load->library('pagination');
		$datos  = array();
		$datos['msg_success'] = $this->session->flashdata('msg_success');
		$datos['query']       = $this->usuario->busqueda( $param['buscar'], $param['offset'], $num_results );
		$datos['buscar']      = $param['buscar'];
		$datos['form_action'] = '/usuarios';

		if (empty($param['buscar'])) {
			unset($param['buscar']);
			$config['uri_segment'] = 4;
		} else {
			$config['uri_segment'] = 6;
		}

		$param['offset'] = '';
		$config['total_rows']    = $this->usuario->found_rows();
		$config['base_url']      = '/usuarios/index/'.$this->uri->assoc_to_uri($param);
		$config['per_page']      = $num_results;
		
		$this->pagination->initialize($config);

		$datos['pages']          = $this->pagination->create_links();
		$config['num_links']     = 1;

		$this->pagination->initialize($config);
		$datos['pages_mobile']   = $this->pagination->create_links();

		$this->template->asset_js('consulta.js');
		$this->template->write('title', 'Usuarios');
		$this->template->write_view('content', 'usuarios/list', $datos);
		$this->template->render();
	}

	public function nuevo()
	{		
		$this->load->helper('formulario');
		$this->form_validation->set_error_delimiters('<span class="help-block col-lg-4">', '</span>');
		$this->form_validation->set_rules('datos[nombre]', 'nombre', 'required|max_length[150]|trim');
		$this->form_validation->set_rules('datos[apellidos]', 'apellidos', 'required|max_length[150]|trim');
		$this->form_validation->set_rules('datos[usuario]', 'usuario', 'required|max_length[50]|is_unique[usuarios.usuario]|strtolower|trim');
		$this->form_validation->set_rules('datos[pass]', 'contraseña', 'required|min_length[6]|matches[repetir]|trim');
		$this->form_validation->set_rules('repetir', 'repetir contraseña', 'required|trim');
		$this->form_validation->set_rules('datos[tipo]', 'tipo de usuario', 'required|integer|trim');
		$this->form_validation->set_rules('datos[activo]', 'estado', 'required|integer|trim');

		if ($this->form_validation->run()) {
			if ($this->usuario->insert( $this->input->post('datos') )) {
				$this->session->set_flashdata('msg_success', 'El usuario ha sido agregado.');
				redirect('usuarios');
			}
		}

		$datos = $this->usuario->prepare_data($this->input->post('datos'));
		$datos['titulo_form'] = 'Agregar Usuario';
		$this->template->write('title', 'Agregar Usuario');
		$this->template->write_view('content', 'usuarios/form', $datos);
		$this->template->render();
	}

	public function editar($id = '')
	{
		if (! $this->usuario->exists($id)) {
			redirect('usuarios');
		}

		$this->load->helper('formulario');
		$edit = $this->usuario->get($id)->row_array();
		$this->form_validation->set_error_delimiters('<span class="help-block col-lg-4">', '</span>');
		$this->form_validation->set_rules('datos[nombre]', 'nombre', 'required|max_length[150]|trim');
		$this->form_validation->set_rules('datos[apellidos]', 'apellidos', 'required|max_length[150]|trim');
		$this->form_validation->set_rules('datos[tipo]', 'tipo de usuario', 'required|integer|trim');
		$this->form_validation->set_rules('datos[activo]', 'estado', 'required|integer|trim');

		if (isset($_POST['datos']['usuario']) && strtolower($edit['usuario']) != strtolower($_POST['datos']['usuario'])) {
			$this->form_validation->set_rules('datos[usuario]', 'usuario', 'required|max_length[50]|is_unique[usuarios.usuario]|strtolower|trim');
		}

		if ((isset($_POST['datos']['pass']) && !empty($_POST['datos']['pass'])) || $this->input->post('repetir')) {
			$this->form_validation->set_rules('datos[pass]', 'contraseña', 'required|min_length[6]|matches[repetir]|trim');
			$this->form_validation->set_rules('repetir', 'repetir contraseña', 'required|trim');
		}

		if ($this->form_validation->run()) {
			if ($this->usuario->update($this->input->post('datos'), $id) !== FALSE) {
				$this->session->set_flashdata('msg_success', 'Los datos del usuario han sido actualizados.');
				redirect('usuarios');
			} else {
				
			}
		}

		if ($this->input->post('datos')) {
			$datos = $this->input->post('datos');
		} else {
			$datos = $edit;
		}

		$datos = $this->usuario->prepare_data($datos);
		$datos['titulo_form'] = 'Editar Usuario';

		$this->template->write('title', 'Editar Usuario');
		$this->template->write_view('content', 'usuarios/form', $datos);
		$this->template->render();
	}

	public function detalle($id = '')
	{
		if (! $this->usuario->exists($id)) {
			show_error('El usuario no existe');
		} else {
			$datos = $this->usuario->get($id)->row_array();
			$this->load->view('usuarios/details', $datos);
		}
	}

	public function eliminar($id = '')
	{
		if (!empty($id) && $id > 1) {
			$this->usuario->delete($id);
			$this->session->set_flashdata('msg_success', 'El usuario ha sido eliminado.');
		}

		redirect('usuarios');
	}

	public function login()
	{

		$this->load->model('direccion_ip');
		$this->load->library('form_validation');
		$datos = array();

		if ($this->direccion_ip->validar()) {
			
			$this->form_validation->set_rules('user', 'usuario', 'required|trim');
			$this->form_validation->set_rules('pass', 'contraseña', 'required|trim');
			
			if ($this->form_validation->run()) {
				$login = $this->usuario->auth($this->input->post('user', TRUE), $this->input->post('pass', TRUE));
				if ($login === FALSE) {
					$this->session->set_flashdata('error', TRUE);
					redirect('login');
				} else {
					$set = array (
						'id'        => $login->id,
						'nombre'    => $login->nombre,				
						'apellidos' => $login->apellidos,
						'usuario'   => $login->usuario,
						'tipo'      => $login->tipo,
						'acceso'    => $login->acceso
					);

					$this->session->set_userdata($set);
					$this->usuario->update_acceso($login->id);
					redirect('acceso');
				}
			}

			$this->template->write('title', 'Iniciar Sesión');
			$this->template->write_view('content', 'usuarios/login', $datos);
		} else {
			$this->template->write('title', 'Conexion Bloqueada');
			$this->template->write_view('content', 'usuarios/blocked');
		}
		
		$this->template->render();
	}

	public function logout()
	{
		$unset = array (
				'id'        => '',
				'nombre'    => '',				
				'apellidos' => '',
				'usuario'   => '',
				'tipo'      => '',
				'acceso'    => ''
			);

		$this->session->unset_userdata($unset);
		$this->session->set_flashdata('logout', TRUE);
		redirect('login');
	}
}

/* End of file usuarios.php */
/* Location: ./application/controllers/usuarios.php */