<?php
use Symfony\Component\DomCrawler\Crawler;

class User_test extends TestCase
{
	public function test_index()
	{
		$output = $this->request('GET', 'management/user/index');

		$crawler = new Crawler($output);

		$this->assertContains('<h1 class="page-header">User Management</h1>', $output);
                $this->assertContains('<button class="btn btn-primary pull-right pre-data-table">Add User</button>', $output);
                $this->assertContains('CSV', $output);
                
                $this->assertContains('StaffUSI', $output);
                $this->assertContains('Full Name', $output);
                $this->assertContains('Role', $output);
                $this->assertContains('Authorization Type', $output);
                $this->assertContains('School', $output);
                $this->assertContains('Actions', $output);
                $this->assertContains('<div class="col-md-8 col-sm-8 txt-annotation">
                    This computer system is the property of the the Center of Education Innovation. It is for authorized
                    use only.
                    Unauthorized or improper use of this system may result in civil charges and/or criminal penalties.
                </div>', $output);
	}
        
        public function test_save()
	{
		$output = $this->request('GET', 'management/user/save');

                $crawler = new Crawler($output);

		$this->assertContains('<h1 class="page-header">User Management</h1>', $output);
                $this->assertContains('<label for="school">Filter by School</label>', $output);
                $this->assertContains('<label for="staffusi">
														StaffUSI Full Name
						</label>', $output);
                $this->assertContains('<label for="role">Role</label>', $output);
                $this->assertContains('<label for="Password">
														Password </label>', $output);
                $this->assertContains('<div class="col-md-8 col-sm-8 txt-annotation">
                    This computer system is the property of the the Center of Education Innovation. It is for authorized
                    use only.
                    Unauthorized or improper use of this system may result in civil charges and/or criminal penalties.
                </div>', $output);
                
                $post = ['user' => 
                    ['schoolFilter' => '255901', 
                     'staffusi' => '207285', 
                     'user[RoleId]' => '1', 
                     'user[Password]' => '123456', 
                     'user[GoogleAuth]' => '']
                    ];
                
                $output = $this->request(
                    'PUT', 'management/user/save', $post
                );
                
	}

        public function test_edit()
	{
		$output = $this->request('GET', 'management/user/save/207285');

                $crawler = new Crawler($output);

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
        
	public function setUp() {
		//system("sqlcmd -S REGIS-PC\SQLEXPRESS -i ".APPPATH."tests/database.sql");
	}


}
