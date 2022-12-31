<?php


namespace backend\tests\unit;

use backend\tests\UnitTester;
use common\models\UserVerify;

class ExampleTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    protected function _before()
    {
    }

    // tests
    public function testSomeFeature()
    {

    }

    public function testValidation()
    {
        $user = new UserVerify();
        $user->setName("0990956599518");
        $this->assertFalse($user->validate(['phone']));
    }
}
