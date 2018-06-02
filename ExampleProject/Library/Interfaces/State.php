<?php
namespace MockFromYaml\ExampleProject\Library\Interfaces;

/** Interface State
 * Base API for state pattern objects
 * that handle a state machine state.
 */
interface State
{
    /** Method called by context when this state is being entered.
     * @param[in] &$prevState Reference to previous object state.
     * @return Generally ignored.
     */
    public function enterState(State &$prevState = null);

    /** Method called by context to take action within state.
     * @return Generally ignored.
     */
    public function handleState();

    /** Method called by context to notify object state is no longer active.
     * @return Generally ignored.
     */
    public function leaveState();
}
