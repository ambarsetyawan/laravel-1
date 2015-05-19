<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('sign in');
$I->amOnPage('user/login');
$I->dontSeeAuthentication();
$I->amLoggedAs(['email' => 'admin@gmail.com', 'password' => 'adminn']);
$I->seeAuthentication();
