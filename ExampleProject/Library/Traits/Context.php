<?php
namespace MockFromYaml\ExampleProject\Library\Interfaces;

use MockFromYaml\ExampleProject\Library\Interfaces\State;

/** Trait Context
 * Default implementation of the Context interface.
 */
trait Context
{
    /** Current state. */
    protected $currentStateV = null;

    /** @copydoc MockFromYaml\ExampleProject\Library\Interfaces\Context::changeAndNotifyStates()
     */
    public function changeAndNotifyStates(State $newState = null)
    {
        $prev = $this->currentStateV;
        if( ! is_null($this->currentStateV) )
        {
            $this->currentStateV->leaveState();
        }
        $this->currentStateV = $newState;
        if( ! is_null($this->currentStateV) )
        {
            $this->currentStateV->enterState($prev);
        }
    }
}
