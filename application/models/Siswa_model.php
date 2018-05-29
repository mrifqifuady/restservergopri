<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa_model extends CI_Model {

	function getDataSiswa()
	{
		$this->db->select("*");
		$query = $this->db->get('siswa');
		return $query->result();
	}

	function login($data)
	{
		$email = $data['email'];
		$password = $data['password'];

		$this->db->select('*');
		$this->db->where('email', $email);
		$this->db->where('password', $password);
		$query=$this->db->get('siswa');
		if($query->num_rows()==1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}


	function register($data){

		$this->load->library('encryption');

		$email = $data['email'];
		$password = $data['password'];

			// //Enkripsi Password dari md5 ke AES
			// $encryptpass = $this->encryption->encrypt($password);

		$nama = $data['nama'];
			//$jk = $data['jk'];
		$alamat = $data['alamat'];

		$no_telp = $data['no_telp'];

		$randomCode = str_pad(rand(0, pow(10, 4)-1), 4, '0', STR_PAD_LEFT);

		$data_user_login = array(
			'nama' => $nama ,
			'email' => $email ,
					//'password' => $encryptpass ,
			'password' => $password ,
					//'jk' => $jk,
			'alamat' => $alamat,

			'no_telp' => $no_telp,
			'status' => '0',
					//'active' => '0',
					//'vertification_code' => $randomCode
					//nyobak ver_cod tak ganti di active
			'active' => $randomCode
			);

		$query_user_login = $this->db->insert('siswa', $data_user_login);

		if ($this->db->affected_rows() >= 1) {

			$data['code'] = $randomCode;
			$data['email'] = $data['email'];

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

			$ci->email->from('goprimalang@gmail.com','gopri');
			$ci->email->to(''.$data['email']);
			$ci->email->subject('Verifikasi Kode');
			$ci->email->message('Kode Verifikasi anda adalah '.$data['code']);
			$ci->email->send();

			return true;
		}else{

			return false;
		}




		
	}


}

/* End of file Siswa_model.php */
/* Location: ./application/models/Siswa_model.php */