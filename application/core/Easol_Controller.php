<?php
/**
 * User: Nahid Hossain
 * Email: mail@akmnahid.com
 * Phone: +880 172 7456 280
 * Date: 6/1/2015
 * Time: 11:16 PM
 */
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

        $this->processAccessRules();
    }

    /**
     * Render method, renders view file and put it in the layout
     * @param $view
     * @param array $params
     * @param bool $return
     */
    public function render($view,$params=[],$return=false){

        ob_start();
        $this->load->view(get_called_class().'/'.$view,$params);
        $content= ob_get_contents();
        ob_clean();
        if($this->layout!=null){
            $this->load->view($this->layout,
                [
                    'content'   =>  $content,
                    'title'     =>  $this->pageTitle
                ]
            );
        }
        else
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
    protected function authorize($allowedRoles=[]){

        if($allowedRoles=='@' && !Easol_Authentication::isLoggedIn())
            return redirect('home');
        if(Easol_AuthorizationRoles::hasAccess($allowedRoles))
            return true;
        return redirect('home/accessdenied');

    }


    /**
     * Access Rules. Should be overridden
     * @return array
     */
    protected function accessRules(){
        return [];
    }

    protected function processAccessRules(){

        if(array_key_exists($this->router->fetch_method(),$this->accessRules())){
            return $this->authorize($this->accessRules()[$this->router->fetch_method()]);
        }

        if(array_key_exists('default',$this->accessRules())){
            return $this->authorize($this->accessRules()['default']);
        }

        return $this->authorize("@");
    }

}