<?php

require_once APPPATH.'/core/Easol_BaseWidget.php';

class PaginationWidget extends Easol_BaseWidget {

    public $totalElements=null;
    public $pageSize=null;
    public $currentPage=1;
    public $url="";

    /**
     * Run the widget functionality
     */
    public function run()
    {
        if($this->pageSize==null)
            throw new ErrorException("Page Size Not Set!!");

        $noOfPage =ceil($this->totalElements/$this->pageSize);
        $this->render("view",['noOfPage' => $noOfPage,'currentPage'=>$this->currentPage,'url' => $this->url, 'total' => $this->totalElements, 'pageSize' => $this->pageSize]);
    }
}