<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nik', 'password', 'name', 'role'];
    protected $returnType = 'array';
    protected $useTimestamps = true;

    public function getUserById($id)
    {
        return $this->find($id);
    }

    public function getAllUsers()
    {
        return $this->findAll();
    }

    public function updateUser($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->delete($id);
    }
}