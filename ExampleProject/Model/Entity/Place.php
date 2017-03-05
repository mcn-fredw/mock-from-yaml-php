<?php
namespace MockFromYaml\ExampleProject\Model\Entity;

/** Class Place
 * A place entity.
 */
class Place implements Interfaces\Place
{
    use Traits\GenericAccessor;

    /** @copydoc Interfaces\Place::location()
     */
    public function location()
    {
        return $this->genericAccessor(__FUNCTION__, func_get_args());
    }
}
