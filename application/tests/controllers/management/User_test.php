<?php

use Symfony\Component\DomCrawler\Crawler;
class User_test extends TestCase
{
     /**
      * @group user
      * Tests the index page
      */
	public function test_index()
	{
            $output = $this->request('GET', 'management/user/index');

            $crawler = new Crawler($output);
            $title = $crawler->filter('h1.page-header')->eq(0)->text();

            $this->assertContains("User Management", $title);

            $addUser = $crawler->filter('button.btn.btn-primary.pull-right.pre-data-table')->eq(0)->text();
            $this->assertContains("Add User", $addUser);

            $staffUsi = $crawler->filter('th:contains("StaffUSI")')->eq(0)->text();
            $this->assertContains("StaffUSI", $staffUsi);

            $fullName = $crawler->filter('th:contains("Full Name")')->eq(0)->text();
            $this->assertContains("Full Name", $fullName);
            
            $role = $crawler->filter('th:contains("Role")')->eq(0)->text();
            $this->assertContains("Role", $role);
            
            $authorization = $crawler->filter('th:contains("Authorization Type")')->eq(0)->text();
            $this->assertContains("Authorization Type", $authorization);
            
            $school = $crawler->filter('th:contains("School")')->eq(0)->text();
            $this->assertContains("School", $school);
            
            $actions = $crawler->filter('th:contains("Actions")')->eq(0)->text();
            $this->assertContains("Actions", $actions);
            
            $annotation = $crawler->filter('div.txt-annotation')->eq(0)->text();
            $this->assertContains("
                    This computer system is the property of the the Center of Education Innovation. It is for authorized
                    use only.
                    Unauthorized or improper use of this system may result in civil charges and/or criminal penalties.
                ", $annotation);
	}

     /**
      * @group user
      * @group user-crud
      * Tests the save page in create mode, i.e., no id is passed.
      */
     public function test_add_form() {
          $output = $this->request('GET', 'management/user/save');

          $crawler = new Crawler($output);

          $title = $crawler->filter('h1.page-header')->eq(0)->text();
          $this->assertContains("User Management", $title);

          $schoolField = $crawler->filter('label[for="school"]')->eq(0)->text();
          $this->assertContains("Filter by School", $schoolField);

          $nameField = $crawler->filter('label[for="staffusi"]')->eq(0)->text();
          $this->assertContains("StaffUSI Full Name", $nameField);
          
          $roleField = $crawler->filter('label[for="role"]')->eq(0)->text();
          $this->assertContains("Role", $roleField);

     }

     /**
      * @group user
      * @group user-crud
      * Tests the actual add process
      */
     public function test_add_post() {

           $post = [
                'user'=>[
                     'StaffUSI'=>'207219',
                     'RoleId'=>'1',
                     'Password'=>'123456'
                ]
           ];

           $this->request('POST', 'management/user/save', $post);
           $this->assertRedirect('management/user', 302);

	}

     public function test_edit()
	{
		$output = $this->request('GET', 'management/user/save/207285');

		$this->assertContains('<h1 class="page-header">User Management</h1>', $output);
                $this->assertContains('<label for="school">Filter by School</label>', $output);
                $this->assertContains('<label for="staffusi">
														StaffUSI Full Name
						</label>', $output);
                $this->assertContains('<label for="staffEmail">StaffUSI Email</label>', $output);
                $this->assertContains('<label for="role">Role</label>', $output);
                $this->assertContains('<label for="Password">
														Password </label>', $output);
                $this->assertContains('<div class="col-md-8 col-sm-8 txt-annotation">
                    This computer system is the property of the the Center of Education Innovation. It is for authorized
                    use only.
                    Unauthorized or improper use of this system may result in civil charges and/or criminal penalties.
                </div>', $output);

                $this->assertContains('Grand Bend ISD', $output);
                $this->assertContains('David Wilson 207285', $output);
                $this->assertContains('tarlles10@gmail.com', $output);
                $this->assertContains('System Administrator', $output);
	}
}
