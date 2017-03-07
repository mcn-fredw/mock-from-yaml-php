<?php
namespace MockFromYaml\ExampleProject\Library;

/** Class ClassConfigElement
 * Implementation of the ClassConfigElement interface.
 */
class ClassConfigElement implements Interfaces\ClassConfigElement
{
    use Traits\TypeName;
    use Traits\FullClassName;
    use Traits\CustomParameter;
}
