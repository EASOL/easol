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
		$listing = Model\User::all();

		print_r($listing);
		exit();
	}
}
