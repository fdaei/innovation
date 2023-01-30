<?php
namespace backend\tests;

use api\tests\ApiTester;
use common\models\UserVerify;

class LoginTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\FunctionalTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {

    }
    public function createUserViaAPI(ApiTester $I)
    {
        $I->amHttpAuthenticated('service_user', '123456');
        $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $I->sendPost('/users', [
            'name' => 'davert',
            'email' => 'davert@codeception.com'
        ]);
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseContains('{"result":"ok"}');

    }
}