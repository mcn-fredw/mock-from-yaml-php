<?php
namespace MockFromYaml\ExampleProject\Model\Entity\Traits;

/** Trait GenericAccessor
 * Generic getter/setter implementation for entity attributes. 
 */
trait GenericAccessor
{
    /** Attribute storage. */
    protected $attributesV = [];

    /** set/set accessor for entity attribute.
     * @param[in] $key Attribute name key.
     * @param[in] $value Array of argument parameters.
     * If args are omitted, metod acts as a getter.
     * If args are present, method acts as a setter
     * and the first value in $args is used.
     * @return Get accessor returns the attribute value
     * or throws OutOfRangeException if the attribute is not set.<br/>
     * Set accessor returns instance of using class.
     */
    protected function genericAccessor($key, $value)
    {
        if (0 < count($value)) {
            $this->attributesV[$key] = array_shift($value);
            return $this;
        }
        if (! array_key_exists($key, $this->attributesV)) {
            throw new \OutOfRangeException("$key not set for " . __CLASS__);
        }
        return $this->attributesV[$key];
    }
}
