<?php 
    $filter = $model->getFilters();
    $ReportData = $this->db->query($model->getReportQuery()); 
    $_columns=[];

    if (!empty($ReportData)) {
        foreach($ReportData->list_fields() as $key){
            $_columns[] = $key;
        }
    }
?>

<?php if($displayTitle==TRUE){ ?>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <h3 class="page-header"><a href="<?php echo site_url('reports/view/'.$model->ReportId) ?>"><?php echo $model->ReportName ?></a></h3>
    </div>
</div>
<?php } ?>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="panel panel-default">

            <?php if(($filter = $model->getFilters()) && !$hideFilters): ?>
                <div class="panel-body" id="filter-destination">
                    <?php $this->load->view('Reports/_report-filters', ['filter'=>$filter, 'report'=>$model]); ?>
                </div>
            <?php endif;   ?>

          
            <div class="panel-body">
                <?php include('display-table-view.php'); ?>
            </div>
        </div>
    </div>
</div>
