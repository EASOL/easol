<?php

Class Easol_Logs {

	public function Log($data) {
		$ci = &get_instance();
		$ci->db->set('DateTime', 'GETDATE()', FALSE);
		/* Tarlles: We can set up those entries in the library so the code gets more concise in the controllers.
			For the database, I noted that the PK is called logId. Can you please change that to LogId (i.e., capitalized)?
		  */
		$data['StaffUSI'] = Easol_Authentication::userdata('StaffUSI');
		$data['Controller'] = $ci->router->fetch_class();
		$data['Method'] = $ci->router->fetch_method();
		$data['IpAddress'] = $ci->input->ip_address();
		$ci->db->insert('EASOL.Logs', $data);
	}
}
