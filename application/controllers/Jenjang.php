<?php
require APPPATH . '/libraries/REST_Controller.php';

class Jenjang extends REST_Controller {
// show 
	function index_get() {
		$id_jenjang = $this->get('id_jenjang');
		if ($id_jenjang == '') {
			$jenjang = $this->db->get('jenjang')->result();
		} else {
			$this->db->where('id_jenjang', $id_jenjang);
			$jenjang = $this->db->get('jenjang')->result();
		}
		$this->response(array("status"=>"success","result" => $jenjang));
	}
	// insert 
	function index_post() {
		$data['nama_jenjang'] = $this->post('nama_jenjang');
		$insert = $this->db->insert('jenjang', $data);
		if ($insert) {
			$this->response($data, 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}
	// update 
	function index_put() {
		$id_jenjang = $this->put('id_jenjang');
		$data['nama_jenjang'] = $this->put('nama_jenjang');
		$this->db->where('id_jenjang', $id_jenjang);
		$update = $this->db->update('jenjang', $data);
		if ($update) {
			$this->response($data, 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}
	// delete 
	function index_delete() {
		$id_jenjang = $this->delete('id_jenjang');
		$this->db->where('id_jenjang', $id_jenjang);
		$delete = $this->db->delete('jenjang');
		if ($delete) {
			$this->response(array('status' => 'success'), 201);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}
}
?>