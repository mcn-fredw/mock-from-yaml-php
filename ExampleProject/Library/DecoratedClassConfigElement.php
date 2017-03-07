<?php
namespace MockFromYaml\ExampleProject\Library;

/** Class DecoratedClassConfigElement
 * Implementation of the DecoratedClassConfigElement interface.
 */
class DecoratedClassConfigElement extends ClassConfigElement implements Interfaces\DecoratedClassConfigElement
{
    use Traits\DecoratorConfig;
}
