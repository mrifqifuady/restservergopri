<?php
require APPPATH . '/libraries/REST_Controller.php';

class Kelas extends REST_Controller {
// show 
	function index_get() {
		$id_kelas = $this->get('id_kelas');
		if ($id_kelas == '') {
			$kelas = $this->db->get('kelas')->result();
		} else {
			$this->db->where('id_kelas', $id_kelas);
			$kelas = $this->db->get('kelas')->result();
		}
		$this->response(array("status"=>"success","result" => $kelas));
	}
	// insert 
	function index_post() {
		$data['nama_kelas'] = $this->post('nama_kelas');
		$insert = $this->db->insert('kelas', $data);
		if ($insert) {
			$this->response($data, 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}
	// update 
	function index_put() {
		$id_kelas = $this->put('id_kelas');
		$data['nama_kelas'] = $this->put('nama_kelas');
		$this->db->where('id_kelas', $id_kelas);
		$update = $this->db->update('kelas', $data);
		if ($update) {
			$this->response($data, 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}
	// delete 
	function index_delete() {
		$id_kelas = $this->delete('id_kelas');
		$this->db->where('id_kelas', $id_kelas);
		$delete = $this->db->delete('kelas');
		if ($delete) {
			$this->response(array('status' => 'success'), 201);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}
}
?>