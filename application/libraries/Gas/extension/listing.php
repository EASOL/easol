<?php namespace Gas\Extension;

use \Gas\Extension;

class Listing extends Result {

	/**
	 * @var mixed Gas instance(s)
	 */
	public $gas;

	/**
	 * Extension initialization method
	 *
	 * @param  object
	 * @return void
	 */
	function __init($gas)
	{
		// Here, Gas will transport your instance
		$this->gas = $gas;

		return $this;
	}

	/**
	 * Method to return records as arrays where the key is the first argument and the values are the second argument
	 *
	 * @param  string Key. Optional. If given, the array will have the value as key
	 * @param  string Field(s). Optional, will return all fields by default. If you want multiple fields, use a comma separated argument.
	 * @param string Additional entry. If provided, an additional entry will be prepended to the result array. Useful for dropdown options, when you need a first empty value option for "Select a option".
	 * @return mixed Explanation
	 */
	public function get_array($key=NULL, $fields=NULL, $additional_option=NULL)
	{
		$records = $this->to_array();
		if (!$key && !$fields) {
			if ($additional_option) $records = array(''=>$additional_option) + $records;
			return $records;
		}

		$result = array();
		$fields = explode(",", $fields);

		foreach ($records as $k=>$row) {
			if ($key == 'primary_key') $key = $this->gas[$k]->primary_key;
			if ($key) $k = $row[$key];

			if (sizeof($fields) > 1) {
				foreach($fields as $field) {
					$field = trim($field);
					$result[$k][$field] = $row[$field];
				}
			}
			elseif (!empty($fields)) {
				$field = trim($fields[0]);
				$field = explode("+", $field);
				foreach ($field as $column) {
					$column = trim($column);
					$result[$k][] = $row[$column];
				}
				$result[$k] = implode(" ", $result[$k]);

			}
			else {
				$result[$k] = $row;
			}

		}
		if ($additional_option) $result = array('' => $additional_option) + $result;


		return $result;
	}
}
