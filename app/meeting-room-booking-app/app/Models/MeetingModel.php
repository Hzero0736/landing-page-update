<?php

namespace App\Models;

use CodeIgniter\Model;

class MeetingModel extends Model
{
    protected $table = 'meetings';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'date', 'start_time', 'end_time', 'room_id', 'description', 'user', 'repeat'];

    public function getMeetings()
    {
        return $this->findAll();
    }

    public function getMeetingById($id)
    {
        return $this->find($id);
    }

    public function createMeeting($data)
    {
        return $this->insert($data);
    }

    public function updateMeeting($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteMeeting($id)
    {
        return $this->delete($id);
    }
}