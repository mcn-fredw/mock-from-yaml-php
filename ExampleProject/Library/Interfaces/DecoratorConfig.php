<?php
namespace MockFromYaml\ExampleProject\Library\Interfaces;

/** Interface DecoratorConfig
 * API for object that holds decorator configurations for factories.
 */
interface DecoratorConfig
{
    /** Adds a decorator config element.
     * @param[in] $configElement Element used to instantiate a decorator.
     * @return Instance of implementing object.
     */
    public function addDecoratorConfig(ClassConfigElement $configElement);

    /** Gets iteration of decorator config elements.
     * @return iteration of decorator config elements.
     * Implementations may return an array
     * or something that implements Iterator.
     */
    public function decoratorConfigElements();

    /**Gets decorator configuration for type name.
     * @param[in] $typeName Configured type name name string.
     * @return DecoratedClassConfigElement for type name.
     * @throws OutOfRangeException if $typeName is unknown.
     */
    public function getDecoratorConfig($typeName);
}
