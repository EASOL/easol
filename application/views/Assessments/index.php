<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Assessments</h1>
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

                        ['name' => 'AssessmentTitle', 'title' => 'Assessment Name'],
                        ['name' => 'Version', 'title' => 'Version'],
                        ['name' => 'AdministrationDate', 'title' => 'Administration Date'],
                        ['name' => 'StudentCount', 'title' => 'Students' ],
                        ['name' => 'AverageResult', 'title' => 'Average Result' ],

                    ],
                'downloadCSV' => true
            ]

        ) ?>
    </div>
</div>