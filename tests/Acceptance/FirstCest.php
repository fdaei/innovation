<?php


namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class FirstCest
{
    public function signInSuccessfully(AcceptanceTester $I)
    {
        $I->amOnPage('/site/login');
        $I->fillField('Mobile Number','09390315707');
        $I->fillField('LoginForm[password]','123456789');
        $I->click('Login');
    }

    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
    }
}
