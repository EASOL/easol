<?php

require_once APPPATH.'/core/Easol_BaseWidget.php';
class DataFilterWidget extends Easol_BaseWidget {

    public $fields=[];
    public $dataTable=null;
    public $filter=[];
    public $report=null;



    /**
     * Run the widget functionality
     */
    public function run()
    {
        if($this->dataTable != null){

        }
        $this->render("view",['fields' => $this->fields,'dataTable' => $this->dataTable, 'filter'=>$this->filter, 'report'=>$this->report]);
    }
}