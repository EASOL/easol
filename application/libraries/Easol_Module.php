<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Easol_Module {

	public function __construct()
	{
		$this->ci =& get_instance();
	}

	public function listing() {
		$modules = scandir(APPPATH.'modules');
		$listing = array();
		foreach ($modules as $module) {
			if (is_dir(APPPATH . 'modules/'.$module) && $module != '.' && $module != '..')
				$listing[$module] = ucwords(str_replace(array('-', '_'), '', $module));
		}

		return $listing;

	}

}
