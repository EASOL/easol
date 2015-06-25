<?php /* @var $cohort Edfi_Cohort */ ?>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Cohort</h1>
        <br/><br/>
    </div>
</div>
<div class="col-md-6">
<table class="table table-bordered ">
    <tr>
        <th>Cohort ID:</th>
        <td><?= $cohort->CohortIdentifier ?></td>
    </tr>
    <tr>
        <th>Cohort Description:</th>
        <td><?= $cohort->CohortDescription ?></td>
    </tr>
</table>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <?php Easol_Widget::show("DataTableWidget",
            [
                'query' => $query,
                'pagination' => $pagination,
                'colOrderBy'    =>  $colOrderBy,
                'columns'   =>
                    [

                        ['name' => 'FirstName', 'title' => 'Student Name',
                            'value' => function($model){return $model->FirstName.' '.$model->LastSurname;},
                            'type' => 'url',
                            'url' => function($model){return site_url('student/profile/'.$model->StudentUSI); }
                        ],

                    ],
                'downloadCSV' => true
            ]

        ) ?>
    </div>
</div>