<?php

/**
* @group report
* Tests the index page
*/
use Symfony\Component\DomCrawler\Crawler;
class Reports_test extends TestCase {
	
	public function test_index()
	{
		$output = $this->request('GET', 'reports/index');

		$crawler = new Crawler($output);

		$title = $crawler->filter('h1.page-header')->eq(0)->text();
		$this->assertContains("Flex Reports", $title);

		$reportName = $crawler->filter('th:contains("Report Name")')->eq(0)->text();
		$this->assertContains("Report Name", $reportName);

		$displayType = $crawler->filter('th:contains("Display Type")')->eq(0)->text();
		$this->assertContains("Display Type", $displayType);

		$category = $crawler->filter('th:contains("Category")')->eq(0)->text();
		$this->assertContains("Category", $category);

		$school = $crawler->filter('th:contains("School")')->eq(0)->text();
		$this->assertContains("School", $school);            

		$access = $crawler->filter('th:contains("Access")')->eq(0)->text();
		$this->assertContains("Access", $access);

		$edit = $crawler->filter('th:contains("Edit")')->eq(0)->text();
		$this->assertContains("Edit", $edit);

		$delete = $crawler->filter('th:contains("Delete")')->eq(0)->text();
		$this->assertContains("Delete", $delete);

		$newFlexReport = $crawler->filter('a[class="btn btn-primary"]')->eq(0)->text();
		$this->assertContains("New Flex Report", $newFlexReport);

		$title2 = $crawler->filter('h3.panel-title')->eq(0)->text();
		$this->assertContains("Dashboard Configuration", $title2);

		$role = $crawler->filter('th:contains("Role")')->eq(0)->text();
		$this->assertContains("Role", $role); 

		$leftChart = $crawler->filter('th:contains("Left Chart")')->eq(0)->text();
		$this->assertContains("Left Chart", $leftChart); 

		$rightChart = $crawler->filter('th:contains("Right Chart")')->eq(0)->text();
		$this->assertContains("Right Chart", $rightChart); 

		$bottomTable = $crawler->filter('th:contains("Bottom Table")')->eq(0)->text();
		$this->assertContains("Bottom Table", $bottomTable); 

		$annotation = $crawler->filter('div.txt-annotation')->eq(0)->text();
		$this->assertContains("
			This computer system is the property of the the Center of Education Innovation. It is for authorized
			use only.
			Unauthorized or improper use of this system may result in civil charges and/or criminal penalties.
			", $annotation);

	}

	public function test_view_bar_chart() {
		$output = $this->request('GET', ['Reports', 'view', 13]);
		$this->assertContains('<h1 class="page-header">Flex Reports : Bar Chart : F&P ELA Mastery for 2nd Grade Students</h1>', $output);
		$this->assertContains('values: [{"label":2002,"value":46},{"label":2007,"value":181},{"label":2008,"value":205},{"label":2009,"value":216},{"label":2010,"value":152}]', $output);
	}

	public function test_view_pie_chart() {
		$output = $this->request('GET', ['Reports', 'view', 15]);
		$this->assertContains('<h1 class="page-header">Flex Reports : Pie Chart : CCSS Math Mastery for 2nd Grade Students</h1>', $output);
		$this->assertContains('[{"key":"Above","y":7},{"key":"At","y":8},{"key":"Below","y":6},{"key":"FarBelow","y":3}]', $output);

	}

	public function test_view_student_lists() {
		$output = $this->request('GET', ['Reports', 'view', 16]);
		$this->assertContains('<h1 class="page-header">Student Listing</h1>', $output);
		$this->assertContains('Showing 1&ndash;25 of 967', $output);
	}


	/**
	* @group report
	* @group report-crud
	* Tests the actual add report process
	*/
	public function test_add_post() {

		$post = [
			'report'=>[
				'ReportName' => 'F&P ELA Mastery',
				'ReportCategoryId' => '1',
				'CommandText' => 'SELECT  Version, COUNT(*) as StudentAssessments FROM edfi.Student '
				. 'INNER JOIN edfi.StudentAssessment ON Student.StudentUSI = StudentAssessment.StudentUSI '
				. 'INNER JOIN edfi.AcademicSubjectDescriptor ON StudentAssessment.AcademicSubjectDescriptorId = AcademicSubjectDescriptor.AcademicSubjectDescriptorId '
				. 'INNER JOIN edfi.AcademicSubjectType ON AcademicSubjectDescriptor.AcademicSubjectTypeId = AcademicSubjectType.AcademicSubjectTypeId '
				. 'WHERE CodeValue = \'Mathematics\' '
				. 'GROUP BY CodeValue, Version '
				. 'ORDER BY Version, CodeValue ',
				'LabelX' => 'Year',
				'LabelY' => 'Student Assesments',
				'ReportDisplayId' => '2',
				'CreatedBy' => '207219',
				'CreatedOn' => '2015-07-01 03:30:29.080',
				'UpdatedBy' => '207219',
				'UpdatedOn' => '2015-12-05 05:44:40.520',
				'SchoolId' => '255901001'
			]
		];

		$this->request('POST', 'reports/create', $post);
		$this->assertRedirect('reports/index', 302);
	}

}
