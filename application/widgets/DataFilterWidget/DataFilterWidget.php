<?php

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