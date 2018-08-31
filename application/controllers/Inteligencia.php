<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inteligencia extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

        $this->load->library('php-ml-master/Intelligence');
        $this->Intelligence = new Intelligence;
	}

	public function predicao()
	{
		$quantity = [[1], [2], [3], [4], [5]];
		$date = [1369526400, 1372204800, 1374796800, 1377475200, 1380153600];

		$prox_compra = $this->Intelligence->predicao($quantity, $date);
		echo 'Return: '.date('Y-m-d', $prox_compra);
		exit();

		$this->load->view('header');
		$this->load->view('home');
		$this->load->view('footer');
	}
}