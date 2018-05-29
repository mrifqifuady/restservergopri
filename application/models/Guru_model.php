<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru_model extends CI_Model {
	function getDataGuru()
	{
		$this->db->select("*");
		$query = $this->db->get('guru');
		return $query->result();
	}

	function login($data)
	{
		$email = $data['email'];
		$password = $data['password'];

		 $this->db->select('*');
            $this->db->where('email', $email);
            $this->db->where('password', $password);
            $this->db->where('status', '1');
      		$query=$this->db->get('guru');
      		if($query->num_rows()==1)
			{
				return $query->result();
			}
			else
			{
				return false;
			}
	}

}

/* End of file Guru_model.php */
/* Location: ./application/models/Guru_model.php */
?>