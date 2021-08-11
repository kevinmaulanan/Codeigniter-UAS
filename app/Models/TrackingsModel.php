<?php

namespace App\Models;

use CodeIgniter\Model;

class TrackingsModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'trackings';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'id',
		'no_polis', 
		'nama_tertanggung', 
		'jenis_perawatan',
		'jumlah_klaim',
		'alamat',
		'waktu_kejadian',
		'lokasi_kejadian',
		'no_hp',
		'status_request',
		'user_id',
	];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules = [];
	protected $validationMessages = [];
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

	

	public function getAll()
    {
        $data = $this
			->join('users', 'users.id = trackings.user_id')
			->select('trackings.*, users.name')
			->orderBy('trackings.created_at', 'DESC')
			->get()
			->getResultArray(); 

        return $data;	
    }

	public function getInProgress($status)
    {
        $data = $this
			->where(['status_request' => $status ])
			->join('users', 'users.id = trackings.user_id')
			->select('trackings.*, users.name')
			->orderBy('trackings.created_at', 'DESC')
			->get()
			->getResultArray();  

        return $data;	
    }
	
	public function getTrackingByUser($id)
    {
        $data = $this
			->where(['users.id' => $id ])
			->join('users', 'users.id = trackings.user_id')
			->select('trackings.*, users.name')
			->orderBy('trackings.created_at', 'DESC')
			->get()
			->getResultArray();  

        return $data;	
    }
}
