<?php 

$I = new FunctionalTester($scenario);
$I->wantTo('See the reports index page');
$I->setHeader('X-Test-User', '207220');

$I->amOnPage('/reports/index');
$I->see('Flex Reports');

