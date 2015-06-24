<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Cohorts</h1>
        <br/><br/>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?php Easol_Widget::show("DataTableWidget",
            [
                'query' => $query,
                'pagination' => $pagination,
                'filter'    =>  $filter,
                'colOrderBy'    =>  $colOrderBy,
                'colGroupBy'    =>  $colGroupBy,
                'columns'   =>
                    [

                        ['name' => 'CohortIdentifier', 'title' => 'Name'],
                        ['name' => 'CohortDescription', 'title' => 'Description'],
                        ['name' => 'StudentCount', 'title' => 'Students' ]

                    ],
                'downloadCSV' => true
            ]

        ) ?>
    </div>
</div>