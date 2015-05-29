<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('sign in');
$I->amOnPage('user/login');
$I->fillField('email', 'admin@gmail.com');
$I->fillField('password', 'adminn');
$I->click('.btn-primary');
$I->amOnPage('/');
$I->see('admin');
$I->see('PHP');
$I->seeInDatabase('users', ['email' => 'admin@gmail.com']);
$I->seeRecord('users', ['email' => 'admin@gmail.com']);
