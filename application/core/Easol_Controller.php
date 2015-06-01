<?php
/**
 * User: Nahid Hossain
 * Email: mail@akmnahid.com
 * Phone: +880 172 7456 280
 * Date: 6/1/2015
 * Time: 11:16 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Easol_Controller extends CI_Controller {
    protected $layout='layout/default/main';

    protected $pageTitle='EASOL - Online Learning Management';

    /**
     * constructor method
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Render method, renders view file and put it in the layout
     * @param $view
     * @param array $params
     * @param bool $return
     */
    public function render($view,$params=[],$return=false){
        $this->load->helper('url');
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

}