<div class="row">
    <div class="col-md-12 col-sm-12">
        <h1 class="page-header">Assessments</h1>
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

					[
					    'name' => 'AssessmentTitle',
					    'title' => 'Assessment Name',
					    'type' => 'url',
					    'url' =>
						    function ($model) {
							    return site_url("assessments/detail/{model->AssessmentTitle}/{$model->AcademicSubjectDescriptorId}/{$model->AssessedGradeLevelDescriptorId}/{$model->Version}" );
						    },
					],
					['name' => 'Grade', 'title' => 'Grade'],
					['name' => 'Subject', 'title' => 'Subject'],
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
