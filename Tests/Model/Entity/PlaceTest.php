<?php
namespace MockFromYaml\Tests\Model\Entity\PlaceTest_NS;

use PHPUnit\Framework\TestCase;

use MockFromYaml\ExampleProject\Model\Entity\Place;
use MockFromYaml\YamlTestCasesReaderTrait;

class PlaceTest extends TestCase
{
    use YamlTestCasesReaderTrait;

    public function getLocationProvider()
    {
        return static::readYamlTestCases(__DIR__ . '/PlaceTest.getLocationProvider.yml');
    }

    /**
     * @dataProvider getLocationProvider
     */
    public function testLocationAccessors($exception, $name, $callSetter, $value, $callGetter, $expect)
    {
        if (0 < strlen($exception)) {
            $this->expectException($exception);
        }
        $cut = new Place();
        if ($callSetter) {
            $this->assertEquals($cut, $cut->$name($value));
        }
        if ($callGetter) {
            $this->assertEquals($expect, $cut->$name());
        }
    }
}
