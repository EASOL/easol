<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assessments extends Easol_Controller {

	/**
	 * default constructor
	 */
	public function __construct()
 {
		parent::__construct();
	}

	protected function accessRules()
 {
		return [
			"index"     =>  ['System Administrator','Data Administrator','School Administrator'],
		];
	}
	/**
	 * index action
	 */
	public function index() 
 	{
		$currentYear= Easol_SchoolConfiguration::getValue('CURRENT_SCHOOLYEAR');
		$currentYear_default=Easol_SchoolConfiguration::setDefault('Year', $currentYear);

		$query = "SELECT
				AssessmentTitle,
				edfi.StudentAssessmentScoreResult.AcademicSubjectDescriptorId,
				edfi.StudentAssessmentScoreResult.AssessedGradeLevelDescriptorId,
				Version, AdministrationDate,
				edfi.AcademicSubjectType.CodeValue +'' as Subject,
				edfi.GradeLevelType.CodeValue +'' as Grade,
				AVG(CAST(TRY_CONVERT(float, StudentAssessmentScoreResult.Result) as FLOAT)) as AverageResult,
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
			JOIN edfi.StudentSchoolAssociation ON edfi.StudentSchoolAssociation.StudentUSI = edfi.StudentAssessmentScoreResult.StudentUSI
			WHERE  1 = 1 AND edfi.StudentSchoolAssociation.SchoolId = '". Easol_Auth::userdata('SchoolId') . "'

			GROUP BY  AssessmentTitle,Version,AdministrationDate, edfi.StudentAssessmentScoreResult.AcademicSubjectDescriptorId, edfi.StudentAssessmentScoreResult.AssessedGradeLevelDescriptorId, edfi.AcademicSubjectType.CodeValue, edfi.GradeLevelType.CodeValue";
 
		$query = $this->db->query($query);
		$data = ['result'=>$query->result()];

		$data['school_id'] = Easol_Auth::userdata('SchoolId');

		$this->render('index', $data);

	}

	/**
	 * @param $AssessmentTitle
	 * @param $AcademicSubjectDescriptorId
	 * @param $AssessedGradeLevelDescriptorId
	 * @param $AdministrationDate
	 */
	public function details($AssessmentTitle, $AcademicSubjectDescriptorId, $AssessedGradeLevelDescriptorId,  $Version, $AdministrationDate) 
 {

		$AdministrationDate = date('Y-m-d', $AdministrationDate);
		$AssessmentTitle = base64_decode(urldecode($AssessmentTitle));

		$query = "SELECT
               AssessmentTitle,
               edfi.StudentAssessmentScoreResult.AcademicSubjectDescriptorId,
               edfi.StudentAssessmentScoreResult.AssessedGradeLevelDescriptorId,
               Version, AdministrationDate,
               edfi.AcademicSubjectType.CodeValue +'' as Subject,
               edfi.GradeLevelType.CodeValue +'' as Grade,
		/*	AVG(CAST(StudentAssessmentScoreResult.Result as FLOAT)) as AverageResult,*/
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

			WHERE
				edfi.StudentAssessmentScoreResult.AssessmentTitle = '$AssessmentTitle' AND
				edfi.StudentAssessmentScoreResult.AcademicSubjectDescriptorId = '$AcademicSubjectDescriptorId' AND
				edfi.StudentAssessmentScoreResult.AssessedGradeLevelDescriptorId = '$AssessedGradeLevelDescriptorId' AND
				edfi.StudentAssessmentScoreResult.Version = '$Version' AND
				edfi.StudentAssessmentScoreResult.AdministrationDate = '$AdministrationDate'


			GROUP BY  AssessmentTitle,Version,AdministrationDate, edfi.StudentAssessmentScoreResult.AcademicSubjectDescriptorId, edfi.StudentAssessmentScoreResult.AssessedGradeLevelDescriptorId, edfi.AcademicSubjectType.CodeValue, edfi.GradeLevelType.CodeValue";

		$query = $this->db->query($query);
		$data['assessment'] = $query->row();


		$query = "SELECT
               	edfi.Student.StudentUSI, edfi.Student.FirstName, edfi.Student.MiddleName, edfi.Student.LastSurname,
               	edfi.StudentAssessmentScoreResult.Result
			FROM edfi.StudentAssessmentScoreResult
			JOIN edfi.Student ON edfi.Student.StudentUSI = edfi.StudentAssessmentScoreResult.StudentUSI
			WHERE
				edfi.StudentAssessmentScoreResult.AssessmentTitle = '$AssessmentTitle' AND
				edfi.StudentAssessmentScoreResult.AcademicSubjectDescriptorId = '$AcademicSubjectDescriptorId' AND
				edfi.StudentAssessmentScoreResult.AssessedGradeLevelDescriptorId = '$AssessedGradeLevelDescriptorId' AND
				edfi.StudentAssessmentScoreResult.Version = '$Version' AND
				edfi.StudentAssessmentScoreResult.AdministrationDate = '$AdministrationDate' ";

		$query = $this->db->query($query);
		$data['students'] = $query->result();

		$this->render('details', $data);
	}
}
