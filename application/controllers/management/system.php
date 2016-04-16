<?php defined('BASEPATH') OR exit('No direct script access allowed');

class System extends Easol_Controller {

	public function __construct ()
	{
		parent::__construct();
	}

	protected function accessRules()
	{
		return [
			"index"     =>  ['System Administrator','Data Administrator'],
		];
	}

	public function index() 	{

		$data['module_listing'] = $this->easol_module->listing();

		$configurations = ['module', 'timezone', 'google_auth', 'language'];

		foreach ($configurations as $key) {
			$$key = Model\Easol\SystemConfiguration::limit(1)->find_by_key($key, false);
		}

		
		if ($post = $this->input->post()) {
			
			$post = $this->TrimArray($post);
			

			foreach ($configurations as $key) {
				if (!isset($post[$key])) continue;

				$new = false;
				if (!$$key) {
					$rec = new Model\Easol\SystemConfiguration();
					$new = true;
				}
				else $rec = $$key;
				

				$rec->Value = json_encode($post[$key]);				
				$rec->Key = $key;
				if (!$new) {
					$rec->UpdatedBy = Easol_Auth::userdata('StaffUSI');
					$rec->UpdatedOn = date('Y-m-d H:i:s');
				}
				else {
					$rec->CreatedBy = Easol_Auth::userdata('StaffUSI');
					$rec->CreatedOn = date('Y-m-d H:i:s');
				}

				$rec->save();
			}

			$this->session->set_flashdata('message', 'System Configuration Updated Successfully');
			$this->session->set_flashdata('type', 'success');

		//	return redirect('management/system');
		}


		foreach ($configurations as $key) {
			if (!$$key) continue;
			$data[$key] = json_decode($$key->Value, true);
		}

		$this->render('index', $data);

	}
	private function TrimArray($arr){

    if (!is_array($arr)){ return $arr; }
    while (list($key, $value) = each($arr)){
        if (is_array($value)){
            $arr[$key] = $this->TrimArray($value);
        }
        else {
            $arr[$key] = trim($value);
        }
    }
    return $arr;
	}

}
