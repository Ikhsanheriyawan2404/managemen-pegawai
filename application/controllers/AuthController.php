<?php

class AuthController extends Controller {

	public function index()
	{
		if(isset($_SESSION['username']) && isset($_SESSION['password'])) {
			$this->redirect('dashboard');
	    }

		$this->view('auth/login');
	}

	public function login()
	{
		$this->model('user');

		$username = $this->validate($_POST['username']);
		$password = sha1($this->validate($_POST['password']));

		$data = $this->user->select()->where([
			['username','=',"'$username'"],
		    ['password','=',"'$password'"]		
	    ])->limit(1)->get();

	    $jml = $this->user->count();
            echo json_encode($data);
	    if ($jml>0){
			$_SESSION['username'] = $data[0]['username'];
			$_SESSION['password'] = $data[0]['password'];

			$this->redirect('dashboard');
	    } else {
	        $view = $this->view('login');
			$view->bind('msg', 'Username atau Password salah!');
	    }
	}

	public function logout()
	{
		session_destroy();
		$this->redirect('auth');
	}
}

?>