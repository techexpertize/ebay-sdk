<?php
require_once __DIR__ . '/../../../fixtures/SimpleClass.php';
require_once __DIR__ . '/../../../fixtures/ComplexClass.php';

class ConstructTest extends \PHPUnit_Framework_TestCase
{
    public function testSettingPropertiesViaCtor()
    {
        $obj = new ComplexClass([
            'foo' => 'foo',
            'integer' => 123,
            'strings' => ['foo', 'bar']
        ]);

        $this->assertEquals('foo', $obj->foo);
        $this->assertInternalType('string', $obj->foo);

        $this->assertEquals(123, $obj->integer);
        $this->assertInternalType('integer', $obj->integer);

        $this->assertEquals(2, count($obj->strings));
        $this->assertEquals('foo', $obj->strings[0]);
        $this->assertEquals('bar', $obj->strings[1]);
        $this->assertInstanceOf('\DTS\eBaySDK\Types\UnboundType', $obj->strings);
    }

    public function testSettingInvalidPropertyViaCtor()
    {
        $this->setExpectedException('\DTS\eBaySDK\Exceptions\UnknownPropertyException', 'Unknown property: ComplexClass::bar');

        $obj = new ComplexClass([
            'bar' => 'bar'
        ]);
    }

    public function testSettingInvalidPropertyTypeViaCtor()
    {
        $this->setExpectedException('\DTS\eBaySDK\Exceptions\InvalidPropertyTypeException', 'Invalid property type: ComplexClass::string expected <string>, got <integer>');

        $obj = new ComplexClass([
            'string' => 123
        ]);
    }
}
