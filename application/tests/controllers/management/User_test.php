<?php

class User_test extends TestCase
{
	public function test_index()
	{
		$output = $this->request('GET', 'management/user/index');

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
                
                $users = Model\Easol\StaffAuthentication::all();
                $data['user'] = $user = Model\Easol\StaffAuthentication::find(207285);
                $data['post']['school'] = $user->Staff()->EducationOrganization()[0]->EducationOrganizationId;
                $data['post']['user'] = $user->record->get('data');
                
                $post = Array(
                        ['user'] => Array(
                            ['RoleId'] => 1,
                            ['Password'] => '',
                            ['GoogleAuth'] => 1,
                            ['StaffUSI'] => 207285
                        )
                    );
                $data['post'] = $post;
                $this->request('PUT', 'management/user/save', $data);
                if (isset($user)) {
                    foreach ($post['user'] as $field=>$value) {
                        $user->$field = $value;
                    }
                    $this->assertEquals(true, $user->save());
                }
                else $this->assertEquals(true, Model\Easol\StaffAuthentication::make($post['user'])->save());

                //$this->request('GET', ['management', 'user']);
                //$this->assertRedirect('management/user', 302);
                
                //$this->assertRedirect('management/user', 302);
                //$mock = $this->getMock('User', array('save'));
                //$mock->method('save')->will($this->returnValue(NULL));
                //echo '<pre>'; print_r($data); echo '</pre>'; die();
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
        
	public function setUp() {
		//system("sqlcmd -S REGIS-PC\SQLEXPRESS -i ".APPPATH."tests/database.sql");
	}


}
