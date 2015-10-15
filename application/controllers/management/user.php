<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Easol_Controller {

	public function __construct ()
	{
		parent::__construct();
	}

	protected function accessRules()
	{
		return [
			"index"     =>  ['System Administrator','Data Administrator'],
		];
	}

	public function index()
	{

		$users = Model\Easol\StaffAuthentication::all();

		/*foreach ($users as $user) {
			//var_dump();
			foreach ($user->staff()->educationOrganization() as $row) {
				var_dump($row->school());
			}
			exit();
		}*/

		$this->render('index', [
			'users' => $users,
		]);
	}
}
