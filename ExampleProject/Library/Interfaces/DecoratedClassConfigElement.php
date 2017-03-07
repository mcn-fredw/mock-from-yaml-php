<?php
namespace MockFromYaml\ExampleProject\Library\Interfaces;

/** Interface DecoratedClassConfigElement
 * API for elements used by factories
 * to instantiate objects with decorators.
 */
interface DecoratedClassConfigElement extends
    ClassConfigElement, DecoratorConfig
{
}
