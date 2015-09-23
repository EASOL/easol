<?php /* @var $model Easol_Report */ ?>

<?php
//find columns

$_colums=[];
foreach($this->db->query($model->CommandText)->row() as $key => $value){
    $_columns[] = $key;
}

?>
<?php if($displayTitle==true){ ?>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <h1 class="page-header"><?= $model->ReportName ?></h1>
    </div>
</div>
<?php } ?>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <?php Easol_Widget::show("DataTableWidget",
            [
                'query' => clean_subquery($model->CommandText),
                'pagination' => [

                    'pageSize' => EASOL_PAGINATION_PAGE_SIZE,
                    'currentPage' => $pageNo,
                    'url'   =>  isset($paginationUrl) ? $paginationUrl.'/@pageNo' :'reports/view/'.$model->ReportId.'/@pageNo'
                ],
                'colOrderBy'    =>  [$_columns[0]],
                'columns'   => $_columns,
                'downloadCSV' => true
            ]

        ) ?>
    </div>
</div>