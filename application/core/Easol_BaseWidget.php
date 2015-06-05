<?php
/**
 * User: Nahid Hossain
 * Email: mail@akmnahid.com
 * Phone: +880 172 7456 280
 * Date: 6/3/2015
 * Time: 2:50 PM
 */

abstract class Easol_BaseWidget extends CI_Model {

    public $htmlOptions=[];


    /**
     * Run the widget functionality
     */
    public abstract function run();

    /**
     * render widget view
     * @param $view
     * @param array $param
     */
    public function render($view,$params=[]){

        $this->load->view("../widgets/".get_called_class().'/'.$view,$params);


    }

}