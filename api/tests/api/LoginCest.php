<?php
namespace api\tests\api;
use Codeception\Verify;
use common\fixtures\UserFixture;
use common\fixtures\VerifyFixture;
use api\tests\ApiTester;

class LoginCest
{
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'login_data.php',
            ],
            'verifycode' => [
                'class' => VerifyFixture::class,
                'dataFile' => codecept_data_dir() .'verify_code.php',
            ],
        ];
    }
    public function login(ApiTester $I)
    {
        $I->sendPost('/v1/security/login', ['number' => '09133995518']);
        $I->seeResponseCodeIs('200');
    }
    public function loginfail(ApiTester $I)
    {
        $I->sendPost('/v1/security/login', ['number' => '09909565518']);
        $I->seeResponseCodeIs('422');
    }

    public function tryvalidatelogin(ApiTester $I)
    {
        $I->sendPost('/v1/security/login', ['number' => '09390315707']);
        $I->seeResponseCodeIs('200');
        $I->haveHttpHeader('client-id', 'testclient');
        $I->sendPost('/v1/security/validate-login', ['number' => '09390315707','code'=>'5707']);
        $I->seeResponseCodeIs('200');
    }

    public function register(ApiTester $I)
    {
        $I->sendPost('/v1/security/register', ['number' => '09390315709']);
        $I->seeResponseCodeIs('200');
    }
    public function validateregistersucess(ApiTester $I){
        $I->haveHttpHeader('client-id', 'testclient');
        $I->sendPost('/v1/security/validate-register', ['number' => '09390315708','code'=>'5708']);
        $I->seeResponseCodeIs('200');
    }
    public function validateregisterfail(ApiTester $I){
        $I->haveHttpHeader('client-id', 'testclient');
        $I->sendPost('/v1/security/validate-register', ['number' => '09390395705','code'=>'5705']);
        $I->seeResponseCodeIs('422');
    }

}
