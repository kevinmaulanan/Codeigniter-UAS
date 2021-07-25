<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class AuthController extends BaseController
{

	public function login()
	{
		return view('auth/login');
	}
	
	public function register()
	{
		return view('auth/register');
	}
	
	public function login_post()
	{
		$validate = $this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'valid_email' => 'Format Email Harus Valid'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
        ]);

		if (!$validate){
			session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
		} 
		return view("auth/login");
	}
	
	public function register_post()
	{
		try
		{
			if (!$this->validate([
			    'email' => [
			        'rules' => 'required|valid_email|is_unique[users.email]',
			        'errors' => [
			            'required' => '{field} Harus diisi',
			            'valid_email' => 'Format Email Harus Valid',
			            'is_unique' => 'Email sudah digunakan'
			        ]
			    ],
			    'password' => [
			        'rules' => 'required|min_length[8]|max_length[16]',
			        'errors' => [
			            'required' => '{field} Harus diisi',
			            'min_length' => '{field} tidak boleh kurang dari 8 karakter',
			            'max_length' => '{field} tidak boleh lebih dari 16 karakter',
			        ]
			    ],
			    'name' => [
			        'rules' => 'required|min_length[10]|max_length[32]',
			        'errors' => [
			            'required' => '{field} Harus diisi',
			        ]
			    ],
			])) {
				session()->setFlashdata('error', $this->validator->listErrors());
			    return redirect()->back()->withInput();
			} else {

				$user = new UsersModel();
				$user->insert([
					'email'      	=> $this->request->getPost('email'),
					'password' 		=> password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
					'name' 			=> $this->request->getPost('name'),
					'role' 			=> 'GUEST_USER',
					'status' 		=> 'ACTIVE',
					'updated_at'	=> new \Datetime('now')
				]);
				return redirect("auth/login")->with("success", "Register success");
			}
		}
		catch (\Exception $e)
		{
			die($e->getMessage());
		}
		
		
	}
}
