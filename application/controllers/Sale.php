<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sale extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Carrega model
		$this->load->model('compra_model');
		$this->load->model('produto_model');

		//Carrega bibliotecas
		$this->load->library('form_validation');
		$this->load->library('session');

		$this->load->library('Logins');
		$this->Logins = new Logins;
	}

	public function new_sale()
	{
		$this->Logins->check_logged();

		$this->form_validation->set_rules('id_produto', 'Nome do produto', 'required');
		$this->form_validation->set_rules('data_compra', 'Data da compra', 'required');

		if($this->form_validation->run() === FALSE){

			$list_produtos = $this->produto_model->get();
			$data['list_produtos']  = $list_produtos;

			$this->load->view('header');
			$this->load->view('new_sale', $data);
			$this->load->view('footer');

		}else{
			$params = $this->input->post();

			$data_compra = str_replace('/', '-', $params['data_compra']);
			$data_compra = date('Y-m-d', strtotime($data_compra));

			$params['data_compra'] = $data_compra;
			$params['id_user'] = $this->session->userdata('id');

			$this->compra_model->set($params);

			redirect(base_url() . 'index.php/home/');
		}

	}

	public function sale_history($id_user = '')
	{
		$this->Logins->check_logged();

		$compras = $this->compra_model->get(null, array('conditions' => 'id_user = '.$id_user, 'join' => array('produto')));

		if($compras->num_rows() > 0){
			$data['list'] = $compras->result();
		}

		$this->load->view('header');
		$this->load->view('historico', $data);
		$this->load->view('footer');
	}
}