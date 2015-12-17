<?php
/**
 * Part of CI PHPUnit Test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Test_test extends TestCase
{
	/**
	 * @group test
	 * Test index page
	 */
	public function test_index()
	{
		$output = $this->request('GET', ['Test', 'index']);
		$this->assertContains('Standalone Test', $output);
	}

	/**
	 * @group test
	 * Test index page
	 */
	public function test_module_index()
	{
		$output = $this->request('GET', ['Test_module', 'index']);
		$this->assertContains('module test', $output);
	}
}
