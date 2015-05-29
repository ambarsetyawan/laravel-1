<?php
use \FunctionalTester;
use App\User;
class AuthCest
{
    private $user;
    private $userAttributes;
    public function _before(FunctionalTester $I)
    {
        $this->user = new User;
        $this->userAttributes= [
            'email' =>  'user@gmail.com',
            'password' => 'adminn'
        ];
    }
    public function _after(FunctionalTester $I)
    {
        // $this->user->delete();
        
    }

    // tests login system
    public function loginSystem(FunctionalTester $I)
    {
        $I->amOnPage('user/login');
        $I->dontSeeAuthentication();
        $I->amLoggedAs($this->userAttributes);
        $I->seeAuthentication();
        $I->logout();
        $I->dontSeeAuthentication();
    }
    // tests register facebook
    public function resgisterSystem(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->dontSeeAuthentication();
        $I->click('Login');
        $I->seeInCurrentUrl('user/login');
        $I->click('Login');
        $I->dontSeeAuthentication();
        // $this->fillFormFields($fields);
        // $I->click('Submit');
    }
}