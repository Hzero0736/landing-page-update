<?php

namespace App\Models;

use CodeIgniter\Model;

class MeetingModel extends Model
{
    protected $table            = 'meetings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'title', 'date', 'start_time', 'end_time', 'room_id', 'description', 'user', 'repeat'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getMeetings()
    {
        $builder = $this->db->table('meetings');
        $builder->select('meetings.*, meeting_rooms.name as room_name');
        $builder->join('meeting_rooms', 'meetings.room_id = meeting_rooms.id');

        $query = $builder->get();
        return $query->getResultArray();
    }
}