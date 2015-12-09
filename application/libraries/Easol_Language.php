<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Easol_Language {

	public function __construct() {
		$this->ci = &get_instance();
	}

	public function translate($view, $single_line=false) {

		$language = $this->language();

		if ($language && file_exists(APPPATH.'language/'.$language)) {
			$files = scandir(APPPATH . 'language/' . $language);
			foreach ($files as $file) {
				if (is_file(APPPATH . 'language/' . $language . '/' . $file)) {
					if (strpos($file, "_lang.php") !== false) {
						$file = str_replace("_lang.php", "", $file);
						$this->ci->lang->load($file, $language);
					}
				}

			}
		}

		if ($single_line) {
			$translate = [0=>[$view], 1=>[$view]];
		}
		else {
			preg_match_all("/\{\{(.*)?\}\}/", $view, $translate);
			if (empty($translate)) return $view;
		}

		foreach ($translate[1] as $k=>$line) {
			$line = explode("|", $line);
			$string = trim($line[0]);
			if (isset($line[1])) {
				$transform = strtolower(trim($line[1]));
			}

			$translated = $this->ci->lang->line($string, false);

			if (!$translated) $translated = $this->ci->lang->line(strtolower($string), false);
			if (!$translated) $translated = $this->ci->lang->line(str_replace(" ", "_", (strtolower($string))), false);

			if (!$translated) $translated = $string;

			if ($transform == "lowercase") $translated = strtolower($translated);
			elseif ($transform == "uppercase") $translated = strtoupper($translated);
			elseif ($transform == "capitalize") $translated = ucwords($translated);

			$view = str_replace($translate[0][$k], htmlentities($translated, 0, 'ISO-8859-1'), $view);

		}


		return $view;
	}

	public function language() {
		$config = Model\Easol\SystemConfiguration::limit(1)->find_by_key('language', false);

		if (!$config) return "";

		return $config = json_decode($config->Value);
	}

	public function options() {
		$options = [];
		$languages = scandir(APPPATH . 'language');
		foreach ($languages as $language) {
			if (is_file(APPPATH . 'language/' . $language . '/easol_lang.php')) {
				$options[$language] = ucwords($language);
			}
		}

		return $options;
	}
}
