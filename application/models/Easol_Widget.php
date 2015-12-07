<?php


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

            require_once APPPATH.'/widgets/'.$widgetClass.'/'.$widgetClass.'.php';
            $obj = new $widgetClass();
            foreach($param as $key => $value){
                $obj->$key=$value;
            }
            $obj->run();
    }


}