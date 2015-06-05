<?php
/**
 * User: Nahid Hossain
 * Email: mail@akmnahid.com
 * Phone: +880 172 7456 280
 * Date: 6/5/2015
 * Time: 10:25 PM
 */
require_once APPPATH.'/core/Easol_BaseWidget.php';

class Pagination extends Easol_BaseWidget {

    public $totalElements=null;
    public $pageSize=null;
    public $currentPage=0;

    /**
     * Run the widget functionality
     */
    public function run()
    {

        if($this->totalElements==null)
            throw new ErrorException("Total Page Not Set!!");
        if($this->pageSize==null)
            throw new ErrorException("Page Size Not Set!!");
        $this->render("view",['totalElements' => $this->totalElements,'pageSize'=>$this->pageSize,'currentPage'=>$this->currentPage]);
    }
}