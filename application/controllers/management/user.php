<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Easol_Controller {

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

	public function index()
	{

		$users = Model\Easol\StaffAuthentication::all();

		$this->render('index', [
			'users' => $users,
		]);
	}

	public function save($StaffUSI=NULL) 
 {

		$data = array('school'=>'');
		if ($StaffUSI) {
			$data['user'] = $user = Model\Easol\StaffAuthentication::find($StaffUSI);
			$data['post']['school'] = $user->Staff()->EducationOrganization()[0]->EducationOrganizationId;
			$data['post']['user'] = $user->record->get('data');
		}

		if ($post = $this->input->post()) {

			$data['post'] = $post;
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			$this->form_validation->set_rules('user[StaffUSI]', 'StaffUSI', 'required');
			$this->form_validation->set_rules('user[RoleId]', 'Role', 'required');

			if (!isset($post['user']['GoogleAuth']) && !isset($user))
				$this->form_validation->set_rules('user[Password]', 'Password', 'required|min_length[6]');

			if ($this->form_validation->run() === TRUE) {

				if (!isset($post['user']['GoogleAuth'])) $post['user']['GoogleAuth'] = 0;

				if (!isset($data['user'])) $post['user']['CreateDate'] = date('Y-m-d G:i:s');
				$post['user']['LastModifiedDate'] = date('Y-m-d G:i:s');

				if (!empty($post['user']['Password'])) $post['user']['Password'] = sha1($post['user']['Password']);
				else unset($post['user']['Password']);

				if (isset($user)) {
					foreach ($post['user'] as $field=>$value) {
						$user->$field = $value;
					}
					$result = $user->save();
				}
				else $result = Model\Easol\StaffAuthentication::make($post['user'])->save();

				if (!$result)
					$this->session->set_flashdata('error', 'There was an error processing your request.');
				else
					$this->session->set_flashdata('success', 'The user was saved successfully.');

				redirect('management/user');
			}
			else {

			}
		}

		$data['school_listing'] = Model\Edfi\EducationOrganization::listing()->all()->get_array('primary_key', 'NameOfInstitution', 'All Schools');

		$data['staff_listing'] = Model\Edfi\Staff::all();

		$data['role_listing'] = Model\Easol\RoleType::listing()->all()->get_array('primary_key', 'RoleTypeName');

		$this->render('save', $data);
	}

	public function delete($StaffUSI) 
 {
		Model\Easol\StaffAuthentication::delete($StaffUSI);
		redirect('/management/user');
	}
}
