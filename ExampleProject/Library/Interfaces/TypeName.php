<?php
namespace MockFromYaml\ExampleProject\Library\Interfaces;

/** Interface TypeName
 * API for something that holds a type name.
 */
interface TypeName
{
    /** Gets type name.
     * @return Type name String.
     */
    public function getTypeName();

    /** Sets value for getTypeName().
     * @param[in] $typeName Type name string.
     * @return Instance of implementing object.
     */
    public function setTypeName($typeName);
}
