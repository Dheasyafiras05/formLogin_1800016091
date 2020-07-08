<?php namespace App\Controllers;
use App\Models\M_user;
class login extends BaseController
{
	public function index()
	{
		return view('form');
	}
	public function login_action()
	{
		$muser = new M_user();

		$email = $this->request->getPost('email');
		$password = $this->request->getPost('password');
		  
		$cek = $muser->get_data($email, $password);

		if (($cek['email'] == $email) && ($cek['password'] == $password))
		{
			session()->set('email', $cek['email']);
			session()->set('username', $cek['username']);
			session()->set('user_id', $cek['user_id']);
			return redirect()->to(base_url('user'));
		} else {
			session()->setFlashdata('gagal', 'Username / Password salah');
			return redirect()->to(base_url('login'));
		}
	}

	public function logout()
	{
		session()->destroy();
		return redirect()->to(base_url('login'));
	}

	//--------------------------------------------------------------------

}
