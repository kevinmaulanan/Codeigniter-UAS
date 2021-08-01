<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

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
				'token' => getSignedJWTForUser($email)
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
			return "Oke";
		}
		catch (\Exception $e)
		{
			die($e->getMessage());
		}
	}
}
