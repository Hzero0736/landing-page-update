<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class LoginController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/booking');
        }
        echo view('layout/header');
        echo view('login/login');
        echo view('layout/footer');
    }

    public function auth()
    {
        $nik = $this->request->getPost('nik');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('nik', $nik)->first();

        if ($user && $password === $user['password']) {
            $sessionData = [
                'id' => $user['id'],
                'nik' => $user['nik'],
                'name' => $user['name'],
                'role' => $user['role'],
                'logged_in' => true
            ];
            session()->set($sessionData);
            return redirect()->to('/booking');
        }

        session()->setFlashdata('error', 'NIK atau Password salah!');
        return redirect()->back();
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
