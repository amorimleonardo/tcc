<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compra extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Carrega model
		$this->load->library('compra-model');

		//Carrega bibliotecas
		$this->load->library('form-validation');
	}

	public function nova_compra()
	{
		$this->form_validation->set_rules('nome_produto');
		$this->form_validation->set_rules('valid_date');
	}
}