<?php
/**
 * Part of CI PHPUnit Test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Reports_test extends TestCase
{
	public function test_index()
	{
		$output = $this->request('GET', 'reports/index');
		$this->assertContains('<h1 class="page-header">Flex Reports</h1>', $output);
		$this->assertContains('F&P ELA Mastery for 2nd Grade Students', $output);

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

	public function setUp() {
		//system("sqlcmd -S REGIS-PC\SQLEXPRESS -i ".APPPATH."tests/database.sql");
	}


}
