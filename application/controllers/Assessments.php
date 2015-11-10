<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assessments extends Easol_Controller {

    /**
     * default constructor
     */
    public function __construct(){
        parent::__construct();
    }

    protected function accessRules(){
        return [
            "index"     =>  ['System Administrator','Data Administrator'],
        ];
    }
    /**
     * index action
     */
    public function index($id=1) {
	$currentYear= Easol_SchoolConfiguration::getValue('CURRENT_SCHOOLYEAR');
        $currentYear_default=Easol_SchoolConfiguration::setDefault('Year', $currentYear);

        $query = "SELECT
               AssessmentTitle,
               edfi.StudentAssessmentScoreResult.AcademicSubjectDescriptorId,
               edfi.StudentAssessmentScoreResult.AssessedGradeLevelDescriptorId,
               Version, AdministrationDate,
               edfi.AcademicSubjectType.CodeValue as Subject,
               edfi.GradeLevelType.CodeValue as Grade,
AVG(CAST(StudentAssessmentScoreResult.Result as INT)) as AverageResult,
COUNT(*) as StudentCount
FROM edfi.StudentAssessmentScoreResult
JOIN edfi.AcademicSubjectDescriptor ON edfi.AcademicSubjectDescriptor.AcademicSubjectDescriptorId = edfi.StudentAssessmentScoreResult
.AcademicSubjectDescriptorId
JOIN edfi.AcademicSubjectType ON edfi.AcademicSubjectType.AcademicSubjectTypeId = edfi.AcademicSubjectDescriptor
.AcademicSubjectTypeId

JOIN edfi.GradeLevelDescriptor ON edfi.GradeLevelDescriptor.GradeLevelDescriptorId = edfi.StudentAssessmentScoreResult
.AssessedGradeLevelDescriptorId
JOIN edfi.GradeLevelType ON edfi.GradeLevelType.GradeLevelTypeId = edfi.GradeLevelDescriptor
.GradeLevelTypeId

WHERE  ISNUMERIC(StudentAssessmentScoreResult.Result) = 1 ";


        $this->render("index", [
            'query' => $query,
            'colOrderBy' => ['AssessmentTitle'],
            'colGroupBy' => ['AssessmentTitle','Version','AdministrationDate', 'edfi.StudentAssessmentScoreResult.AcademicSubjectDescriptorId', 'edfi.StudentAssessmentScoreResult.AssessedGradeLevelDescriptorId', 'edfi.AcademicSubjectType.CodeValue', 'edfi.GradeLevelType.CodeValue'],
            'filter' => [
                'dataBind' => true,
                'bindIndex' => ['Year' => ['glue'=>'and']],
                'queryWhere' => false,
                'fields' =>
                    [

                        'Year' =>
                            [
                                'range' =>
                                    [
                                        'type' => 'dynamic',
                                        'start' => $currentYear, //2000,
                                        'end' => date('Y'),
                                        'increament' => 1,
                                    ],
                                'searchColumn' => 'YEAR(StudentAssessmentScoreResult.AdministrationDate) ',
                                'searchColumnType' => 'int',
                                'queryBuilderColumn' => 'YEAR(StudentAssessmentScoreResult.AdministrationDate)',
                                'default' => ($this->input->get('filter[Year]') == null) ? $currentYear_default : $this->input->get('filter[Year]'),
                                'label' => 'Administration Year',
                                'type' => 'dropdown',
                                'bindDatabase' => true,
                                'prompt' => 'All Years'

                            ],

                        'Result'    =>
                            [
                                'range'     =>
                                    [
                                        'type'  =>  'set',
                                        'set'   =>  [10,25,50,100,200,500]
                                    ],
                                'default'   =>  (!$this->input->get('filter[Result]')) ? 2 : $this->input->get('filter[Result]'),
                                'label'     =>  'Results',
                                'type'      =>  'dropdown',
                                'bindDatabase'  => false,
                                'fieldType' => 'pageSize'
                            ],

                    ]

            ],
            'pagination' =>
                [
                    'pageSize' => EASOL_PAGINATION_PAGE_SIZE,
                    'currentPage' => $id,
                    'url' => 'assessments/index/@pageNo'
                ]
        ]);
	}
}
