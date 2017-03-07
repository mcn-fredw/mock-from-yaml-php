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
}
