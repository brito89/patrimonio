<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categorias extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('categoria');
		$this->load->model('subcategoria');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$datos['categoria'] = $this->categoria->get();
		$this->template->asset_js('ajax/post_sub_categoria.js');
		$this->template->write('title', 'Categorias');
		$this->template->write_view('content', 'categorias/list', $datos);
		$this->template->render();
	}

	public function ajax_subcategoria()
	{
		$id_categoria = $this->input->post('idCategoria');
		if(!empty($id_categoria)):
			$subcategoria = $this->subcategoria->get_rel($id_categoria, 'idCategoria');
			if ($subcategoria->num_rows()):
				echo '<ul class="list-group">';
				foreach ($subcategoria->result() as $row) {
					echo '
						<li class="list-group-item">
							<div class="checkbox">
								<label>
									<input type="checkbox">'.$row->nombre.'<a href="" class="btn btn-danger list-eliminar"><i class="fa fa-times"></i></a>
								</label>
							</div>
						</li>
					';
				}
				echo '</ul>';
			else:
				echo '<p class="form-control-static">No hay resultados</p>';
			endif;
		else: 
			echo '<p class="form-control-static">No hay resultados</p>';
		endif;
	}

	public function ajax_list_subcategoria()
	{
		$id_categoria = $this->input->post('idCategoria');
		if(!empty($id_categoria)):
			$idSubcategoria = $this->input->post('idSubcategoria');
			$subcategoria = $this->subcategoria->get_rel($id_categoria, 'idCategoria');
			if ($subcategoria->num_rows()):
				echo '<select name="datos[idSubcategoria]" id="subcategoria" class="form-control">';
				foreach ($subcategoria->result() as $row) {
					echo '
						<option value="'.$row->id.'"'.validar_seleccion($idSubcategoria, $row->id).'>'.$row->nombre.'</option>
					';
				}
				echo '</select>';
			else:
				echo '<option value="">No se encontraron resultados.</option>';
			endif;
		else: 
			echo '<option value="">No se encontraron resultados.</option>';
		endif;
	}

	public function insert_categoria()
	{
		$this->load->helper('formulario');
		$this->form_validation->set_error_delimiters('<span class="help-block col-lg-4">', '</span>');
		$this->form_validation->set_rules('datos[nombre]', 'nombre', 'required|max_length[150]|trim');
		
		if ($this->form_validation->run()) {
			if ($this->categoria->insert( $this->input->post('datos') )) {
				$this->session->set_flashdata('msg_success', 'La categoria ha sido agregado.');
				redirect('categorias');
			}
		}

		$this->index();
	}

	public function insert_subcategoria()
	{
		$this->load->helper('formulario');
		$this->form_validation->set_error_delimiters('<span class="help-block col-lg-4">', '</span>');
		$this->form_validation->set_rules('datos[nombre]', 'sub-categoria', 'required|max_length[150]|trim');
		$this->form_validation->set_rules('datos[idCategoria]', 'nombre', 'required|max_length[1]|trim');
		
		if ($this->form_validation->run()) {
				if ($this->subcategoria->insert( $this->input->post('datos') )) {
				$this->session->set_flashdata('msg_success', 'La Sub-Categoría ha sido agregado.');
				redirect('categorias');
			}
		}

		$this->index();
	}
}

/* End of file categorias.php */
/* Location: ./application/controllers/categorias.php */