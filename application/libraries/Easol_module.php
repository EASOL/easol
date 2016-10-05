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
			if (is_dir(APPPATH . 'modules/'.$module) && $module != '.' && $module != '..') {

				$listing[$module] = ['label'=>ucwords(str_replace(array('-', '_'), '', $module)), 'config'=>[]];
				if (file_exists(APPPATH . 'modules/' . $module . '/config/config.php')) {
					require_once(APPPATH . 'modules/' . $module . '/config/config.php');
					foreach ($config[$module] as $key => $label) {
						$listing[$module]['config'][$key] = $label;
					}
				}
			}

		}

		return $listing;

	}

	public function module_config($module=NULL) {
		$config = Model\Easol\SystemConfiguration::limit(1)->find_by_key('module', false);

		if (!$config) return [];

		$config = json_decode($config->Value);

		if (!$module) return $config;

		return $config->$module;
	}

	public function is_module($section) {
		if (is_dir(APPPATH . 'modules/' . $section)) return true;
		return false;
	}

	public function is_enabled($module) {
		$config = $this->module_config($module);

		if ($config->enabled == 1) return true;
		return false;
	}

}
