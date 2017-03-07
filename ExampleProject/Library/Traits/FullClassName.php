<?php
namespace MockFromYaml\ExampleProject\Library\Traits;

/** Trait FullClassName
 * Default implementation of the FullClassName interface.
 */
trait FullClassName
{
    /** Full class name storage. */
    protected $fullClassNameV = null;

    /** @copydoc MockFromYaml\ExampleProject\Library\Interfaces\FullClassName::getFullClassName()
     */
    public function getFullClassName()
    {
        return $this->fullClassNameV;
    }

    /** @copydoc MockFromYaml\ExampleProject\Library\Interfaces\FullClassName::setFullClassName()
     */
    public function setFullClassName($className)
    {
        $this->fullClassNameV = $className;
        return $this;
    }
}
