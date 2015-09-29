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

		$this->request->setCallable(
            function ($CI) {
               
               //$this->CI =& get_instance();
               

				$CI->session->sess_expiration =   '1200';
				$data = [
					'LoginId'   =>      207219,
					'StaffUSI'  =>      2072019,
					'RoleId'  =>      1,
					'logged_in' => TRUE,
				];

				
				    
		
				$CI->session->set_userdata($data);


                
           }
        );

		$output = $this->request('GET', ['Reports', 'index']);
		$this->assertContains('<h1 class="page-header">Flex Reports</h1>', $output);
	}

}
