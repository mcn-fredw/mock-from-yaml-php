<?php
namespace MockFromYaml\ExampleProject\Library\Traits;

/** Trait TypeName
 * Default implementation of the TypeName interface.
 */
trait TypeName
{
    /** Type name storage. */
    protected $typeNameV = null;

    /** @copydoc MockFromYaml\ExampleProject\Library\Interfaces\TypeName::getTypeName()
     */
    public function getTypeName()
    {
        return $this->typeNameV;
    }

    /** @copydoc MockFromYaml\ExampleProject\Library\Interfaces\TypeName::setTypeName()
     */
    public function setTypeName($typeName)
    {
        $this->typeNameV = $typeName;
        return $this;
    }
}
