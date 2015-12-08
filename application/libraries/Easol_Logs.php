<?php

Class Easol_Logs {

	public function Log($data) {
		$ci = &get_instance();
		$ci->db->set('DateTime', 'GETDATE()', FALSE);
//		$data['StaffUSI'] = Easol_Authentication::userdata('StaffUSI');
		$data['StaffUSI'] = $_SESSION['StaffUSI'];
		$data['Controller'] = $ci->router->fetch_class();
		$data['Method'] = $ci->router->fetch_method();
		$data['IpAddress'] = $_SERVER['REMOTE_ADDR'];//$ci->input->ip_address();
                $data['Data'] = json_encode($data['Data']);
		$ci->db->insert('EASOL.Logs', $data);
	}
}
