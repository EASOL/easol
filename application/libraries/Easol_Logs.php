<?php 

Class Easol_logs {

	public function logs($data) {
		$ci = &get_instance();
                $ci->db->set('DateTime', 'GETDATE()', FALSE);
		$ci->db->insert('EASOL.Logs', $data); 
	}
}