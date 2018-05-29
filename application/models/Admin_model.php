<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
	public function login($username, $password)
	{
		$this->db->select("id, username, password");
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		// $this->db->where('level', $level);
		$query = $this->db->get('admin');
		if($query->num_rows()==1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}

	function getDataMapel()
	{
		$this->db->select('*');
		$data=$this->db->get('mapel');
		return $data->result();
	}
	function getDataKelas()
	{
		$this->db->select('*');
		$data = $this->db->get('kelas');
		return $data->result();
	}
	function getDataJenjang()
	{
		$this->db->select('*');
		$data = $this->db->get('jenjang');
		return $data->result();
	}
	function createMapel()
	{
		$object = array(
			'nama_mapel' => $this->input->post('nama_mapel')
		);
		$this->db->insert('mapel', $object);
	}

	public function updateMapel($id_mapel,$nama_mapel)
	{
		$object = array(
			'id_mapel' => $id_mapel,
			'nama_mapel' => $nama_mapel
		);
		$this->db->where('id_mapel', $id_mapel);
		$this->db->update('mapel', $object);
	}

	public function deleteMapel($id_mapel)
	{
		$this->db->where('id_mapel', $id_mapel);
		$this->db->delete('mapel');
	}

	function createKelas()
	{
		$object = array(
			'nama_kelas' => $this->input->post('nama_kelas')
		);
		$this->db->insert('kelas', $object);
	}

	public function updateKelas($id_kelas,$nama_kelas)
	{
		$object = array(
			'id_kelas' => $id_kelas,
			'nama_kelas' => $nama_kelas
		);
		$this->db->where('id_kelas', $id_kelas);
		$this->db->update('kelas', $object);
	}

	public function deleteKelas($id_kelas)
	{
		$this->db->where('id_kelas', $id_kelas);
		$this->db->delete('kelas');
	}

	function createJenjang()
	{
		$object = array(
			'nama_jenjang' => $this->input->post('nama_jenjang')
		);
		$this->db->insert('jenjang', $object);
	}

	public function updateJenjang($id_jenjang,$nama_jenjang)
	{
		$object = array(
			'id_jenjang' => $id_jenjang,
			'nama_jenjang' => $nama_jenjang
		);
		$this->db->where('id_jenjang', $id_jenjang);
		$this->db->update('jenjang', $object);
	}

	public function deleteJenjang($id_jenjang)
	{
		$this->db->where('id_jenjang', $id_jenjang);
		$this->db->delete('jenjang');
	}

	public function verGuru($id_guru)
	{
		$status = "1";
		$data = array('status' => $status );
		$this->db->where('id_guru', $id_guru);
		$this->db->update('guru', $data);
	}

}

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */