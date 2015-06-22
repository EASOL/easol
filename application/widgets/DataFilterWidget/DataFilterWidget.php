<?php
/**
 * User: Nahid Hossain
 * Email: mail@akmnahid.com
 * Phone: +880 172 7456 280
 * Date: 6/8/2015
 * Time: 12:49 AM
 */
require_once APPPATH.'/core/Easol_BaseWidget.php';
class DataFilterWidget extends Easol_BaseWidget {

    public $fields=[];
    public $dataTable=null;



    /**
     * Run the widget functionality
     */
    public function run()
    {
        if($this->dataTable != null){

        }
        $this->render("view",['fields' => $this->fields,'dataTable' => $this->dataTable]);
    }
}