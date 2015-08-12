<div class="row">
    <div class="col-md-12 col-sm-12">
        <h1 class="page-header">Students</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <?php Easol_Widget::show("DataTableWidget",
            [
                'query' => $query,
                'filter'  =>  $filter,
                'pagination' => $pagination,
                'colOrderBy'    =>  $colOrderBy,
                'columns'   =>
                    [
                        ['name' => 'StudentUSI', 'title' => 'Student Name',
                            'sortable' => true,
                            'sortField' => 'FirstName',
                            'type' => 'url',
                            'url' =>
                                function($model){
                                    return site_url('student/profile/'.$model->StudentUSI);
                                },
                            'value' =>
                                function($model){
                                    return $model->FirstName.' '.$model->LastSurname;
                                }

                        ],
                        ['name' => 'Description',
                            'sortable' => true,
                            'sortField' => 'GradeLevelType.Description',
                            'title' => 'Grade Level' ],
                        ['name' => 'CohortIdentifier',
                            'sortable' => true,
                            'sortField' => 'StudentCohortAssociation.CohortIdentifier',
                            'title' => 'Cohort' ]
                    ],
                'downloadCSV' => true
            ]

        ) ?>
    </div>
</div>