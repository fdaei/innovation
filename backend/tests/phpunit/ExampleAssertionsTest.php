<?php
class  ExampleAssertionsTest extends  \PHPUnit\Framework\TestCase
{
    public function testNegativeForassertTrue()

    {
        $assertvalue = true;
        $this->assertTrue(
            $assertvalue,
            "assert value is true or not"
        );

    }
}