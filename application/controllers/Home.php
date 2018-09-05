<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->login->check_logged();

		$this->load->view('header');
		$this->load->view('home');
		$this->load->view('footer');
	}
}