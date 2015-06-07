<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Schools</h1>
        <br/><br/>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?php Easol_Widget::show("DataTableWidget",
            [
                'query' => $query,
                'pagination' => $pagination,
                'columns'   =>
                    [
                        ['name' => 'EducationOrganizationId', 'title' => 'Education Organization Id','type' => 'url',
                            'url' =>
                                function($model){
                                    return $model->EducationOrganizationId;
                                }
                        ],
                        ['name' => 'NameOfInstitution', 'title' => 'Name of Institution' ],
                        ['name' => 'City', 'title' => 'City' ]
                    ]
            ]

        ) ?>
    </div>
</div>