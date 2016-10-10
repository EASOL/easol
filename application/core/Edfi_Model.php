<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edfi_Model extends CI_Model {

	public $table;
	public $has_many;
	public $has_one;
	public $belongs_to;

	public function __construct()
 {

		parent::__construct();

	}

	function get($filter=array(), $select=NULL) 
 {

		if ($filter === NULL) {
			return NULL;
		}

		if (is_array($filter)) {
			foreach($filter as $field=>$value) {
				($value === FALSE) ? $this->db->where($field) : $this->db->where($field, $value);
			}
		}
		elseif (is_numeric($filter)) {
			$this->db->where('id', $filter);
		}

		if ($select) {
			$this->db->select($select, FALSE);
		}
		$this->db->limit(1);
		$query = $this->db->get($this->table);

		$row = $query->row_array();

		if ($select && sizeof(explode(",", $select)) == 1) {
			if (stripos($select, ' as ') !== FALSE) {
				$select = explode(' as ', $select);
				return $row[$select[1]];
			}
			else return $row[$select];
		}

		return $row;
	}

	public function listing($filter=array(), $key_value=NULL) 
 {

		if (isset($filter['order_by'])) {
			if (is_array($filter['order_by'])) {
				foreach ($filter['order_by'] as $order_by) {
					$this->db->order_by($order_by);
				}
			}
			else $this->db->order_by($filter['order_by']);
			unset($filter['order_by']);
		}

		if ($filter['group_by']) {
			$this->db->group_by($filter['group_by']);
			unset($filter['group_by']);
		}

		if ($filter['limit']) {
			$this->db->limit($filter['limit']);
			$this->db->offset($filter['offset']);
			unset($filter['limit'], $filter['offset']);
		}

		if (is_array($filter)) {
			foreach ($filter as $field=>$v) {
				if ($v === FALSE) {
					$this->db->where($field);
				}
				else {
					$this->db->where($field, $v);
				}
			}
		}

		if ($key_value) {
			$result = array();

			$key_value = explode("=>", $key_value);
			$key = trim($key_value[0]);
			$value = trim($key_value[1]);
		}

		if ($value) $this->db->select("$key, $value");

		$query = $this->db->get($this->table);

		if ($key_value) {
			$result = array();

			foreach ($query->result_array() as $row) {
				if (!$value) $result[$row["$key"]] = $row;
				else $result[$row["$key"]] = $row["$value"];
			}
			return $result;
		}

		return $query->result_array();
	}

	public function count($filter=array()) 
 {

		unset($filter['limit'], $filter['offset'], $filter['order_by'], $filter['group_by']);

		if (is_array($filter)) {
			foreach ($filter as $field=>$value) {
				if ($value === FALSE) {
					$this->db->where($field);
				}
				else {
					$this->db->where($field, $value);
				}
			}
		}

		$count = $this->db->count_all_results($this->table);

		return $count;
	}
}

