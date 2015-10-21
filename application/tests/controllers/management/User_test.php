<?php

class User_test extends TestCase
{
	public function test_index()
	{
		$output = $this->request('GET', 'management/user/index');

		$this->assertContains('<h1 class="page-header">User Management</h1>', $output);
		$this->assertContains("207219", $output);

	}

	public function setUp() {
		//system("sqlcmd -S REGIS-PC\SQLEXPRESS -i ".APPPATH."tests/database.sql");
	}


}
