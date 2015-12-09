<?php

Class Easol_Logs {

	public function Log($data) {
		$ci = &get_instance();
		$ci->db->set('DateTime', 'GETDATE()', FALSE);
//		$data['StaffUSI'] = Easol_Authentication::userdata('StaffUSI');
		$data['StaffUSI'] = $_SESSION['StaffUSI'];
		$data['Controller'] = $ci->router->fetch_class();
		$data['Method'] = $ci->router->fetch_method();
                $http_client_ip = $_SERVER['HTTP_CLIENT_IP']; 
                $http_x_forwarded_for = $_SERVER['HTTP_X_FORWARDED_FOR']; 
                $remote_addr = $ci->input->ip_address(); 
                if(!empty($http_client_ip)){
                    $data['IpAddress']=$http_client_ip;
                }else if(!empty($http_x_forwarded_for)){
                    $data['IpAddress']=$http_x_forwarded_for;
                } else {
                    $data['IpAddress']=$remote_addr;
                } 
                $data['Data'] = json_encode($data['Data']);
		$ci->db->insert('EASOL.Logs', $data);
	}
}
