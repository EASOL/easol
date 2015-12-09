<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Lang
 *
 * Fetches a language variable and optionally outputs a form label
 *
 * @param	string	$line		The language line
 * @param	string	$for		The "for" value (id of the form element)
 * @param	array	$attributes	Any additional HTML attributes
 * @return	string
 */
function lang($line, $for = '', $attributes = array()) {
	$ci = &get_instance();

	$line = $ci->easol_language->translate($line, true);

	if ($for !== '') {
		$line = '<label for="' . $for . '"' . _stringify_attributes($attributes) . '>' . $line . '</label>';
	}

	return $line;
}

