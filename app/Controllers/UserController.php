<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function add()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nik'      => 'required|numeric|is_unique[users.nik]',
            'password' => 'required|min_length[8]',
            'name'     => 'required|min_length[3]',
            'role'     => 'required'
        ]);

        $data = [
            'nik'      => $this->request->getPost('nik'),
            'password' => $this->request->getPost('password'),
            'name'     => $this->request->getPost('name'),
            'role'     => $this->request->getPost('role'),
        ];

        if ($this->userModel->insert($data)) {
            return redirect()->to('booking')->with('success', 'User berhasil ditambahkan');
        } else {
            return redirect()->to('booking')->with('error', 'Gagal menambahkan user');
        }
    }

    public function delete($id)
    {
        // Cek apakah ID yang akan dihapus sama dengan ID user yang sedang login
        if ($id == session()->get('id')) {
            return redirect()->to('booking')->with('error', 'Tidak dapat menghapus akun yang sedang digunakan');
        }

        $this->userModel->delete($id);
        return redirect()->to('booking')->with('success', 'User berhasil dihapus');
    }


    public function edit($id)
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nik'      => 'required|numeric',
            'password' => 'required|min_length[8]',
            'name'     => 'required|min_length[3]',
            'role'     => 'required'
        ]);
        $data = [
            'nik'      => $this->request->getPost('nik'),
            'password' => $this->request->getPost('password'),
            'name'     => $this->request->getPost('name'),
            'role'     => $this->request->getPost('role'),
        ];
        $this->userModel->update($id, $data);
        return redirect()->to('booking')->with('success', 'User berhasil diubah');
    }
}
