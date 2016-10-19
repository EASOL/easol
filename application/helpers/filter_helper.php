<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('filter_page_size_listing'))
{
	function filter_page_size_listing()
	{
		return ['25'=>'25', '50'=>'50', '100'=>'100'];
	}
}

if ( ! function_exists('filter_cohort_listing'))
{
	function filter_cohort_listing()
	{
		$ci = & get_instance();
		$query = 'SELECT DISTINCT edfi.StudentCohortAssociation.CohortIdentifier FROM edfi.StudentCohortAssociation';
        $query = $ci -> db -> query($query);

        $cohort_listing = [''=>'All Cohorts'];
        if ($query -> num_rows())
        {
        	//while ($row = $query -> unbuffered_row())
        	foreach ($query -> result() as $row)
        	{
	            $cohort_listing[$row -> CohortIdentifier] = $row -> CohortIdentifier;
	        }
        }

        return $cohort_listing;
	}
}

if ( ! function_exists('filter_grade_listing'))
{
	function filter_grade_listing($school_id = '')
	{
		$ci = & get_instance();

		$query = 'SELECT * FROM edfi.GradeLevelType WHERE GradeLevelTypeId IN 
					(SELECT DISTINCT GradeLevelType.GradeLevelTypeId FROM edfi.StudentSchoolAssociation
					 INNER JOIN edfi.Student ON StudentSchoolAssociation.StudentUSI = Student.StudentUSI
					 INNER JOIN edfi.GradeLevelDescriptor ON StudentSchoolAssociation.EntryGradeLevelDescriptorId = GradeLevelDescriptor.GradeLevelDescriptorId
					 INNER JOIN edfi.GradeLevelType ON GradeLevelDescriptor.GradeLevelTypeId = GradeLevelType.GradeLevelTypeId
					 LEFT JOIN edfi.StudentCohortAssociation ON StudentCohortAssociation.EducationOrganizationId = StudentSchoolAssociation.SchoolId AND StudentCohortAssociation.StudentUSI = StudentSchoolAssociation.StudentUSI
 					 WHERE StudentSchoolAssociation.SchoolId = ? AND GradeLevelType.GradeLevelTypeId BETWEEN -1 AND 12 )';
        $query = $ci -> db -> query($query, [$school_id]);
        $grade_listing = [''=>'All Grades'];
        if ($query -> num_rows())
        {
        	foreach ($query -> result() as $row)
        	{
        		$grade_listing[$row -> GradeLevelTypeId] = $row -> Description;
        	}
        }

        return $grade_listing;
	}
}

if ( ! function_exists('filter_year_listing'))
{
	function filter_year_listing($school_id = '')
	{
		$ci = & get_instance();

		$query = 'SELECT StudentSchoolAssociation.SchoolYear 
			      FROM edfi.StudentSchoolAssociation
				  INNER JOIN edfi.Student ON StudentSchoolAssociation.StudentUSI = Student.StudentUSI
				  INNER JOIN edfi.GradeLevelDescriptor ON StudentSchoolAssociation.EntryGradeLevelDescriptorId = GradeLevelDescriptor.GradeLevelDescriptorId
				  INNER JOIN edfi.GradeLevelType ON GradeLevelDescriptor.GradeLevelTypeId = GradeLevelType.GradeLevelTypeId
				  LEFT JOIN edfi.StudentCohortAssociation ON StudentCohortAssociation.EducationOrganizationId = StudentSchoolAssociation.SchoolId AND StudentCohortAssociation.StudentUSI = StudentSchoolAssociation.StudentUSI
				  WHERE  StudentSchoolAssociation.SchoolId = ?';
        $query = $ci -> db -> query($query, [$school_id]);
        $year_listing = [];
        if ($query -> num_rows())
        {
        	foreach ($query -> result() as $row)
        	{
        		$year_listing[easol_year($row -> SchoolYear)] = easol_year($row -> SchoolYear);
        	}
        }

        return $year_listing;
	}
}

