<?php
use \application\controllers\MainController;

class PegawaiController extends MainController {
	
	public function __construct()
	{
		parent::__construct();
		$this->model('jabatan');
		$this->model('pegawai');
	}

	public function index()
	{
	    $data = $this->jabatan->select()->get();
		$this->template('pegawai/index', $data);
	}

	public function data()
	{
		$pegawai = $this->pegawai->select()->join('jabatan', ['pegawai.jabatan_id' => 'jabatan.jabatan_id'], 'LEFT JOIN')->orderBy('pegawai.pegawai_id', 'DESC')->get();
		$data = [];
		$no = 1;
		foreach ($pegawai as $p) {
			$row = [];
			$row[] = $no++;
			$row[] = "<img src='".BASE_PATH."/images/$p[foto]' width='100'>";
			$row[] = $p['nama_pegawai'];
			$row[] = $p['jenis_kelamin'] == 'L' ? 'Laki-Laki' : 'Perempuan' ;
			$row[] = $p['tgl_lahir'];
			$row[] = $p['name'];
			$row[] = $p['keterangan'];
			$row[] = "<a class='btn btn-success btn-sm text-white' onclick='editForm($p[pegawai_id])'><i class='fa fa-pencil-alt'></i></a>
                <a class='btn btn-danger btn-sm text-white' onclick='deleteData($p[pegawai_id], \"$p[foto]\")'><i class='fa fa-trash'></i></a>";
			$data[] = $row;
		}

		$output = ['data' => $data];
		echo json_encode($output);
	}

	public function edit($id)
	{
		$pegawai = $this->pegawai->select()->where(['pegawai_id','=', $id])->get()[0];
	    echo json_encode($pegawai);
	}

	public function insert()
	{
		$foto       = $_FILES['foto']['name'];
		$lokasi     = $_FILES['foto']['tmp_name'];
		$tipefile   = $_FILES['foto']['type'];
		$ukuranfile = $_FILES['foto']['size'];

	    $error = "";
	    if ($foto == "") {
        	$pegawai = $this->pegawai->data([
				'nama_pegawai'  => $_POST['nama_pegawai'],
				'jenis_kelamin' => $_POST['jk'],        
				'tgl_lahir'     => $_POST['tanggal'],  
				'jabatan_id'    => $_POST['jabatan'],  
				'keterangan'    => $_POST['keterangan']
        	]);  
        	$pegawai->insert();
        } else {
        	if ($tipefile != "image/jpeg" && $tipefile != "image/jpg" && $tipefile != "image/png"){
	            $error = "Tipe file tidak didukung!";
        	} else if ($ukuranfile >= 1000000){
	            echo $ukuranfile;
	            $error = "Ukuran file terlalu besar (lebih dari 1MB)!";
	        } else {
	            move_uploaded_file($lokasi, "../public/images/".$foto);
	            $pegawai = $this->pegawai->data([
					'nama_pegawai'  => $_POST['nama_pegawai'],
					'jenis_kelamin' => $_POST['jk'],        
					'tgl_lahir'     => $_POST['tanggal'],  
					'jabatan_id'    => $_POST['jabatan'],
					'foto'          => $foto,
					'keterangan'    => $_POST['keterangan']
	            ]);  
	            $pegawai->insert();
	        }
	    }

	    if ($error != "") {
	        echo json_encode(['success'=>false, 'msg'=>$error]);
	    } else {
	        echo json_encode(['success'=>true]);
	    }
	}

	public function update()
	{

		$foto       = $_FILES['foto']['name'];
		$lokasi     = $_FILES['foto']['tmp_name'];
		$tipefile   = $_FILES['foto']['type'];
		$ukuranfile = $_FILES['foto']['size'];
		$pegawai    = $this->pegawai->find($_POST['id']);

	    $error = "";
	    if ($foto == "") {
        	$pegawai = $this->pegawai->data([
				'nama_pegawai'  => $_POST['nama_pegawai'],
				'jenis_kelamin' => $_POST['jk'],        
				'tgl_lahir'     => $_POST['tanggal'],  
				'jabatan_id'    => $_POST['jabatan'],  
				'keterangan'    => $_POST['keterangan']
        	]);  
        	$pegawai->update();
        } else {
        	if ($tipefile != "image/jpeg" && $tipefile != "image/jpg" && $tipefile != "image/png"){
	            $error = "Tipe file tidak didukung!";
        	} else if ($ukuranfile >= 1000000){
	            echo $ukuranfile;
	            $error = "Ukuran file terlalu besar (lebih dari 1MB)!";
	        } else {
	            move_uploaded_file($lokasi, "../public/images/".$foto);
	            $pegawai = $this->pegawai->data([
					'nama_pegawai'  => $_POST['nama_pegawai'],
					'jenis_kelamin' => $_POST['jk'],        
					'tgl_lahir'     => $_POST['tanggal'],  
					'jabatan_id'    => $_POST['jabatan'],
					'foto'          => $foto,
					'keterangan'    => $_POST['keterangan']
	            ]);  
	            $pegawai->update();
	        }
	    }

	    if ($error != "") {
	        echo $error;
         	echo json_encode(['success'=>false, 'msg'=>$error]);
	    } else {
	        echo json_encode(['success'=>true]);
	    }
	}

	public function delete($id, $foto)
	{
		if (file_exists("../public/images/$foto")) {
			unlink("../public/images/$foto");
		}
		$this->pegawai->find($id)->delete();
	}

}


/* End of file PegawaiController.php */
/* Location: ./application/controllers/PegawaiController.php */