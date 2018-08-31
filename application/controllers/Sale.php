<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sale extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Carrega model
		$this->load->model('sale_model');

		//Carrega bibliotecas
		$this->load->library('form_validation');
	}

	public function new_sale()
	{
		$this->form_validation->set_rules('product_name', 'Nome do produto', 'required');
		$this->form_validation->set_rules('valid_date', 'Data de validade', 'required');
		// $this->form_validation->set_rules('qtd', 'Quantidade', 'required');

		if($this->form_validation->run() === FALSE){
			
			$this->load->view('header');
			$this->load->view('new_sale');
			$this->load->view('footer');

		}else{
			$params = $this->input->post();
			echo "<pre>";print_r($params);exit();
			$this->sale_model->set();
		}

	}

	public function sale_history($id_user = '')
	{
		$this->load->view('header');
		$this->load->view('historico_compras');
		$this->load->view('footer');
	}
}