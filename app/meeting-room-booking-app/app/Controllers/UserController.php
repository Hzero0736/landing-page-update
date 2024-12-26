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

    public function index()
    {
        $data = [
            'users' => $this->userModel->findAll(),
        ];
        echo view('layout/header');
        echo view('booking_meeting/main_menu', $data);
        echo view('booking_meeting/form_user', $data);
        echo view('layout/footer');
    }

    public function add()
    {
        $data = [
            'nik'      => $this->request->getPost('nik'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'name'     => $this->request->getPost('name'),
            'role'     => $this->request->getPost('role'),
        ];

        if ($this->userModel->insert($data)) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_CREATED)
                ->setJSON(['message' => 'User added successfully']);
        } else {
            return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
                ->setJSON(['message' => 'Failed to add user']);
        }
    }

    public function edit($id)
    {
        $data = [
            'nik'      => $this->request->getPost('nik'),
            'name'     => $this->request->getPost('name'),
            'role'     => $this->request->getPost('role'),
        ];

        $this->userModel->update($id, $data);
        return redirect()->to('/users')->with('success', 'User updated successfully');
    }

    public function delete($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('/users')->with('success', 'User deleted successfully');
    }
}