<?php


class ExampleTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

   
    public function test_index()
    {
        $output = $this->request('GET', 'management/user/index');

      //  $crawler = new Crawler($output);

        $this->assertContains('<h1 class="page-header">User Management</h1>', $output);
        $this->assertContains("207220", $output);

    }
}