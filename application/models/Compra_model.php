<?php
class Compra_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        $this->load->library('encrypt');
    }

    public function get($id = FALSE, $params = array())
	{
        if ($id === FALSE && $params = array())
        {
            $query = $this->db->get('compra');
            return $query->result_array();
        }

        $query = $this->db->get_where('compra', array('id' => $id));
        return $query->row_array();
	}

	public function set($params = array())
	{
        if(count($params) > 0){
            return $this->db->insert('compra', $params);
        }
	}
}