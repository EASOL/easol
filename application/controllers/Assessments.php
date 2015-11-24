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
	public function index() {
		$currentYear= Easol_SchoolConfiguration::getValue('CURRENT_SCHOOLYEAR');
		$currentYear_default=Easol_SchoolConfiguration::setDefault('Year', $currentYear);

		$query = "SELECT
               AssessmentTitle,
               edfi.StudentAssessmentScoreResult.AcademicSubjectDescriptorId,
               edfi.StudentAssessmentScoreResult.AssessedGradeLevelDescriptorId,
               Version, AdministrationDate,
               edfi.AcademicSubjectType.CodeValue +'' as Subject,
               edfi.GradeLevelType.CodeValue +'' as Grade,
			AVG(CAST(StudentAssessmentScoreResult.Result as FLOAT)) as AverageResult,
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

			WHERE  ISNUMERIC(StudentAssessmentScoreResult.Result) = 1
			GROUP BY  AssessmentTitle,Version,AdministrationDate, edfi.StudentAssessmentScoreResult.AcademicSubjectDescriptorId, edfi.StudentAssessmentScoreResult.AssessedGradeLevelDescriptorId, edfi.AcademicSubjectType.CodeValue, edfi.GradeLevelType.CodeValue";

		$query = $this->db->query($query);

		$data = ['result'=>$query->result()];

		$filter = ['year' => [""=>"All Years"], 'subject' => [""=>"All Subjects"], 'grade'=> [""=>"All Grade Levels"]];
		foreach ($query->result() as $row) {
			$filter['year'][date('Y', strtotime($row->AdministrationDate))] = date('Y', strtotime($row->AdministrationDate));
			$filter['subject'][$row->Subject] = $row->Subject;
		}

		$query = $this->db->query("SELECT * FROM edfi.GradeLevelType ORDER BY GradeLevelTypeId ASC");
		foreach ($query->result() as $row) {
			$filter['grade'][$row->CodeValue] = $row->CodeValue;
		}


		$data['filter'] = $filter;

		$this->render('index', $data);

	}

	/**
	 * @param $AssessmentTitle
	 * @param $AcademicSubjectDescriptorId
	 * @param $AssessedGradeLevelDescriptorId
	 * @param $AdministrationDate
	 */
	public function details($AssessmentTitle, $AcademicSubjectDescriptorId, $AssessedGradeLevelDescriptorId,  $Version, $AdministrationDate) {

		$AdministrationDate = date('Y-m-d', $AdministrationDate);
		$AssessmentTitle = urldecode($AssessmentTitle);

		$query = "SELECT
               AssessmentTitle,
               edfi.StudentAssessmentScoreResult.AcademicSubjectDescriptorId,
               edfi.StudentAssessmentScoreResult.AssessedGradeLevelDescriptorId,
               Version, AdministrationDate,
               edfi.AcademicSubjectType.CodeValue +'' as Subject,
               edfi.GradeLevelType.CodeValue +'' as Grade,
			AVG(CAST(StudentAssessmentScoreResult.Result as FLOAT)) as AverageResult,
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
