<?php
namespace MockFromYaml\ExampleProject\Library\Interfaces;

/** Interface FactoryConfig
 * API for object that holds configurations data for factories.
 */
interface FactoryConfig
{
    /** Adds a class configuration element.
     * @param[in] $configElement Element used to instantiate the class.
     * @return Instance of implementing object.
     */
    public function addConfig(DecoratedClassConfigElement $configElement);

    /** Gets iteration of config elements.
     * @return iteration of config elements.
     * Implementations may return an array
     * or something that implements Iterator.
     */
    public function configElements();

    /**Gets configuration for type name.
     * @param[in] $typeName Configured type name name string.
     * @return DecoratedClassConfigElement for type name.
     * @throws OutOfRangeException if $typeName is unknown.
     */
    public function getConfig($typeName);
}
