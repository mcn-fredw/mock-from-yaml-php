<?php
namespace MockFromYaml\ExampleProject\Library\Interfaces;

/** Interface Decorator
 * API for all decorators.
 */
interface Decorator
{
    /** Decorate the object.
     * @param[in] $obj Object to decorate.
     * @return Instance of decorator.
     */
    public function decorate($obj);

    /** Initialize the decorated object (and decorator).
     * @param[in] va_args initialization parameters.
     * The last parameter is the factory configuration for the object.
     * @return Instance of decorator.
     */
    public function initialize();
}
