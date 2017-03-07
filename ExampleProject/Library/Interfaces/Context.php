<?php
namespace MockFromYaml\ExampleProject\Library\Interfaces;

/** Interface Context
 * Base public interface for state pattern objects that handle the context role.
 */
interface Context
{
    /** Helper method to notify state objects of state change.
     * @param[in] $newState New state object. Maybe null.
     */
    public function changeAndNotifyStates(State $newState = NULL);
}
