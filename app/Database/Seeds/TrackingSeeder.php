<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UsersModel;

class TrackingSeeder extends Seeder
{
	public function run()
	{
		$userModel = new UsersModel();
		$user = $userModel->where(['email' => 'superadmin@gmail.com'])->first();
		$this->db->table('trackings')->insert([
			'user_id'      		=> $user['id'],
			'no_polis'      	=> "No Polis 1",
			'nama_tertanggung'  => "Tertanggung 1",
			'alamat'  		 	=> "Alamat 1",
			'waktu_kejadian'   	=> (new \DateTime())->format('Y-m-d H:i:s'),
			'lokasi_kejadian'   => "Lokasi 1",
			'no_hp'   			=> "081395760945",
			'status_request'   	=> "Dalam Proses",
		]);
		$this->db->table('trackings')->insert([
			'user_id'      		=> $user['id'],
			'no_polis'      	=> "No Polis 2",
			'nama_tertanggung'  => "Tertanggung 2",
			'alamat'  		 	=> "Alamat 2",
			'waktu_kejadian'   	=> (new \DateTime())->format('Y-m-d H:i:s'),
			'lokasi_kejadian'   => "Lokasi 2",
			'no_hp'   			=> "081395760945",
			'status_request'   	=> "Dalam Proses",
		]);
		$this->db->table('trackings')->insert([
			'user_id'      		=> $user['id'],
			'no_polis'      	=> "No Polis 3",
			'nama_tertanggung'  => "Tertanggung 3",
			'alamat'  		 	=> "Alamat 3",
			'waktu_kejadian'   	=> (new \DateTime())->format('Y-m-d H:i:s'),
			'lokasi_kejadian'   => "Lokasi 3",
			'no_hp'   			=> "081395760945",
			'status_request'   	=> "Approved",
		]);
		$this->db->table('trackings')->insert([
			'user_id'      		=> $user['id'],
			'no_polis'      	=> "No Polis 1",
			'nama_tertanggung'  => "Tertanggung 1",
			'alamat'  		 	=> "Alamat 1",
			'waktu_kejadian'   	=> (new \DateTime())->format('Y-m-d H:i:s'),
			'lokasi_kejadian'   => "Lokasi 1",
			'no_hp'   			=> "081395760945",
			'status_request'   	=> "Rejected",
		]);
	}
}