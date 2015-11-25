<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Module extends Easol_Controller {


	protected function accessRules(){
		return [
			"index"     =>  ['System Administrator','Data Administrator'],
		];
	}

	public function index() {


		$this->load->library('Easol_Module');

		$data = array();
		$data['listing'] = $this->easol_module->listing();

		$this->db->where('Key', 'Module');
		$query = $this->db->get('EASOL.SystemConfiguration');

		$data['configuration'] = $query->row_array();

		if ($post = $this->input->post()) {
			$rec['Value'] = serialize($post['module']);

			if (isset($data['configuration']['SystemConfigurationId'])) {
				$rec['UpdatedBy'] = Easol_Authentication::userdata('StaffUSI');
				$rec['UpdatedOn'] = date('Y-m-d H:i:s');
				$this->db->update("EASOL.SystemConfiguration", $rec);
				$this->db->where('SystemConfigurationId', $data['configuration']['SystemConfigurationId']);
			}
			else {
				$rec['CreatedBy'] = Easol_Authentication::userdata('StaffUSI');
				$rec['CreatedOn'] = date('Y-m-d H:i:s');
				$rec['Key'] = 'Module';
				$this->db->insert("EASOL.SystemConfiguration", $rec);
			}

			$this->session->set_flashdata('message', 'Modules Configuration Updated Successfully');
			$this->session->set_flashdata('type', 'success');

			return redirect('system-settings/module');
		}

		$data['configuration'] = unserialize($data['configuration']['Value']);

		$this->render('index', $data);
	}


}
