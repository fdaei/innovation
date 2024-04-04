<?php


namespace backend\tests\unit;

use backend\tests\UnitTester;
use common\models\City;
use common\models\LoginForm;
use common\models\Province;
use common\models\User;
use common\models\UserVerify;

class ExampleTest extends \Codeception\Test\Unit
{
    protected UnitTester $tester;
    public function testValidationUserVerify()
    {
        $user = new UserVerify();
        #test greater than 11
        $user->setName("0990956599518");
        $this->assertFalse($user->validate(['phone']));
        #test smaller than 11
        $user->setName("099095");
        $this->assertFalse($user->validate(['phone']));
        #test null
        $user->setName("");
        $this->assertFalse($user->validate(['phone']));
        #test pattern
        $user->setName("12345678945");
        $this->assertFalse($user->validate(['phone']));
        #test must number
        $user->setName("123456789u5");
        $this->assertFalse($user->validate(['phone']));
        #test true
        $user->setName("09390315707");
        $this->assertTrue($user->validate(['phone']));
    }

    public function testValidationLoginForm()
    {
        $user = new LoginForm(['scenario' => LoginForm::SCENARIO_LOGIN_CODE_API]);
        #test greater than 11
        $user->setNumber("0990956599518");
        $this->assertFalse($user->validate(['number']));
        #test smaller than 11
        $user->setNumber("099095");
        $this->assertFalse($user->validate(['number']));
        #test null
        $user->setNumber("");
        $this->assertFalse($user->validate(['number']));
        #test pattern
        $user->setNumber("12345678945");
        $this->assertFalse($user->validate(['number']));
        #test true
        $user->setNumber("09390315707");
        $this->assertTrue($user->validate(['number']));
    }
    public function testValidationLoginFormPassword()
    {
        $user = new LoginForm(['scenario' => LoginForm::SCENARIO_BY_PASSWORD_API]);
        #test greater than 11
        $user->setPassword("23444443335");
        $this->assertFalse($user->validate(['number']));
    }
    function testSavingUser()
    {
        $user = new UserVerify();
        $user->setName('09370315709');
        $user->save();
        $this->assertEquals('09370315709', $user->getName());
    }
    function testSavingProvince()
    {
        $user= new Province();
        $user->setName("kerman");
        $user->setStatus(1);
        $user->setCreated_at(time());
        $user->setUpdated_at(time());
        $user->setDeleted_at (0);
        $user->setCreated_by(1);
        $user->setUpdated_by(1);
        $user->save();
        $this->tester->seeInDatabase('users', ['name' => 'Miles', 'surname' => 'Davis']);
    }
}
