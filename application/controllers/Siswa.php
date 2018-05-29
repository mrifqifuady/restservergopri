<?php
require APPPATH . '/libraries/REST_Controller.php';

class Siswa extends REST_Controller {

	function index_get() {
		$id_siswa = $this->get('id_siswa');
		if($id_siswa <> ''){ //byID
			$this->db->where('id_siswa', $id_siswa);
			$siswa= $this->db->get('siswa')->result();
			$this->response(array("status"=>"success","result" => $siswa));
		}
		else {
			$siswa= $this->db->get('siswa')->result();
			$this->response(array("status"=>"success","result" => $siswa));
		}
	}
	
	function index_post()
	{
		$data['email'] = $this->post('email');
		$data['password'] = $this->post('password');
		$data['nama'] = $this->post('nama');
		$data['alamat'] = $this->post('alamat');
		$data['no_telp'] = $this->post('no_telp');
		$data['foto'] = $this->post('foto');
		$data['latitude'] = $this->post('latitude');
		$data['longitude'] = $this->post('longitude');
		$randomCode = str_pad(rand(0, pow(10, 4)-1), 4, '0', STR_PAD_LEFT);
		$data['active'] = $randomCode;
		$data['status'] = 0;
		
			//Validasi input data
		if (empty($data['email'])) {
			$this->response(array('status' => "fail", "message"=>"email harus diisi"));

		} else if (empty($data['password'])) {
			$this->response(array('status' => "fail", "message"=>"Password harus diisi"));

		} else if (empty($data['nama'])) {
			$this->response(array('status' => "fail", "message"=>"Nama harus diisi"));

		} else if (empty($data['alamat'])) {
			$this->response(array('status' => "fail", "message"=>"Alamat harus diisi"));

		} else if (empty($data['no_telp'])) {
			$this->response(array('status' => "fail", "message"=>"Nomor HP harus diisi"));
		}
		
		else if (empty($data['latitude'])) {
			$this->response(array('status' => "fail", "message"=>"latitude harus diisi"));
		}
		else if (empty($data['longitude'])) {
			$this->response(array('status' => "fail", "message"=>"longitude harus diisi"));
		}else {
			//username check
			$check = $this->db->query("SELECT * FROM siswa where email='".$this->input->post('email')."'")->num_rows();
			if ($check <= 0) {
				
				$this->insert_siswa($data);

			} else {
				$this->response(array('status' => 'fail','message' =>"username sudah digunakan"));
				$this->response($data, 200);
			}
		}
	}
	
