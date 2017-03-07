<?php
namespace MockFromYaml\ExampleProject\Library\Traits;

use MockFromYaml\ExampleProject\Library\Interfaces\ClassConfigElement;
/** Trait DecoratorConfig
 * Default implementation of the DecoratorConfig interface.
 */
trait DecoratorConfig
{
    /** Store decorator class configs. */
    protected $decoratorConfigElementsV = [];

    /** @copydoc MockFromYaml\ExampleProject\Library\Interfaces\DecoratorConfig::addDecoratorConfig()
     */
    public function addDecoratorConfig(ClassConfigElement $configElement)
    {
        $this->decoratorConfigElementsV[$configElement->getTypeName()] = $configElement;
        return $this;
    }

    /** @copydoc MockFromYaml\ExampleProject\Library\Interfaces\DecoratorConfig::decoratorConfigElements()
     */
    public function decoratorConfigElements()
    {
        return $this->decoratorConfigElementsV;
    }

    /** @copydoc MockFromYaml\ExampleProject\Library\Interfaces\DecoratorConfig::getDecoratorConfig()
     */
    public function getDecoratorConfig($typeName)
    {
        if (!isset($this->decoratorConfigElementsV[$typeName])) {
            throw new \OutOfRangeException("$typeName is unknown");
        }
        return $this->decoratorConfigElementsV[$typeName];
    }
}
