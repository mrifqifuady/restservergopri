<?php
require APPPATH . '/libraries/REST_Controller.php';

class Mapel extends REST_Controller {
// show 
	function index_get() {
		$id_mapel = $this->get('id_mapel');
		if ($id_mapel == '') {
			$mapel = $this->db->get('mapel')->result();
		} else {
			$this->db->where('id_mapel', $id_mapel);
			$mapel = $this->db->get('mapel')->result();
		}
		$this->response(array("status"=>"success","result" => $mapel));
	}
	// insert 
	function index_post() {
		$data['nama_mapel'] = $this->post('nama_mapel');
		$insert = $this->db->insert('mapel', $data);
		if ($insert) {
			$this->response($data, 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}
	// update 
	function index_put() {
		$id_mapel = $this->put('id_mapel');
		$data['nama_mapel'] = $this->put('nama_mapel');
		$this->db->where('id_mapel', $id_mapel);
		$update = $this->db->update('mapel', $data);
		if ($update) {
			$this->response($data, 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}
	// delete 
	function index_delete() {
		$id_mapel = $this->delete('id_mapel');
		$this->db->where('id_mapel', $id_mapel);
		$delete = $this->db->delete('mapel');
		if ($delete) {
			$this->response(array('status' => 'success'), 201);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}
}
?>