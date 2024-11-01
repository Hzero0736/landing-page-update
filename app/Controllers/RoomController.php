<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MeetingroomModel;

class RoomController extends BaseController
{
    protected $meetingroomModel;

    public function __construct()
    {
        $this->meetingroomModel = new MeetingroomModel();
    }

    public function index()
    {
        $data = [
            'rooms' => $this->meetingroomModel->getMeetingRooms(),
        ];
        echo view('layout/header');
        echo view('booking_meeting/main_menu', $data);
        echo view('booking_meeting/form_room', $data);
        echo view('layout/footer');
    }

    public function add()
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description')
        ];

        $this->meetingroomModel->insert($data);
        return redirect()->to('/booking')->with('success', 'Ruang rapat berhasil ditambahkan');
    }

    public function delete($id)
    {
        $this->meetingroomModel->delete($id);
        return redirect()->to('/booking')->with('success', 'Ruang rapat berhasil dihapus');
    }

    public function edit($id)
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description')
        ];

        $this->meetingroomModel->update($id, $data);
        return redirect()->to('/booking')->with('success', 'Ruang rapat berhasil diperbarui');
    }
}
