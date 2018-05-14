<?php
class User_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        $this->load->library('encrypt');
    }

    public function get($id = FALSE, $params = array())
	{
        if ($id === FALSE && $params = array())
        {
            $query = $this->db->get('users');
            return $query->result_array();
        }

        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row_array();
	}

	public function set_user()
	{
		$data = array(
	        'email' 	=> $this->input->post('email'),
	        'name' 		=> $this->input->post('name'),
	        'password' 	=> $this->encrypt->encode($this->input->post('password')),
	        'dt_nasc' 	=> $this->input->post('dt_nasc')
	    );

	    return $this->db->insert('users', $data);
	}

	public function check_login($username, $password)
	{
        $this->db->where('users.email = "' . $username . '"');
        $query = $this->db->get('users');

        if ($query->num_rows() > 0) {
            //Recupera a senha do usuario
            $row = $query->row();
            //Decode da senha do usuario para comparar como form
            if ($password == $this->encrypt->decode($row->password)) {
                $return['data']   = $query;
                $return['result'] = true;
            } else {
                $return['result'] = false;
            }
        } else {
            $return['result'] = false;
        }

        return $return;
	}
}