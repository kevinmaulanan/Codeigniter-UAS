<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
	public function run()
	{
		$this->db->table('users')->insert([
			'email'      	=> 'superadmin@gmail.com',
			'password' 		=> password_hash('pass123', PASSWORD_DEFAULT),
			'name' 			=> 'Super Admin',
			'role' 			=> 'SUPER_ADMIN',
			'status' 		=> 'ACTIVE'
		]);
	}
}