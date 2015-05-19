<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('sign in');
$I->amOnPage('user/login');
$I->fillField('email', 'admin@gmail.com');
$I->fillField('password', 'adminn');
$I->click('button[type=submit]');
$I->amOnPage('user/profile');
$I->see('Hello! admin');

// $I->wantTo('register a user');
// $I->amOnPage('/user/register');
// $I->fillField('name', 'John Doe');
// $I->fillField('email', 'example@example.com');
// $I->fillField('password', 'password');
// $I->fillField('password_confirmation', 'passwords');
// $I->click('button[type=submit]');
// $I->see('The password confirmation does not match.');
// $I->amOnPage('/');
// $I->seeRecord('users', ['email' => 'example@example.com']);
?>
