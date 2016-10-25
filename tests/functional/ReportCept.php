<?php 

$I = new FunctionalTester($scenario);
$I->wantTo('See the reports index page');
$I->setHeader('X-Test-User', 'edgar.f91@gmail.com');
$I->setHeader('X-School', '255901044');

$I->amOnPage('/reports/index');
$I->see('Flex Reports');

