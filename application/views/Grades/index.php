<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Grades</h1>
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
                        ['name' => 'LocalCourseCode', 'title' => 'Course', 'value'=>function($model){
                            if(Easol_Helper::$tableGroupValue!=$model->LocalCourseCode){
                                Easol_Helper::$tableGroupValue=$model->LocalCourseCode;
                                Easol_Helper::$tableGroupCount++;
                                if(Easol_Helper::$tableGroupCount>1){
                                    return '</td><td></td><td></td><td></td><td></td><td></td><tr><td>'.$model->LocalCourseCode;
                                }
                                else return $model->LocalCourseCode;
                            }
                        }],
                        ['name' => 'UniqueSectionCode', 'title' => 'Section Name'],
                        ['name' => 'ClassPeriodName', 'title' => 'Period'],
                        ['name' => 'FirstName', 'title' => 'Educator','value' => function($model){ return $model->FirstName.' '.$model->LastSurname;  }],
                        ['name' => 'StudentCount', 'title' => 'Students' ],
                        ['name' => 'StudentCount', 'title' => 'Grades', 'value' => function($model){
                            return '
                            <div class="grade_color">
                            <span class="label label-Primary">'.$model->Numeric_A.'</span>
                            <span class="label label-Success">'.$model->Numeric_B.'</span>
                            <span class="label label-Default">'.$model->Numeric_C.'</span>
                            <span class="label label-Info">'.$model->Numeric_D.'</span>
                            <span class="label label-Warning">'.$model->Numeric_F.'</span>
                            </div>
                            ';

                        } ]
                    ],
                'downloadCSV' => true
            ]

        ) ?>
    </div>
</div>