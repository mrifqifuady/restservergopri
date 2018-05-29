<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
	}

	function sendMessageCode($data){

		$ci = get_instance();
        $ci->load->library('email');
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "goprimalang@gmail.com";
        $config['smtp_pass'] = "tagopri2018";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        
        
        $ci->email->initialize($config);
 
        // $ci->email->from('sobatlelang@vip.com', 'SobatLelang');
        $ci->email->from('goprimalang@gmail.com','gopri');
        $ci->email->to(''.$data['email']);
        $ci->email->subject('Verifikasi Kode');
        $ci->email->message('Kode Verifikasi anda adalah '.$data['code']);
 


	}

	

}

/* End of file Email.php */
/* Location: ./application/controllers/Email.php */

?>