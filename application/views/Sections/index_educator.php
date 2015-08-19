<div class="row">
    <div class="col-md-12 col-sm-12">
        <h1 class="page-header">Sections</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <?php Easol_Widget::show("DataTableWidget",
            [
                'query' => $query,
                'pagination' => $pagination,
                'filter'    =>  $filter,
                'colOrderBy'    =>  'EducationOrganizationId',
                'columns'   =>
                    [
                        ['name' => 'NameOfInstitution', 'title' => 'NameOfInstitution','type' => 'url',
                            'url' =>
                                function($model){
                                    return $model->EducationOrganizationId;
                                }
                        ],
                        ['name' => 'EducationOrganizationId', 'title' => 'EducationOrganizationId' ],

                    ]
            ]

        ) ?>
    </div>
</div>