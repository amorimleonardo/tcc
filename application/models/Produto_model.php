<?php
class Produto_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        $this->load->library('encrypt');
    }

    public function get($id = FALSE, $params = array())
	{
        if ($id === FALSE && $params = array())
        {
            $query = $this->db->get('produto', array('id' => $id));
            return $query->result_array();
        }

        $query = $this->db->get_where('produto');
        return $query->result_array();
	}

	public function set_produto()
	{
		$data = array(
	        'email' 	=> $this->input->post('email'),
	        'name' 		=> $this->input->post('name'),
            // 'password'   => $this->encrypt->encode($this->input->post('password')),
	        'password' 	=> $this->input->post('password'),
	        'dt_nasc' 	=> $this->input->post('dt_nasc')
	    );

	    return $this->db->insert('users', $data);
	}
}