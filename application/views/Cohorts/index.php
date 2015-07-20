<div class="row">
    <div class="col-md-12 col-sm-12">
        <h1 class="page-header">Cohorts</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <?php Easol_Widget::show("DataTableWidget",
            [
                'query' => $query,
                'pagination' => $pagination,
                'filter'    =>  $filter,
                'colOrderBy'    =>  $colOrderBy,
                'colGroupBy'    =>  $colGroupBy,
                'columns'   =>
                    [

                        ['name' => 'CohortIdentifier', 'title' => 'Name','type'=>'url','url' => function($model){ return site_url('cohorts/students/'.$model->CohortIdentifier); }],
                        ['name' => 'CohortDescription', 'title' => 'Description'],
                        ['name' => 'StudentCount', 'title' => 'Students' ]

                    ],
                'downloadCSV' => true
            ]

        ) ?>
    </div>
</div>