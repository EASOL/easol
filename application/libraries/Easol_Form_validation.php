<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Easol_Form_validation extends CI_Form_validation {
   
	
	public function is_unique($str, $field)
	{
		if (substr_count($field, '.')==3)
		{
			list($table,$field,$id_field,$id_val) = explode('.', $field);
			$query = $this->CI->db->limit(1)->where($field,$str)->where($id_field.' != ',$id_val)->get($table);
		} else {
			list($table, $field)=explode('.', $field);
			$query = $this->CI->db->limit(1)->get_where($table, array($field => $str));
		}

		return $query->num_rows() === 0;
	}

	
	public function is_safe_query($sql) {

		if (preg_match_all("/(INSERT |UPDATE |DELETE|DROP |SET |REPLACE |UNION |information_schema)/i", $sql, $matches)) {
			return false;
		}

		// SQL Injection check - http://www.symantec.com/connect/articles/detection-sql-injection-and-cross-site-scripting-attacks
		$regex = array();
		$regex['mssql_attack'] = "/exec(\s|\+)+(s|x)p\w+/ix";
		$regex['typical_attack'] = "/\w*((\%27)|(\'))((\%6F)|o|(\%4F))((\%72)|r|(\%52))/ix";
		$regex['union_attack'] = "/((\%27)|(\'))union/ix";
		$regex['union_attack_hex'] = "(\%27)|(\')";
		foreach ($regex as $filter) {
			$filter = preg_quote($filter, '/');
			if (preg_match("/".$filter."/", $sql)) {
				$this->set_message('is_safe_query', 'SQL Injection detected.');
				return false;
			}
		}

		$this->CI->db->db_debug = false;
		$result = $this->CI->db->query($sql);
		if (!$result) {
			$error = $this->CI->db->error();
			$this->set_message('is_safe_query', 'The %s field produces a SQL error. <br><small><i>'.$error['message'].'</i></small>');
			return false;
		}

		return true;
	}
  
}
// END MY Form Validation Class

/* End of file MY_Form_validation.php */
/* Location: ./application/libraries/MY_Form_validation.php */ 