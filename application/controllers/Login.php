<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Carrega models
		$this->load->model('user_model'); 

		//Carrega bibliotecas necessárias
		$this->load->library('form_validation');
		$this->load->library('session');

		//Carrega helpers
		$this->load->helper('url');
	}

	public function index()
	{
		//Define regras de validação do formulário
		$this->form_validation->set_rules('email', 'E-mail', 'required');
		$this->form_validation->set_rules('password', 'Senha', 'required');

		if($this->form_validation->run() === FALSE){

			$this->load->view('header');
			$this->load->view('login');
			$this->load->view('footer');

		}else{
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$query = $this->user_model->check_login($email, $password);

			if($query === false){
				echo "erro";
			}else{
				$result = $query['data']->row();

				//Monta o array de informações do usuario
				$session = array(
			        'email'  	=> $result->email,
			        'name'   	=> $result->name,
			        'logged_in' => TRUE
				);
				$this->session->set_userdata($session);

				redirect(base_url().'index.php/home/');
			}
		}
	}
}
