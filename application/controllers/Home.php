<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('Logins');
		$this->Logins = new Logins;


        $this->load->library('session');
	}

	public function index()
	{
		$this->Logins->check_logged();

		$this->load->view('header');
		$this->load->view('home');
		$this->load->view('footer');
	}
}