<?php
namespace MockFromYaml\ExampleProject\Library;

/** Class ConfigurableFactory
 * Configurable factory.
 */
class ConfigurableFactory implements Interfaces\ConfigurableFactory
{
    /** Stores factory configuration. */
    protected $configV = null;

    /** Creates instance of a class.
     * @param[in] $className Full name of class to create an instance of.
     * @return instance of class.
     * @note Override for tests to return stubs.
     */
    protected function createA($className)
    {
        return new $className();
    }

    /** Decorates object with a decorator object.
     * @param[in] $obj Object to decorate.
     * @param[in] $className Full name of decorator class.
     * @return instance of decorator.
     * @note Override for tests to return stubs.
     */
    protected function decorateA($obj, $className)
    {
        return $this->create($className)->decorate($obj);
    }

    /** @copydoc MockFromYaml\ExampleProject\Library\Interfaces\ConfigurableFactory::create()
     */
    public function create($typeName)
    {
        $cConfig = $this->configV->getConfig($typeName);
        $obj = $this->createA($cConfig->getFullClassName());
        foreach ($cConfig->decoratorConfigElements() as $dConfig) {
            $obj = $this->decorateA($obj, $dConfig->getFullClassName());
        }
        if (method_exists($obj, 'initialize')) {
            /* remove type name from arg list and append class config  */
            $args = func_get_args();
            array_shift($args);
            array_push($cConfig);
            /* initialize object trough decorator chain */
            call_user_func_array([$obj, 'initialize'], $args);
        }
        return $obj;
    }

    /** @copydoc MockFromYaml\ExampleProject\Library\Interfaces\ConfigurableFactory::setConfig()
     */
    public function setConfig(Interfaces\FactoryConfig $config)
    {
        $this->configV = $config;
    }
}
