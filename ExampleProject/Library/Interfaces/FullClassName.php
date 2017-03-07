<?php
namespace MockFromYaml\ExampleProject\Library\Interfaces;

/** Interface FullClassName
 * API for something that holds a full class name.
 */
interface FullClassName
{
    /** Gets full class name.
     * @return Full class name String.
     */
    public function getFullClassName();

    /** Sets value full class name string.
     * @param[in] $className Full class name string.
     * @return Instance of implementing object.
     */
    public function setFullClassName($className);
}
