<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property  session
 */
class Easol_Controller extends CI_Controller {
	protected $layout='layout/default/main';

	protected $pageTitle='EASOL - Online Learning Management';

	/**
	 * constructor method
	 */
	public function __construct()
	{
		$this->initiateRequiredClass();
		parent::__construct();

		set_timezone();
		//$this->processAccessRules();
	}


	/**
	 * Render method, renders view file and put it in the layout
	 * @param $view
	 * @param array $params
	 * @param bool  $return
	 * @return string | null
	 */
	public function render($view,$params=[],$return=FALSE)
 {


		$content= $this->renderPartial($view, $params, TRUE);


		ob_start();
		if($this->layout!=NULL){
			$this->load->view($this->layout,
				[
					'content'   =>  $content,
					'title'     =>  $this->pageTitle,
					'error'     =>  $this->session->flashdata('error'),
					'success'   =>  $this->session->flashdata('success'),
				]
			);
		}
		else
			echo $content;

		$content= ob_get_contents();
		ob_clean();

		if($return){
			return $content;
		}
		echo $content;

	}

	public function renderPartial($view, $params = [], $return = FALSE) 
 {
		ob_start();

		if (strpos($this->router->fetch_directory(), 'modules/') !== FALSE)
			$this->load->view($this->router->fetch_class() . '/' . $view, $params);
		else
			$this->load->view($this->router->fetch_directory() . $this->router->fetch_class() . '/' . $view, $params);
		$content = ob_get_contents();
		ob_clean();

		if ($return) {
			return $content;
		}
		echo $content;
	}

	/**
	 * Include all required classes
	 */
	private function initiateRequiredClass()
	{
		//require_once APPPATH.'/core/Easol_Widget.php';

	}


	/**
	 * @param array | string $allowedRoles
	 * $allowedRoles * for grant all access, @ for all logged in users, [] for specific user
	 * @return bool|void
	 */
	protected function authorize($allowedRoles=[])
 {

		if ($this->easol_module->is_module($this->router->fetch_class()) && !$this->easol_module->is_enabled($this->router->fetch_class())) {
			return redirect('home/accessdenied');
		}


		if($allowedRoles=='@' && !Easol_Auth::isLoggedIn())
			return redirect('home');
		if(Easol_AuthorizationRoles::hasAccess($allowedRoles)){
			if(!($this->router->fetch_class()=='schools' && $this->router->fetch_method() == 'choose') && Easol_AuthorizationRoles::hasAccess(['System Administrator','Data Administrator']) && Easol_Auth::userdata('SchoolId') == FALSE  )
			{
				return redirect('schools/choose');
			}
			else return TRUE;
		}


		return redirect('home/accessdenied');

	}


	/**
	 * Access Rules. Should be overridden
	 * @return array
	 */
	protected function accessRules()
 {
		return [];
	}

	protected function processAccessRules()
 {


		if(array_key_exists($this->router->fetch_method(), $this->accessRules())){
			return $this->authorize($this->accessRules()[$this->router->fetch_method()]);
		}

		if(array_key_exists('default', $this->accessRules())){
			return $this->authorize($this->accessRules()['default']);
		}

		return $this->authorize("@");
	}

}
