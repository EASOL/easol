<?php
    $this->load->view("Reports/".$dashboardConf->getBottomTable()->getViewName(),['model' => $dashboardConf->getBottomTable(),'pageNo'=>$tablePageNo,'paginationUrl' =>"dashboard/index", 'displayTitle' => true ]);
?>