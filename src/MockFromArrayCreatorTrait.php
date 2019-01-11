<?php
namespace MockFromYaml;

/** Trait MockFromArrayCreatorTrait
 * Contains methods to create PHPUnit mock object(s) from arrays.
 *
 * @author Fred Woods
 * @version 1.0.0
 *
 * @code
 * // Example use
 *
 * class MyTest extends TestCase
 * {
 *     use \MockFromYaml\YamlTestCasesReaderTrait;
 *     use \MockFromYaml\MockFromArrayCreatorTrait;
 *
 *     public static function myProvider()
 *     {
 *         return static::readYamlTestCases(__DIR__ . '/MyTest.myProvider.yaml');
 *     }
 *
 *     / ** high level example
 *       * @dataProvider myProvider
 *       * /
 *     public function testSomeMethod_high($expected, $exception, $fixtures)
 *     {
 *         $domain = [ 'someIntitalValueKey' => 'someIntitalValue' ];
 *         $this->createMockFixtures($fixtures, $domain);
 *         if (0 > strlen($exception)) {
 *             $this->expectException($exception);
 *         }
 *         $obj = new ClassUnderTest($domain[injected-mock-dependency]);
 *         $this->assertEquals($expected, $obj->someMethod($domain[mocked-param]));
 *     }
 *
 *     / ** mid level example
 *       * @dataProvider myProvider
 *       * /
 *     public function testSomeMethod_mid($expected, $exception, $fixtures)
 *     {
 *         $domain = [ 'someIntitalValueKey' => 'someIntitalValue' ];
 *         $this->createMockFixture('injected-mock-dependency', 'StdClass', $fixtures[0]['fixture'], $domain);
 *         $this->createMockFixture('mocked-param', 'StdClass', $fixtures[1]['fixture'], $domain);
 *         if (0 > strlen($exception)) {
 *             $this->expectException($exception);
 *         }
 *         $obj = new ClassUnderTest($domain[injected-mock-dependency]);
 *         $this->assertEquals($expected, $obj->someMethod($domain[mocked-param]));
 *     }
 *
 *     / ** low level example
 *       * @dataProvider myProvider
 *       * /
 *     public function testSomeMethod_log($expected, $exception, $fixtures)
 *     {
 *         $domain = [ 'someIntitalValueKey' => 'someIntitalValue' ];
 *         $injected = $this->createMockObjectFromArray('StdClass', $fixtures[0]['fixture'], $domain);
 *         $param = $this->createMockObjectFromArray('StdClass', $fixtures[0]['fixture'], $domain);
 *         if (0 > strlen($exception)) {
 *             $this->expectException($exception);
 *         }
 *         $obj = new ClassUnderTest($injected);
 *         $this->assertEquals($expected, $obj->someMethod($param));
 *     }
 * }
 * @endcode
 */
trait MockFromArrayCreatorTrait
{
    /** Calls a mock builder method.
     * @param[in] $methodSpec Array with method name as first element,
     * and method parameters as the remaining elements.
     * @param[in] &$domain Array of name value pairs for $name resolution.
     * @return method return value.
     */
    protected function callMockBuilderMethod($methodSpec, array &$domain = [])
    {
        $result = [];
        while (count($methodSpec) > 0) {
            $method = array_shift($methodSpec);
            if (is_array($method)) {
                /* with: [[equalTo, x], [equalTo, y], ...]
                 */
                $result[] = $this->callMockBuilderMethod($method, $domain);
            } else {
                if (0 == count($methodSpec)) {
                    /* expects: [once]
                     * expects: [never]
                     * expects: [any]
                     */
                    return call_user_func([$this, $method]);
                }
                if (1 == count($methodSpec)) {
                    /* with: [equalTo, x]
                     * with: [equalTo, [x, y, z]]
                     * with: [equalTo, ['a' => x, 'b' => y, 'c' => z]]
                     * will: [returnValue, x]
                     * will: [returnValue, [x, y, z]]
                     * will: [returnValue, ['a' => x, 'b' => y, 'c' => z]]
                     */
                    $arg = array_shift($methodSpec);
                    $arg = $this->resolveMockBuilderArgument($arg, $domain);
                    return call_user_func([$this, $method], $arg);
                }
                /* 1 < count($methodSpec)
                 * will: [onConsecutiveCalls, a, b, c]
                 * will: [callback, a, b, c]
                 */
                $args = $this->resolveMockBuilderArgument($methodSpec, $domain);
                return call_user_func_array([$this, $method], $args);
            }
        }
        return $result;
    }

