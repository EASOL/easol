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
                     'StaffUSI'=>'207285',
                     'RoleId'=>'1',
                     'Password'=>'123456'
                ]
           ];

           $this->request('POST', 'management/user/save', $post);
           $this->assertRedirect('management/user/', 302);
	}
        
     /**
      * @group user
      * @group user-crud
      * Tests the actual edit process
      */
     public function test_edit_post()
	{
            $output = $this->request('GET', 'management/user/save/207285');
            $crawler = new Crawler($output);
            
            $id = $crawler->filter("input[name*='user[StaffUSI]']")->attr('value');
            $this->assertContains('207285', $id);
            
            $post = [
                'user'=>[
                     'StaffUSI'=>$id,
                     'RoleId'=>'2',
                     'Password'=>'123456'
                ]
            ];
            
            $this->request('POST', 'management/user/save', $post);
            $this->assertRedirect('management/user/', 302);
	}
        
     /**
      * @group user
      * @group user-crud
      * Tests the actual delete process
      */
     public function test_delete_post()
	{
            $this->request('GET', 'management/user/delete/207285');
            $this->assertRedirect('management/user/', 302);
	}
}
