<?php

namespace App\Models;

use CodeIgniter\Model;

class MeetingroomModel extends Model
{
    protected $table = 'meeting_rooms';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description'];
    protected $returnType = 'array';
    protected $useTimestamps = true;

    public function getMeetingRooms()
    {
        return $this->findAll();
    }

    public function getMeetingRoom($id)
    {
        return $this->find($id);
    }

    public function createMeetingRoom($data)
    {
        return $this->insert($data);
    }

    public function updateMeetingRoom($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteMeetingRoom($id)
    {
        return $this->delete($id);
    }
}