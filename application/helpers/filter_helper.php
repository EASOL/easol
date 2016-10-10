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