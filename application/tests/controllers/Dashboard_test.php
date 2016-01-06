<?php
/**
 * @group home
 * 
 */

use Symfony\Component\DomCrawler\Crawler;
class Dashboard_test extends TestCase {

	public function test_index() {
		$output = $this->request('GET', ['dashboard', 'index']);

		$crawler = new Crawler($output);
		$title = $crawler->filter('h1.page-header')->eq(0)->text();
        $this->assertContains("Flex Reports", $title);	
        
	}
}