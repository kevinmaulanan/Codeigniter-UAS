<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class UsersModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'users';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['email', 'password', 'status', 'role', 'name'];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

	public function findUserLogin(string $email, string $password)
    {
        $user = $this
            ->where(['email' => $email])
            ->first();
		
        if (!$user){
			throw new Exception('User not found');
		} else {
			$compare = password_verify($password, $user['password']);
			if (!$compare) {
				throw new Exception("Password salah!");
			}
		}

        return $user;
		
    }
}
