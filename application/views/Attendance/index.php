<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Attendance</h1>

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
                //'colGroupBy'    =>  $colGroupBy,
                'columns'   =>
                    [

                        ['name' => 'FirstName', 'title' => 'Student Name', 'value' => function($model){return $model->FirstName.' '.$model->LastSurname;}],
                        ['name' => 'GradeLevel', 'title' => 'Grade Level' ],
                        ['name' => 'Days', 'title' => 'Present' ],
                        ['name' => 'Days', 'title' => 'Excused' ],
                        ['name' => 'Days', 'title' => 'Unexcused' ]

                    ],
                'downloadCSV' => true,
                'view' => 'Attendance/index'
            ]

        ) ?>
    </div>
</div>