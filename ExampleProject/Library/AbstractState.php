<?php
namespace MockFromYaml\ExampleProject\Library;

/** class AbstractState
 * Base do nothing state.
 */
abstract class AbstractState implements Interfaces\State
{
    /** Method called when this state is being entered.
     * @param[in] $prevState Reference to previous object state.
     * @return Nothing.
     */
    public function enterState(Interfaces\State &$prevState = null)
    {
    }

    /** Method called to notify object state is no longer active.
     * @return Nothing.
     */
    public function leaveState()
    {
    }
}