    /** Creates a mock object based on a data array.
     * @param[in] $thingName String name of think to mock.
     * @param[in] $mockParams Array of mock object parameters.
     * @code
     * method-to-mock-name => [
     *    'expects' => [expects-function-name, expects-function parameters],
     *    'with' => [with-function-name, with-function parameters],
     *    'will' => [will-function-name, will-function parameters],
     * ]
     * typical expects element: ['never'] | ['once'] | ['any'].
     * typical optional with element: ['equalTo', value].
     * typical optional will element: ['returnValue', value].
     * @endcode
     * @param[in] &$domain Array of name value pairs for $name resolution.
     * @return mock object or null for no paramters.
     */
    protected function createMockObjectFromArray($thingName, $mockParams, array &$domain = [])
    {
        if (
            ! is_array($mockParams)
            || count($mockParams) < 1
            || (count($mockParams) == 1
                && isset($mockParams[0])
                && is_null($mockParams[0]))
        ) {
            /* nothing to mock */
            return null;
        }
        $mockObject = null;
        if (method_exists($this, 'createMock')) {
            $mockObject = $this->createMock($thingName);
        } else {
            $mockObject = $this->getMock($thingName);
        }
        /* ref for returning self */
        $domain['this'] = $mockObject;
        foreach ($mockParams as $method => $params) {
            $key = 'expects';
            $arg = $this->callMockBuilderMethod($params[$key], $domain);
            $mock = $mockObject->expects($arg)->method($method);
            foreach (['with', 'will', 'withConsecutive'] as $key) {
                if (array_key_exists($key, $params)) {
                    /* spec has called with expectation(s)/return value(s) */
                    $arg = $this->callMockBuilderMethod($params[$key], $domain);
                    if (is_array($arg)) {
                        $mock = call_user_func_array([$mock, $key], $arg);
                    } else {
                        $mock = call_user_func([$mock, $key], $arg);
                    }
                }
            }
        }
        unset($domain['this']);
        return $mockObject;
    }

    /** Creates a mock fixture object.
     * @param[in] $domainKey Name of domain key to store mock object. 
     * @param[in] $thingName Name of thing to mock.
     * @param[in] $params Method mocking array.
     * @param[in,out] &$domain Mock data domain.
     */
    protected function createMockFixture($domainKey, $thingName, $params, &$domain)
    {
        $domain[$domainKey] = $this->createMockObjectFromArray($thingName, $params, $domain);
    }

    /** Creates mock fixture objects from array.
     * @param[in] $params Array of mock fixtures.
     * @code
     * element [
     *     'domain' => domain array key to store mock object.
     *     'class' => full class/interface name to mock.
     *     'fixture' => mock specification array.
     * ]
     * @endcode
     * @param[in,out] &$domain Mock data domain.
     * @return void, Mock objects are returned in $domain array.
     */
    protected function createMockFixtures($params, &$domain)
    {
        foreach ($params as $desc) {
            $this->createMockFixture($desc['domain'], $desc['class'], $desc['fixture'], $domain);
        }
    }

    /** Resolve a mock builder method reference argument.
     * @param[in] $arg Mixed mock builder method argument,
     * @code
     * can be array of args: ['$domainVar', true]
     * can be array of array args: returnValueMap: [[true, '$domainVar'], [false, '$domainVar']]
     * can be function call: ['microtime()']
     * can be function call with args: ['json_decode()', ['$json', true]]
     * function calls must resolve to methods of $this.
     * @endcode
     * @param[in] &$domain Array of name value pairs for $name resolution.
     * @return Resolved argument.
     */
    protected function resolveMockBuilderArgument($arg, array &$domain = [])
    {
        if (! is_array($arg)) {
            /* check for domain reference */
            if (is_object($arg)) {
                /* arg can't be a domain reference */
                return $arg;
            }
            if (2 > strlen($arg)) {
                /* arg can't be a domain reference */
                return $arg;
            }
            if ('$' !== $arg[0]) {
                /* no var to resolve */
                return $arg;
            }
            $key = substr($arg, 1);
            if (! array_key_exists($key, $domain)) {
                /* var does not exist in domain, treat $ as literal */
                return $arg;
            }
            /* return domain value for reference */
            return $domain[$key];
        }
        /* arg is an array */
        $resolved = [];
        foreach ($arg as $key => $element) {
            $resolved[$key] = $this->resolveMockBuilderArgument($element, $domain);
        }
        if (
            0 < count($resolved)
            && array_key_exists(0, $resolved)
            && is_string($resolved[0])
            && strlen($resolved[0]) > 2
            && '()' == substr($resolved[0], -2)
        ) {
            /* $resolved[0] is a function call
             * $resolved[1] may be an array of arguments
             */
            $fn = array_shift($resolved);
            $fn = substr($fn, 0, -2);
            if (0 < count($resolved)) {
                $args = array_shift($resolved);
                return call_user_func_array([$this, $fn], $args);
            }
            return call_user_func([$this, $fn]);
        }
        /* no function call work, return array with resolved values */
        return $resolved;
    }
}