	function insert_siswa($data){
		//function upload image
		$uploaddir = str_replace("application/", "", APPPATH).'upload/';
		if(!file_exists($uploaddir) && !is_dir($uploaddir)) {
			echo mkdir($uploaddir, 0755, true);
		}
		if (!empty($_FILES)){
			$path = $_FILES['foto']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			$user_img = $data['nama']. '.' . "png";
			$uploadfile = $uploaddir . $user_img;
			$data['foto'] = "upload/".$user_img;
		}else{
			$data['foto']="";
		}

		$get_siswa_baseid = $this->db->query("SELECT * FROM siswa as p WHERE
			p.id_siswa='".$data['nama']."'")->result();
		if(empty($get_siswa_baseid)){
			$insert= $this->db->insert('siswa',$data);
			
			$to = $data['email'];
			$subject = "verifikasi kode";
			$txt = "Kode Verifikasi anda adalah ".$data['active'];
			$headers = "From: goprimalang@gmail.com" . "\r\n" .
			"CC: goprimalang@gmail.co";
			
			mail($to,$subject,$txt,$headers);
			
			if (!empty($_FILES)){
				if ($_FILES["foto"]["name"]) {
					if
						(move_uploaded_file($_FILES["foto"]["tmp_name"],$uploadfile))
					{
						$insert_image = "success";
					} else{
						$insert_image = "failed";
					}
				}else{
					$insert_image = "Image Tidak ada Masukan";
				}
				$data['foto'] = base_url()."upload/".$user_img;
			}else{
				$data['foto'] = "";
			}
			if ($insert){
				$this->response(array('status'=>'success','message' => 'Berhasil Upload'));
			}
		}else{
			$this->response(array('status' => "failed", "message"=>"Id_siswa
				sudah ada"));
		}	
	} //end insert siswa

	// login
	function login_post() {
		$data['email'] = $this->post('email');
		$data['password'] = $this->post('password');
		$data['status'] = $this->post('status');
		
		if (empty($data['email'])) {
			$this->response(array('status' => "fail", "message"=>"email harus diisi"));

		} else if (empty($data['password'])) {
			$this->response(array('status' => "fail", "message"=>"Password harus diisi"));

		} else{
			$email = $data['email'];
			$password = $data['password'];

			$cek_login = "select * from siswa where email=? limit 1";
			$cek_email = $this->db->query($cek_login,$email);
			$result_login = $cek_email->row();
			if ($this->db->affected_rows()==1) {
				$pass = $result_login->password;
				if ($password == $pass) {
					$get_status = $result_login->status;
					if ($get_status == 1) {
						//login berhasil
						$this->response(array('status' => "success", "message"=>$result_login->id_siswa));
					} else {
						//belum verifikasi
						$this->response(array('status' => "fail", "message"=>"belum melakukan verifikasi"));
					}	
				} else {
					//password salah
					$this->response(array('status' => "fail", "message"=>"Password Salah"));
				}
				
			} else {
				$this->response(array('status' => "fail", "message"=>"Email Belum Terdaftar"));
			}
		}	
		
	}//end login
	
	// update profil siswa
	function index_put() {
		$id_siswa = $this->put('id_siswa');
		$data = array(
			'id_siswa' => $this->put('id_siswa'),
			'nama' => $this->put('nama'),
			'alamat' => $this->put('alamat'),
			'email' => $this->put('email'),
			'foto' => $this->put('foto'),
			'no_telp' => $this->put('no_telp'));
		$this->updateProfil($data);
		
		$this->db->where('id_siswa', $id_siswa);
		$update = $this->db->update('siswa', $data);
		if ($update) {
			$this->response(array('status' => 'success','message' =>"Berhasil update dengan id_siswa = ".$id_siswa));
			$this->response($data, 200);
		} else {
			$this->response(array('status' => 'fail', 'message' =>"id_siswa tidak dalam database"));
		}
	}//end update profil siswa

	//fungsi update Profil
	function updateProfil($data){
		//function upload image
		$uploaddir = str_replace("application/", "", APPPATH).'upload/';
		if(!file_exists($uploaddir) && !is_dir($uploaddir)) {
			echo mkdir($uploaddir, 0750, true);
		}
		if(!empty($_FILES)){
			$path = $_FILES['foto']['name'];
			$user_img = $data_pembeli['id_pembeli'].'.' ."png";
			$uploadfile = $uploaddir . $user_img;
			$data_pembeli['foto'] = "upload/".$user_img;
		}
			//cek validasi
		if (empty($data['email'])) {
			$this->response(array('status' => "fail", "message"=>"email harus diisi"));
		}else if (empty($data['nama'])) {
			$this->response(array('status' => "fail", "message"=>"Nama harus diisi"));
		} else if (empty($data['alamat'])) {
			$this->response(array('status' => "fail", "message"=>"Alamat harus diisi"));
		} else if (empty($data['no_telp'])) {
			$this->response(array('status' => "fail", "message"=>"Nomor HP harus diisi"));
		} else {
			$get_baseid = $this->db->query("SELECT * FROM siswa as p WHERE p.id_siswa='".$data['id_siswa']."'")->result();
			if(empty($get_baseid)){
				$this->response(array('status' => "failed", "message"=>"Id_siswa Tidak ada dalam database"));
			}else{
			//cek apakah image
				if (!empty($_FILES["foto"]["name"])) {
					if(move_uploaded_file($_FILES["foto"]["tmp_name"],$uploadfile)){
						$insert_image = "success";
					}else{
						$insert_image = "failed";
					}
				}else{
					$insert_image = "Image Tidak ada Masukan";
				}

				if ($insert_image==="success"){
					//jika photo di update eksekusi query
					$update= $this->db->query("Update user Set nama ='".$data['nama']."', alamat ='".$data['alamat']."' , no_telp ='".$data['no_telp']."', foto ='".$data['foto']."' Where id_siswa ='".$data['id_siswa']."'");
					$data['foto'] = base_url()."upload/".$user_img;
				}else{
					//jika photo di kosong atau tidak di update eksekusi query
					$update= $this->db->query("Update siswa Set nama ='".$data['nama']."', alamat ='".$data['alamat']."' , no_telp ='".$data['no_telp']."' Where id_siswa ='".$data['id_siswa']."'");
					$getPhotoPath =$this->db->query("SELECT foto FROM siswa Where id_siswa='".$data['id_siswa']."'")->result();

					if(!empty($getPhotoPath)){
						foreach ($getPhotoPath as $row){
							$user_img = $row->foto;
							$a = base_url();
							$data['foto'] = $a.$user_img;
						}
					}
				}
				if ($update){				
					$this->response(array('status'=>'success','result' => array($data),"message"=>$update));
				}

			}
		}
	}//end update profil
	
	function verifikasiEmail_post()
	{
		$codeVer =  $this->post('codeVer');
		$status = "1";
		$data = array('status' => $status );
		$cek_code = "select * from siswa where active=? limit 1";
		$cek_codeVer = $this->db->query($cek_code,$codeVer);
		$result_code = $cek_codeVer->row();

		if ($this->db->affected_rows()==1) {

			
			$this->db->where('active', $codeVer);
			$update = $this->db->update('siswa', $data);

			if ($update) {
				$this->response(array('status' => "success", "message"=>"akun telah terverifikasi"));
			} else {
					//password salah
				$this->response(array('status' => "fail", "message"=>"gagal verifikasi"));
			}
			
		} else {
			$this->response(array('status' => "fail", "message"=>"code tidak ditemukan"));
		}
	}//end verifikasi email
	
	function concatDetail_get()
	{
		$id_detail = $this->get('id_detail');
		$id_guru = $this->get('id_guru');
		if ($id_guru<> '') {
			$this->db->where('id_guru', $id_guru);
			$this->db->select('concat_ws(" ",jenjang.nama_jenjang, "kelas", kelas.nama_kelas,mapel.nama_mapel, "Rp.", tarif)');
			$this->db->join('jenjang', 'detail_guru.id_jenjang=jenjang.id_jenjang');
			$this->db->join('kelas', 'detail_guru.id_kelas=kelas.id_kelas');
			$this->db->join('mapel', 'detail_guru.id_mapel=mapel.id_mapel');
			$db = $this->db->get('detail_guru')->result();
		} else {
			$this->db->select('concat_ws(" ",jenjang.nama_jenjang, "kelas", kelas.nama_kelas,mapel.nama_mapel, "Rp.", tarif)');
			$this->db->join('jenjang', 'detail_guru.id_jenjang=jenjang.id_jenjang');
			$this->db->join('kelas', 'detail_guru.id_kelas=kelas.id_kelas');
			$this->db->join('mapel', 'detail_guru.id_mapel=mapel.id_mapel');
			$db = $this->db->get('detail_guru')->result();
		}
		
		
		$this->response(array("status"=>"success","result" => $db));
	}
	
	function siswaDone_get()
	{
		$id_siswa = $this->get('id_siswa');
		$id_les = $this->get('id_les');
		if($id_siswa == '' && $id_les == ''){
			$this->db->select("*");
			$this->db->join('siswa', 'siswa.id_siswa = les.id_siswa');
			$this->db->join('detail_guru', 'detail_guru.id_detail = les.id_detail');
			$this->db->join('guru', 'detail_guru.id_guru = guru.id_guru', 'left');
			$this->db->where('les.status', 'done');
			$query = $this->db->get('les')->result();
			$this->response(array("status"=>"success","result" => $query));
		}
		elseif($id_siswa <> '' ){
			//tampil by ID, sort session siswa
			$this->db->select("*");
			$this->db->join('siswa', 'siswa.id_siswa = les.id_siswa');
			$this->db->join('detail_guru', 'detail_guru.id_detail = les.id_detail');
			$this->db->join('guru', 'detail_guru.id_guru = guru.id_guru', 'left');
			$this->db->where('les.status', 'done');
			$this->db->where('les.id_siswa', $id_siswa);
			$query = $this->db->get('les')->result();
			$this->response(array("status"=>"success","result" => $query));			
		}
		else {
    		//tampil by session dan id les, tampil detail les
			$this->db->select("*");
			$this->db->join('siswa', 'siswa.id_siswa = les.id_siswa');
			$this->db->join('detail_guru', 'detail_guru.id_detail = les.id_detail');
			$this->db->join('guru', 'detail_guru.id_guru = guru.id_guru', 'left');
			$this->db->where('les.status', 'done');
			$this->db->where('les.id_siswa', $id_siswa);
			$this->db->where('id_les', $id_les);
			$query = $this->db->get('les')->result();
			$this->response(array("status"=>"success","result" => $query));
		}
	}
	
		//list orderan untuk guru
	function listOrderGuru_get()
	{
		$id_siswa = $this->get('id_siswa');
		$id_les = $this->get('id_les');
		if($id_siswa <> '' && $id_les <> ''){
		//tampil DETAIL
		    $this->db->select(' concat_ws(" ", jenjang.nama_jenjang, "kelas", kelas.nama_kelas, mapel.nama_mapel, " Rp. ", detail_guru.tarif) as "con", guru.*, les.*, detail_guru.*, siswa.nama as "nama_siswa", siswa.alamat as "alamat_siswa", siswa.email as "email_siswa", siswa.foto as "foto_siswa", siswa.no_telp as "no_telp_siswa", siswa.jk as "jk_siswa"  ');
			$this->db->join('siswa', 'siswa.id_siswa = les.id_siswa');
			$this->db->join('detail_guru', 'detail_guru.id_detail = les.id_detail');
			$this->db->join('guru', 'detail_guru.id_guru = guru.id_guru', 'left');
			$this->db->where('les.status', 'wait');
			$this->db->where('id_les', $id_les);
			$this->db->where('siswa.id_siswa', $id_siswa);
			$this->db->join('mapel', 'mapel.id_mapel = detail_guru.id_mapel');
			$this->db->join('kelas', 'kelas.id_kelas = detail_guru.id_kelas');
			$this->db->join('jenjang', 'jenjang.id_jenjang = detail_guru.id_jenjang');
			$query = $this->db->get('les')->result();
			$this->response(array("status"=>"success","result" => $query));
		}
		elseif($id_siswa <> '' ){
			//tampil LIST ORDER
			$this->db->select("guru.*, les.*, detail_guru.*, siswa.nama as 'nama_siswa', siswa.alamat as 'alamat_siswa', siswa.email as 'email_siswa', siswa.foto as 'foto_siswa', siswa.no_telp as 'no_telp_siswa', siswa.jk as 'jk_siswa' ");
			$this->db->join('siswa', 'siswa.id_siswa = les.id_siswa');
			$this->db->join('detail_guru', 'detail_guru.id_detail = les.id_detail');
			$this->db->join('guru', 'detail_guru.id_guru = guru.id_guru', 'left');
			$this->db->where('les.status', 'wait');
			$this->db->where('siswa.id_siswa', $id_siswa);
			$query = $this->db->get('les')->result();
			$this->response(array("status"=>"success","result" => $query));		
		}
		else {
    		$this->response(array('status' => "fail", "message"=>"cek ID "));
		}
	}
	
		//list orderan untuk guru
	function listOrderTerima_get()
	{
		$id_siswa = $this->get('id_siswa');
		$id_les = $this->get('id_les');
		if($id_siswa <> '' && $id_les <> ''){
		//tampil DETAIL
		    $this->db->select(' concat_ws(" ", jenjang.nama_jenjang, "kelas", kelas.nama_kelas, mapel.nama_mapel, " Rp. ", detail_guru.tarif) as "con", guru.*, les.*, detail_guru.*, siswa.nama as "nama_siswa", siswa.alamat as "alamat_siswa", siswa.email as "email_siswa", siswa.foto as "foto_siswa", siswa.no_telp as "no_telp_siswa", siswa.jk as "jk_siswa"  ');
			$this->db->join('siswa', 'siswa.id_siswa = les.id_siswa');
			$this->db->join('detail_guru', 'detail_guru.id_detail = les.id_detail');
			$this->db->join('guru', 'detail_guru.id_guru = guru.id_guru', 'left');
			$this->db->where('les.status', 'terima');
			$this->db->where('id_les', $id_les);
			$this->db->where('siswa.id_siswa', $id_siswa);
			$this->db->join('mapel', 'mapel.id_mapel = detail_guru.id_mapel');
			$this->db->join('kelas', 'kelas.id_kelas = detail_guru.id_kelas');
			$this->db->join('jenjang', 'jenjang.id_jenjang = detail_guru.id_jenjang');
			$query = $this->db->get('les')->result();
			$this->response(array("status"=>"success","result" => $query));
		}
		elseif($id_siswa <> '' ){
			//tampil LIST ORDER
			$this->db->select("guru.*, les.*, detail_guru.*, siswa.nama as 'nama_siswa', siswa.alamat as 'alamat_siswa', siswa.email as 'email_siswa', siswa.foto as 'foto_siswa', siswa.no_telp as 'no_telp_siswa', siswa.jk as 'jk_siswa' ");
			$this->db->join('siswa', 'siswa.id_siswa = les.id_siswa');
			$this->db->join('detail_guru', 'detail_guru.id_detail = les.id_detail');
			$this->db->join('guru', 'detail_guru.id_guru = guru.id_guru', 'left');
			$this->db->where('les.status', 'terima');
			$this->db->where('siswa.id_siswa', $id_siswa);
			$query = $this->db->get('les')->result();
			$this->response(array("status"=>"success","result" => $query));		
		}
		else {
    		$this->response(array('status' => "fail", "message"=>"cek ID "));
		}
	}
	
		
	function listStatusCancel_get()	//list staatus cancel
	{
		$id_siswa = $this->get('id_siswa');
		$id_les = $this->get('id_les');
		if($id_siswa <> '' ){
			//tampil LIST ORDER
			$this->db->select("guru.*, les.*, detail_guru.*, siswa.nama as 'nama_siswa', siswa.alamat as 'alamat_siswa', siswa.email as 'email_siswa', siswa.foto as 'foto_siswa', siswa.no_telp as 'no_telp_siswa', siswa.jk as 'jk_siswa' ");
			$this->db->join('siswa', 'siswa.id_siswa = les.id_siswa');
			$this->db->join('detail_guru', 'detail_guru.id_detail = les.id_detail');
			$this->db->join('guru', 'detail_guru.id_guru = guru.id_guru', 'left');
			$this->db->where('les.status', 'cancel');
			$this->db->where('siswa.id_siswa', $id_siswa);
			$query = $this->db->get('les')->result();
			$this->response(array("status"=>"success","result" => $query));		
		}
		else {
    		$this->response(array('status' => "fail", "message"=>"cek rest "));
		}
	}
	function listStatusDone_get()	//list staatus done
	{
		$id_siswa = $this->get('id_siswa');
		$id_les = $this->get('id_les');
		if($id_siswa <> '' ){
			//tampil LIST ORDER
			$this->db->select("guru.*, les.*, detail_guru.*, siswa.nama as 'nama_siswa', siswa.alamat as 'alamat_siswa', siswa.email as 'email_siswa', siswa.foto as 'foto_siswa', siswa.no_telp as 'no_telp_siswa', siswa.jk as 'jk_siswa' ");
			$this->db->join('siswa', 'siswa.id_siswa = les.id_siswa');
			$this->db->join('detail_guru', 'detail_guru.id_detail = les.id_detail');
			$this->db->join('guru', 'detail_guru.id_guru = guru.id_guru', 'left');
			$this->db->where('les.status', 'done');
			$this->db->where('siswa.id_siswa', $id_siswa);
			$query = $this->db->get('les')->result();
			$this->response(array("status"=>"success","result" => $query));		
		}
		else {
    		$this->response(array('status' => "fail", "message"=>"cek rest "));
		}
	}
	function listStatusTolak_get()	//list staatus tolak
	{
		$id_siswa = $this->get('id_siswa');
		$id_les = $this->get('id_les');
		if($id_siswa <> '' ){
			//tampil LIST ORDER
			$this->db->select("guru.*, les.*, detail_guru.*, siswa.nama as 'nama_siswa', siswa.alamat as 'alamat_siswa', siswa.email as 'email_siswa', siswa.foto as 'foto_siswa', siswa.no_telp as 'no_telp_siswa', siswa.jk as 'jk_siswa' ");
			$this->db->join('siswa', 'siswa.id_siswa = les.id_siswa');
			$this->db->join('detail_guru', 'detail_guru.id_detail = les.id_detail');
			$this->db->join('guru', 'detail_guru.id_guru = guru.id_guru', 'left');
			$this->db->where('les.status', 'tolak');
			$this->db->where('siswa.id_siswa', $id_siswa);
			$query = $this->db->get('les')->result();
			$this->response(array("status"=>"success","result" => $query));		
		}
		else {
    		$this->response(array('status' => "fail", "message"=>"cek rest "));
		}
	}
	
	function detailStatus_get()	//detail all status
	{
		$id_siswa = $this->get('id_siswa');
		$id_les = $this->get('id_les');
		if($id_siswa <> '' && $id_les <> ''){
		//tampil DETAIL
		    $this->db->select(' concat_ws(" ", jenjang.nama_jenjang, "kelas", kelas.nama_kelas, mapel.nama_mapel, " Rp. ", detail_guru.tarif) as "con", guru.*, les.*, detail_guru.*, siswa.nama as "nama_siswa", siswa.alamat as "alamat_siswa", siswa.email as "email_siswa", siswa.foto as "foto_siswa", siswa.no_telp as "no_telp_siswa", siswa.jk as "jk_siswa"  ');
			$this->db->join('siswa', 'siswa.id_siswa = les.id_siswa');
			$this->db->join('detail_guru', 'detail_guru.id_detail = les.id_detail');
			$this->db->join('guru', 'detail_guru.id_guru = guru.id_guru', 'left');
			$this->db->where('id_les', $id_les);
			$this->db->where('siswa.id_siswa', $id_siswa);
			$this->db->join('mapel', 'mapel.id_mapel = detail_guru.id_mapel');
			$this->db->join('kelas', 'kelas.id_kelas = detail_guru.id_kelas');
			$this->db->join('jenjang', 'jenjang.id_jenjang = detail_guru.id_jenjang');
			$query = $this->db->get('les')->result();
			$this->response(array("status"=>"success","result" => $query));
		}
		else {
    		$this->response(array('status' => "fail", "message"=>"cek rest "));
		}
	}
	
	
	
	


}//end siswa


/* End of file Siswa.php */
/* Location: ./application/controllers/Siswa.php */
?>