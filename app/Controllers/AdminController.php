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

class AdminController extends BaseController
{
	public function home()
	{
		try
		{		
			$tracking = new TrackingsModel();
	
			$all = $tracking->getAll();
			$inProgress = $tracking->getInProgress('Dalam Proses');
			$approved = $tracking->getInProgress('Approved');
			$rejected = $tracking->getInProgress('Rejected');
			$percentInProgress = count($inProgress) != 0 
				? count($inProgress) / count($all) * 100
				: 0;
			$percentApproved = count($approved) != 0 
				? count($approved) / count($all) * 100
				: 0;
			$percentRejected = count($rejected) != 0 
				? count($rejected) / count($all) * 100
				: 0;
			return view("admin/home", [
				'all' => $all,
				'inProgress' => $inProgress,
				'approved' => $approved,
				'rejected' => $rejected,
				'percentInProgress' => $percentInProgress,
				'percentApproved' => $percentApproved,
				'percentRejected' => $percentRejected,
			]);
		}
		catch (\Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function users()
	{
		try
		{		
			$users = new UsersModel();
			$data = $users->getAll();
			return view('admin/users', ['users' => $data]);
		}
		catch (\Exception $e)
		{
			die($e->getMessage());
		}
	}
	
	public function tracking($type)
	{
		try
		{	
			$checkType = null;
			$tracking = new TrackingsModel();
			if ($type == 'all') {
				$checkType['data'] = $tracking->getAll();
				$checkType['type'] = "All";
			} else if ($type == 'in-progress') {
				$checkType['data'] = $tracking->getInProgress('Dalam Proses');
				$checkType['type'] = "In Progress";
			} else if ($type == 'approved') {
				$checkType['data'] = $tracking->getInProgress('Approved');
				$checkType['type'] = "Approved";
			} else if ($type == 'rejected') {
				$checkType['data'] = $tracking->getInProgress('Rejected');
				$checkType['type'] = "Rejected";
			} else {
				throw new Error('Invalid type request');
			}
	
			return view("admin/tracking", [
				'tracking' => $checkType['data'],
				'type' => $checkType['type'],
			]);
		}
		catch (\Exception $e)
		{
			die($e->getMessage());
		}
	}
}
