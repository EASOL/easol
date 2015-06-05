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


    protected function authorize($allowedRoles=[]){

        if(Easol_Authentication::isLoggedIn()){
            if(Easol_AuthorizationRoles::hasAccess($allowedRoles)){
                return true;
            }
            return redirect('home/accessdenied');

        }
        return redirect('home');


    }

}