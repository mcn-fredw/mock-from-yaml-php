<?php
namespace MockFromYaml\ExampleProject\Model\Entity\Interfaces;

/** Interface Place
 * API for a place.
 */
interface Place
{
    /** Location accessor.
     * @param $value If a value is passed, the method acts like a setter.
     * If value is omitted, method acts as a getter.
     * @return Location value as a getter, $this as a setter.
     */
    public function location();

}