if ( ! function_exists('filter_terms_listing'))
{
	function filter_terms_listing($school_id = '')
	{
		$ci = & get_instance();

		$terms_listing = ['' => 'All Terms'];
		
        $q  = 'SELECT TermTypeId, CodeValue 
        	   FROM edfi.TermType 
        	   WHERE TermTypeId in (SELECT distinct TermType.TermTypeId FROM "edfi"."Grade" 
			   INNER JOIN "edfi"."GradingPeriod" ON "GradingPeriod"."EducationOrganizationId" = "Grade"."SchoolId" AND 
			   		"GradingPeriod"."BeginDate" = "Grade"."BeginDate" AND "GradingPeriod"."GradingPeriodDescriptorId" = "Grade"."GradingPeriodDescriptorId" 
			   INNER JOIN "edfi"."StudentSectionAssociation" ON "StudentSectionAssociation"."StudentUSI" = "Grade"."StudentUSI" AND "StudentSectionAssociation"."SchoolId" = "Grade"."SchoolId" AND "StudentSectionAssociation"."LocalCourseCode" = "Grade"."LocalCourseCode" AND "StudentSectionAssociation"."TermTypeId" = "Grade"."TermTypeId" AND "StudentSectionAssociation"."SchoolYear" = "Grade"."SchoolYear" AND "StudentSectionAssociation"."TermTypeId" = "Grade"."TermTypeId" AND "StudentSectionAssociation"."ClassroomIdentificationCode" = "Grade"."ClassroomIdentificationCode" AND "StudentSectionAssociation"."ClassPeriodName" = "Grade"."ClassPeriodName" 
			   INNER JOIN "edfi"."Section" ON "Section"."LocalCourseCode" = "StudentSectionAssociation"."LocalCourseCode" AND "Section"."SchoolYear" = "StudentSectionAssociation"."SchoolYear" AND "Section"."TermTypeId" = "StudentSectionAssociation"."TermTypeId" AND "Section"."SchoolId" = "StudentSectionAssociation"."SchoolId" AND "Section"."ClassPeriodName" = "StudentSectionAssociation"."ClassPeriodName" AND "Section"."ClassroomIdentificationCode" = "StudentSectionAssociation"."ClassroomIdentificationCode" 
			   INNER JOIN "edfi"."StaffSectionAssociation" ON "StaffSectionAssociation"."SchoolId" = "Grade"."SchoolId" AND "StaffSectionAssociation"."LocalCourseCode" = "Grade"."LocalCourseCode" AND "StaffSectionAssociation"."TermTypeId" = "Grade"."TermTypeId" AND "StaffSectionAssociation"."SchoolYear" = "Grade"."SchoolYear" AND "StaffSectionAssociation"."TermTypeId" = "Grade"."TermTypeId" AND "StaffSectionAssociation"."ClassroomIdentificationCode" = "Grade"."ClassroomIdentificationCode" AND "StaffSectionAssociation"."ClassPeriodName" = "Grade"."ClassPeriodName" 
			   INNER JOIN "edfi"."Staff" ON "Staff"."StaffUSI" = "StaffSectionAssociation"."StaffUSI" 
			   INNER JOIN "edfi"."Course" ON "edfi"."Course"."EducationOrganizationId" = "edfi"."Grade"."SchoolId" AND "edfi"."Course"."CourseCode" = "edfi"."Grade"."LocalCourseCode" 
			   INNER JOIN "edfi"."TermType" ON "edfi"."TermType"."TermTypeId" = "edfi"."Grade"."TermTypeId" 
			   WHERE "edfi"."Grade"."SchoolId" = ?) and TermTypeId between 1 and 3';
		$query = $ci -> db -> query($q, [$school_id]);
        if ($query -> num_rows())
        {
        	foreach ($query -> result() as $row)
        	{
        		$terms_listing[$row -> CodeValue] = $row -> CodeValue;
        	}
        }

        return $terms_listing;
	}
}

if ( ! function_exists('filter_term_value'))
{
	function filter_term_value($term_id = '')
	{
		$ci = & get_instance();
		
		$q  = 'SELECT CodeValue 
        	   FROM edfi.TermType 
        	   WHERE TermTypeId = ?';
		$query = $ci -> db -> query($q, [$term_id]);
        if ($query -> num_rows())
        {
        	$row = $query -> row_array();
        	return $row['CodeValue'];
        }
        return FALSE;
	}
}

if ( ! function_exists('filter_courses_listing'))
{
	function filter_courses_listing($school_id = '')
	{
		$ci = & get_instance();

		$courses_listing = ['' => 'All Courses'];

		$q = "SELECT CourseCode, CourseTitle
			  FROM edfi.Course 
			  WHERE EducationOrganizationId = ? 
			  ORDER BY CourseTitle";
        $query = $ci -> db -> query($sql, [$school_id]);
        if ($query -> num_rows())
        {
        	foreach ($query -> result() as $row)
        	{
        		$courses_listing[$row -> CourseCode] = $row -> CourseTitle;
        	}
        }

        return $courses_listing;
	}
}

if ( ! function_exists('filter_educators_listing'))
{
	function filter_educators_listing($school_id = '')
	{
		$ci = & get_instance();

		$educators_listing = ['' => 'All Educators'];

		$q = "SELECT edfi.Staff.StaffUSI,
                     CONCAT (edfi.Staff.FirstName,' ',
                     edfi.Staff.LastSurname) as FullName
              FROM edfi.Staff
              LEFT JOIN edfi.StaffSchoolAssociation ON edfi.StaffSchoolAssociation.StaffUSI=edfi.Staff.StaffUSI
              WHERE edfi.StaffSchoolAssociation.SchoolId = ?
              ORDER By FirstName, LastSurname";
        $query = $ci -> db -> query($sql, [$school_id]);
        if ($query -> num_rows())
        {
        	foreach ($query -> result() as $row)
        	{
        		$educators_listing[$row -> FullName] = $row -> FullName;
        	}
        }

        return $educators_listing;
	}
}

if ( ! function_exists('filter_dynamic_listing'))
{
    function filter_dynamic_listing($rows = NULL, $params = [])
    {
        if ( ! isset($params['empty_label']))
        {
            $params['empty_label'] = 'All Records';
        }
        $listing = ['' => $params['empty_label']];
        if (is_array($rows))
        {
            foreach ($rows as $key => $row)
            {
                if (isset($row -> {$params['key']}, $row -> {$params['label']}))
                {
                    $listing[$row -> {$params['key']}] = $row -> {$params['label']};    
                }    
            }
        }
        return $listing;
    }
}

if ( ! function_exists('filter_subjects_listing'))
{
    function filter_subjects_listing($school_id = '')
    {
        $ci = & get_instance();

        $subjects_listing = ['' => 'All Subjects'];

        $q = "SELECT
                edfi.AcademicSubjectType.CodeValue +'' as Subject
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
            WHERE  1 = 1 AND edfi.StudentSchoolAssociation.SchoolId = ?
            GROUP BY edfi.AcademicSubjectType.CodeValue";
        $query = $ci -> db -> query($q, [$school_id]);
       
        if ($query -> num_rows())
        {
            foreach ($query -> result() as $row)
            {
                $subjects_listing[$row -> Subject] = $row -> Subject;
            }
        }

        return $subjects_listing;
    }
}