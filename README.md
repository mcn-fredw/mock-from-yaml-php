
# MockForYaml

PHP traits to mock objects from arrays and read the data provider arrays from yaml files.

## Installation

composer install (WIP)

Depends on:

phpunit/phpunit
symfony/yaml

## Usage

Using YAML files for simple test case data (don't really need this lib for that):
```
namespace Tests\libs\MyClassTest_NS;

use PHPUnit_Framework_TestCase as TestCase;
use MockFromYaml\YamlTestCasesReaderTrait;

class MyClassTest extends TestCase
{
    use YamlTestCasesReaderTrait;

    public function someMethodProvider()
    {
        return static::readYamlTestCases(__DIR__ . '/MyClassTest.someMethodProvider.yml');
    }

    /**
     * @dataProvider someMethodProvider
     */
    public function testSomeMethod($exception, $in, $expect)
    {
        if (0 > strlen($exception)) {
            $this->expectException($exception);
        }
        $obj = new MyClass();
        $this->assertEquals($expect, $obj->someMethod($in));
    }
}
```
\_\_DIR\_\_ . '/MyClassTest.someMethodProvider.yml'
```
test case 1:
    exception: null
    in: 0
    expect: false
test case 2:
    exception: null
    in: 1
    expect: true
    
```
Using YAML files for object mocking (high level usage):
```
namespace Tests\libs\MyClassTest_NS;

use PHPUnit_Framework_TestCase as TestCase;
use MockFromYaml\MockFromArrayCreatorTrait;
use MockFromYaml\YamlTestCasesReaderTrait;

class MyClassTest extends TestCase
{
    use YamlTestCasesReaderTrait;

    public function someMethodProvider()
    {
        return static::readYamlTestCases(__DIR__ . '/MyClassTest.someMethodProvider.yml');
    }

    /**
     * @dataProvider someMethodProvider
     */
    public function testSomeMethod($exception, $expect, $fixtures)
    {
         $domain = [ 'someIntitalValueKey' => 'someIntitalValue' ];
         $this->createMockFixtures($fixtures, $domain);
         if (0 > strlen($exception)) {
             $this->expectException($exception);
         }
        $obj = new MyClass($domain['serviceConnector']);
        $this->assertEquals($expected, $obj->someMethod($domain['authBridge']));
    }
}
```
\_\_DIR\_\_ . '/MyClassTest.someMethodProvider.yml'
```
test case 1:
    exception: null
    expect: false
    fixtures:
        # service provider mock-up
        - class: 'Project\libs\ServiceProvider'
          domain: 'serviceProvider'
          fixture:
            authenticate:
                expects: [once]
                with: [[equalTo, 'user'], [equalTo, 'token']]
                will: [returnValue, false]
        # injected -mock-dependency
        - class: 'Project\libs\ServiceConnector'
          domain: 'serviceConnector'
          fixture:
            connect:
                expects: [once]
                with: [equalTo, 'http://my.local']
                # reference service provider mock-up
                will: [returnValue, '$serviceProvider']
        # auth bridge
        - class: 'Project\libs\AuthBridge'
          domain: 'authBridge'
          fixture:
            getEntity:
                expects: [once]
                will: [returnValue, 'user']
            getToken:
                expects: [once]
                will: [returnValue, 'token']
```
## Contributing

1. Fork it!
2. Create your feature branch: `git checkout -b my-new-feature`
3. Commit your changes: `git commit -am 'Add some feature'`
4. Push to the branch: `git push origin my-new-feature`
5. Submit a pull request :D

## History

Initial version 1.0.0

## License

BSD 3-Clause License
