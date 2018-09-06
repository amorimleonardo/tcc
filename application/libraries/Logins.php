<?
class Logins
{

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->library('session');

    }

    public function check_logged(){
        if ($this->CI->session->userdata('logged_in')) {
            return true;
        }else {
            // Redireciona para tela de login
            redirect(base_url().'index.php/login/');
        }
    }
}