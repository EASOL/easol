<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Sections</h1>
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
                        ['name' => 'SchoolId', 'title' => 'SchoolId','type' => 'url',
                            'url' =>
                                function($model){
                                    return $model->SchoolId;
                                }
                        ],
                        ['name' => 'SchoolYear', 'title' => 'SchoolYear' ],
                        ['name' => 'LocalCourseCode', 'title' => 'LocalCourseCode' ],
                        ['name' => 'UniqueSectionCode', 'title' => 'UniqueSectionCode' ],
                        ['name' => 'StudentCount', 'title' => 'StudentCount' ]
                    ]
            ]

        ) ?>
    </div>
</div>