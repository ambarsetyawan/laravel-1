<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('register a user');

$I->amOnPage('user/register');
$I->fillField('name', 'John Doe');
$I->fillField('email', 'example@example.com');
$I->fillField('password', 'password');
$I->fillField('password_confirmation', 'password');
$I->click('button[type=submit]');
$I->amOnPage('user/register');
$I->seeRecord('users', ['email' => 'example@example.com']);
$I->dontSeeAuthentication();
