<?php
namespace MockFromYaml\ExampleProject\Library\Interfaces;

/** Interface ConfigurableFactory
 * API for a configurable factory.
 */
interface ConfigurableFactory
{
    /** Sets factory configuration.
     * @param[in] $config FactoryConfig implementation.
     * @return Implementation instance.
     */
    public function setConfig(FactoryConfig $config);

    /** Creates and decorates object for type name.
     * @param[in] $typeName Object type name string.
     * @return Object for type name.
     * @throws OutOfRangeException if $typeName is unknown.
     */
    public function create($typeName);
}
