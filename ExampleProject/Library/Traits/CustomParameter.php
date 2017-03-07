<?php
namespace MockFromYaml\ExampleProject\Library\Traits;

/** Trail CustomParameter
 * Default implementation of the CustomParameter interface.
 */
trait CustomParameter
{
    /** Custom parameter storage. */
    protected $customParameterV = null;

    /** @copydoc MockFromYaml\ExampleProject\Library\Interfaces\CustomParameter::getCustomParameter()
     */
    public function getCustomParameter()
    {
        return $this->customParameterV;
    }

    /** @copydoc MockFromYaml\ExampleProject\Library\Interfaces\CustomParameter::setCustomParameter()
     */
    public function setCustomParameter($custom)
    {
        $this->customParameterV = $custom;
        return $this;
    }
}
