<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		//$this->load->view('Admin_home');
		$this->load->model('Guru_model');
		$data["daftar_guru"] = $this->Guru_model->getDataGuru();
		$this->load->model('Admin_model');
		$data["daftar_mapel"] = $this->Admin_model->getDataMapel();
		$data["daftar_kelas"] = $this->Admin_model->getDataKelas();
		$data["daftar_jenjang"] = $this->Admin_model->getDataJenjang();
		$this->load->view('Admin_home',$data);
	}

	public function login()
	{
		$this->load->library('session');
		$this->load->helper('url','form', 'download');	
		$this->load->library('form_validation');

		$this->load->view('login_admin');
	}
	public function cekDB()
	{
		$this->load->library('session');
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->load->model('Admin_model');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		// $level = $this->input->post('level');
		$result = $this->Admin_model->login($username, $password);
		if($result)
		{
			$sess_array = array();
			foreach ($result as $row) 
			{
				$sess_array = array(
					'id'=>$row->id,
					'username'=> $row->username,
					'password' => $row->password
					// 'level' => $row->level
				);
				$this->session->set_userdata('logged_swct',$sess_array);
			}
			return true;
		}
		else
		{
			$this->form_validation->set_message('cekDb',"Login Gagal Username dan Password tidak valid");
			return false;
		}
	}

	public function cekLogin()
	{
		$this->load->library('session');
		$this->load->helper('url','form');	
		$this->load->model('Admin_model');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_cekDb');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$result = $this->Admin_model->login($username, $password);
		if(!empty($result))
		{
			foreach ($result as $row) 
			{
				$sess_array = array(
					'id'=>$row->id,
					'username'=> $row->username,
					'password' => $row->password
					// 'level' => $row->level
				);
				$this->session->set_userdata('logged_swct',$sess_array);
			}
		}
		// session
		$session_data = $this->session->userdata('logged_swct');
		$tes = $session_data['id'];

		if($this->form_validation->run()==false)
		{
			$this->load->view('login_admin');
		}else{
			redirect('admin','refresh');
		}
	}


	public function logout()
	{
		
		//$this->session->sess_destroy();	

		redirect('../','refresh');	
	}


	public function createMapel()
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama_mapel', 'nama_mapel', 'trim|required');
		$this->load->model('Admin_model');	
		if($this->form_validation->run()==FALSE){
			$this->load->view('Admin_home');
		}
		else{
			$this->Admin_model->createMapel();
			redirect('admin','refresh');
		}
	}

	public function updateMapel()
	{
		$this->load->model('Admin_model');
		$id_mapel = $this->input->post('id_mapel');
		$nama_mapel = $this->input->post('nama_mapel');
		
		$this->Admin_model->updateMapel($id_mapel,$nama_mapel);
		redirect('admin','refresh');
	}

	public function deleteMapel($id_mapel)
	{
		$this->load->model('Admin_model');
		$this->Admin_model->deleteMapel($id_mapel);
		redirect('admin','refresh');
	}

		public function createKelas()
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama_kelas', 'nama_kelas', 'trim|required');
		$this->load->model('Admin_model');	
		if($this->form_validation->run()==FALSE){
			$this->load->view('Admin_home');
		}
		else{
			$this->Admin_model->createKelas();
			redirect('admin','refresh');
		}
	}

	public function updateKelas()
	{
		$this->load->model('Admin_model');
		$id_kelas = $this->input->post('id_kelas');
		$nama_kelas = $this->input->post('nama_kelas');
		
		$this->Admin_model->updateKelas($id_kelas,$nama_kelas);
		redirect('admin','refresh');
	}

	public function deleteKelas($id_kelas)
	{
		$this->load->model('Admin_model');
		$this->Admin_model->deleteKelas($id_kelas);
		redirect('admin','refresh');
	}

		public function createJenjang()
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama_jenjang', 'nama_jenjang', 'trim|required');
		$this->load->model('Admin_model');	
		if($this->form_validation->run()==FALSE){
			$this->load->view('Admin_home');
		}
		else{
			$this->Admin_model->createJenjang();
			redirect('admin','refresh');
		}
	}

	public function updateJenjang()
	{
		$this->load->model('Admin_model');
		$id_jenjang = $this->input->post('id_jenjang');
		$nama_jenjang = $this->input->post('nama_jenjang');
		$this->Admin_model->updateJenjang($id_jenjang, $nama_jenjang);
		redirect('admin','refresh');
		
	}

	public function deleteJenjang($id_jenjang)
	{
		$this->load->model('Admin_model');
		$this->Admin_model->deleteJenjang($id_jenjang);
		redirect('admin','refresh');
	}

	public function verGUru($id_guru)
	{
		$this->load->model('Admin_model');
		$this->Admin_model->verGuru($id_guru);
		
		$data['success'] = "Verifikasi berhasil disimpan";
		redirect('admin','refresh');
	}

}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */