<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('user_model'); //Carrega model

        $this->load->library('form_validation'); //Carrega biblioteca validação de formulário
	}

	// public function index()
	// {
	// 	$this->load->view('header');
	// 	$this->load->view('user_register');
	// 	$this->load->view('footer');
	// }

	public function create()
	{
		//Define regras de validação do formulário
		$this->form_validation->set_rules('email', 'E-mail', 'required');
		$this->form_validation->set_rules('name', 'Nome', 'required');
		$this->form_validation->set_rules('password', 'Senha', 'required');
		$this->form_validation->set_rules('dt_nasc', 'Data de nascimento', 'required');

		//Se regras não aceitas
		if($this->form_validation->run() === FALSE){
			
			$this->load->view('header');
			$this->load->view('user_register');
			$this->load->view('footer');

		}else{

			$this->user_model->set_user();
			$this->load->view('login');

		}
	}
}
