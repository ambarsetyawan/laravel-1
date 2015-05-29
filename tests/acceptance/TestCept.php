<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('sign in');
$I->amOnPage('user/login');
$I->fillField('email', 'admin@gmail.com');
$I->fillField('password', 'adminn');
$I->click('Login', '.btn-primary');
$I->amOnPage('/');
$I->see('admin');
$I->seeInDatabase('users', ['email' => 'admin@gmail.com']);
$I->amOnPage('user/profile');
$I->see('Birthday');
$I->click('Create a new post');
$I->see('Title');
$I->seeInCurrentUrl('post/create');
$I->click('Create a new post', '.btn-primary');
$I->see('The title field is required.');
$I->see('The content field is required.');