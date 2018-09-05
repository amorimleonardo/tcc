<?php
class Compra_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        $this->load->library('encrypt');
    }

    public function get($id = null, $params = array())
	{
        if ($id === null && $params == array())
        {
            $query = $this->db->get('compra', array('id' => $id));
            return $query->row_array();
        }else{
            if (isset($params['conditions']) && $params['conditions'] != null) {
                $this->db->where($params['conditions']);
            }
            if (isset($params['join']) && in_array('produto', $params['join'])) {
                $this->db->join('produto', 'compra.id_produto = produto.id', 'left');
            }

            $query             = $this->db->get('compra');
            $query->last_query = $this->db->last_query();

            return $query;
        }
	}

	public function set($params = array())
	{
        if(count($params) > 0){
            return $this->db->insert('compra', $params);
        }
	}
}