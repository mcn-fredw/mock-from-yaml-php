<?php
namespace MockFromYaml\ExampleProject\Library\Traits;

use MockFromYaml\ExampleProject\Library\Interfaces\DecoratedClassConfigElement;

/** Trait FactoryConfig
 * Default implementation of the FactoryConfig interface.
 */
trait FactoryConfig
{
    /** Stores configuration list. */
    protected $classConfigListV = [];

    /** @copydoc MockFromYaml\ExampleProject\Library\Interfaces\FactoryConfig::addConfig()
     */
    public function addConfig(DecoratedClassConfigElement $configElement)
    {
        $this->configListV[$configElement->getTypeName()] = $configElement;
        return $this;
    }

    /** @copydoc MockFromYaml\ExampleProject\Library\Interfaces\FactoryConfig::configElements()
     */
    public function configElements()
    {
        return $this->configListV;
    }

    /** @copydoc MockFromYaml\ExampleProject\Library\Interfaces\FactoryConfig::getConfig()
     */
    public function getConfig($typeName)
    {
        if (!isset($this->configListV[$typeName])) {
            throw new \OutOfRangeException("$typeName is unknown");
        }
        return $this->configListV[$typeName];
    }
}
