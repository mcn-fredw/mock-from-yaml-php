<?php
/** Isolate test classes. */
namespace MockFromYaml\Tests\Library\ConfigurableFactoryTest_NS;

use MockFromYaml\ExampleProject\Library\ConfigurableFactory;
use PHPUnit\Framework\TestCase;
use MockFromYaml\YamlTestCasesReaderTrait;
use MockFromYaml\MockFromArrayCreatorTrait;

/** Extend class under test to inject mocks.
 */
class ClassUnderTest extends ConfigurableFactory
{
    protected $mockObject = null;
    protected $mockDecorator = null;

    protected function createA($className)
    {
        if (! is_null($this->mockObject)) {
            return $this->mockObject;
        }
        return parent::createA($className);
    }

    protected function decorateA($className, $obj)
    {
        if (! is_null($this->mockDecorator)) {
            return $this->mockDecorator;
        }
        return parent::decorateA($className, $obj);
    }

    public function setMockObject($mock)
    {
        $this->mockObject = $mock;
    }

    public function setMockDecorator($mock)
    {
        $this->mockDecorator = $mock;
    }
}

/** Interface to mock object created by factory.
 */
interface MockableObjectInterface
{
    public function intialize();
}

/** Interface to mock object created by factory.
 */
class AObject implements MockableObjectInterface
{
    public function intialize()
    {
    }
}

/**
 */
class ConfigurableFactoryTest extends TestCase
{
    use YamlTestCasesReaderTrait;
    use MockFromArrayCreatorTrait;

    public function createProvider()
    {
        return static::readYamlTestCases(__DIR__ . '/ConfigurableFactoryTest.createProvider.yml');
    }

    /**
     * @dataProvider createProvider
     */
    public function testCreate($exception, $typeName, $fixtures)
    {
        $domain = [
            'config' => null,
            'object' => null,
            'decorator' => null
        ];
        $this->createMockFixtures($fixtures, $domain);
        if (0 < strlen($exception)) {
            $this->expectException($exception);
        }
        $factory = new ClassUnderTest();
        $factory->setConfig($domain['config']);
        $factory->setMockObject($domain['object']);
        $factory->setMockDecorator($domain['decorator']);
        $obj = $factory->create($typeName);
    }
}
