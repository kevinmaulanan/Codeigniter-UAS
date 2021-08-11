<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\TrackingsModel;

use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use Exception;
use ReflectionException;

class MobileController extends BaseController
{
	use ResponseTrait;
	private function getJWTForUser($request, int $responseCode = ResponseInterface::HTTP_OK)
    {
        try {
			// Request Input
			$email = $request->getPost("email");
			$password = $request->getPost("password");
			
            $model = new UsersModel();
            $user = $model->findUserLogin($email, $password);

            unset($user['password']);

            helper('jwt');

            return $this->setResponseFormat('json')->respond([
				'success' => true,
				'code' => 200,
				'data' => $user,
				'token' => getSignedJWTForUser($user)
			], 200);
        } catch (Exception $exception) {
            return $this->setResponseFormat('json')->respond([
				'success' => false,
				'code' => 400,
				'message' => $exception->getMessage(),
			], 400 );
        }
    }
	
	public function login()
	{
		try
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
			if (!$validate) {
				throw new Exception( $this->validator->getErrors());
				$this->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
			} 
			return $this->getJWTForUser($this->request);
		}
		catch (\Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function get_user()
	{
		try
		{
			$model = new UsersModel();
			$user = $model->findUserById($this->request->user_detail->id);
			unset($user['password']);
			return $this->setResponseFormat('json')->respond([
				'success' => true,
				'code' => 200,
				'data' => $user
			], 200);
		}
		catch (\Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function tracking_list()
	{
		try
		{
			$model = new TrackingsModel();
			$tracking = $model->getTrackingByUser($this->request->user_detail->id);
			return $this->setResponseFormat('json')->respond([
				'success' => true,
				'code' => 200,
				'data' => $tracking
			], 200);
		}
		catch (\Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function transaction()
	{
		try
		{
			$response = [
				'success' => false,
				'code' => 400
			];
			$request = $this->request;

			// Get User By Id Login
			$modelUser = new UsersModel();
			$user = $modelUser->findUserById($this->request->user_detail->id);

			// Jika Limit User Mencukupi
			if ($user['limit'] >= $request->getVar('jumlah_klaim')) {
				$modelTracking = new TrackingsModel();
				
				// Create Data User
				$data = $modelTracking->insert([
					'user_id'      		=> $user['id'],
					'no_polis'      	=> $request->getVar('no_polis'),
					'nama_tertanggung'  => $request->getVar('nama_tertanggung'),
					'jenis_perawatan'  	=> $request->getVar('jenis_perawatan'),
					'jumlah_klaim'  	=> $request->getVar('jumlah_klaim'),
					'alamat'  		 	=> $request->getVar('alamat'),
					'waktu_kejadian'   	=> $request->getVar('waktu_kejadian'),
					'lokasi_kejadian'   => $request->getVar('lokasi_kejadian'),
					'no_hp'   			=> $request->getVar('no_hp'),
					'status_request'   	=> "Dalam Proses",
				]);
				if ($data) {
					// Update Data User
					$modelUser->set('limit', $user['limit'] - $request->getVar('jumlah_klaim'));
					$modelUser->where('id', $request->user_detail->id);
					$modelUser->update();

					// Update Response
					$response['success'] = true;
					$response['code'] = 200;
					$response['message'] = 'Berhasil Ajukan Asuransi';
				}
			} else {
				$response['message'] = 'Limit Anda Kurang';
			}

			return $this->setResponseFormat('json')->respond($response, 200);
		}
		catch (\Exception $e)
		{
			die($e->getMessage());
		}
	}
}
