<?php
namespace MockFromYaml;

/** Trait MockFromArrayCreatorTrait
 * Contains methods to create a PHPUnit mock object from arrays.
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
interface MockFromArrayCreatorTrait
{
    /** Calls a mock builder method.
     * @param[in] $methodSpec Array with method name as first element,
     * and method parameters as the remaining elements.
     * @param[in] &$domain Array of name value pairs for $name resolution.
     * @return method return value.
     */
    protected function callMockBuilderMethod($methodSpec, array &$domain = []);

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
    protected function createMockObjectFromArray($thingName, $mockParams, array &$domain = []);

    /** Creates a mock fixture object.
     * @param[in] $domainKey Name of domain key to store mock object. 
     * @param[in] $thingName Name of thing to mock.
     * @param[in] $params Method mocking array.
     * @param[in,out] &$domain Mock data domain.
     */
    protected function createMockFixture($domainKey, $thingName, $params, &$domain);

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
    protected function createMockFixtures($params, &$domain);

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
    protected function resolveMockBuilderArgument($arg, array &$domain = []);
}
