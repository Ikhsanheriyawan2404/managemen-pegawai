<?php
use \application\controllers\MainController;

class JabatanController extends MainController {

	public function __construct()
	{
		parent::__construct();
		$this->model('jabatan');
	}
	public function index()
	{
		$this->template('jabatan/index');
	}

	public function data()
	{
		$jabatan = $this->jabatan->select()->orderBy('jabatan_id', 'DESC')->get();
		$data = [];
		$no = 1;
		foreach ($jabatan as $j) {
			$row = [];
			$row[] = $no++;
			$row[] = $j['name'];
			$row[] = "<a class='btn btn-success btn-sm text-white' onclick='editForm($j[jabatan_id])'><i class='fa fa-pencil-alt'></i>
					</a>
					<a class='btn btn-danger btn-sm text-white' onclick='deleteData($j[jabatan_id])'><i class='fa fa-trash'></i>
					</a>";
			$data[] = $row;
		}

		$output = ['data' => $data];
		echo json_encode($output);
	}

	public function edit($id)
	{
		$jabatan = $this->jabatan->select()->where(['jabatan_id','=', $id])->get()[0];
		echo json_encode($jabatan);
	}

	public function insert()
	{
		$jabatan = $this->jabatan->data([
			'name' => $_POST['name'],
		]);
		$jabatan->insert();
	}

	public function update()
	{
		$jabatan = $this->jabatan->find($_POST['id']);
		$jabatan->data([
			'name' => $_POST['name'],
		]);
		$jabatan->update();
	}

	public function delete($id)
	{
		$this->jabatan->find($id)->delete();
	}
}