<?php
/**
 * User: Nahid Hossain
 * Email: mail@akmnahid.com
 * Phone: +880 172 7456 280
 * Date: 6/3/2015
 * Time: 2:43 PM
 */

class Easol_Widget extends CI_Model {

    /**
     * constructor method
     */
    public function __construct(){

        parent::__construct();
    }

    /**
     * display the widget
     * @param $widgetClass
     * @param array $param
     */
    public static function show($widgetClass,$param=[]){
            /* @var $obj Easol_BaseWidget */
            $obj = new $widgetClass();
            foreach($param as $key => $value){
                $obj->$key=$value;
            }
            $obj->run();
    }


}