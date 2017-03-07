<?php
namespace MockFromYaml\ExampleProject\Library\Traits;

use MockFromYaml\ExampleProject\Library\Interfaces\State;

/** Trait GotoStateTransitionProvider
 * Default implementation of the GotoStateTransitionProvider interface.
 */
trait GotoStateTransitionProvider
{
    /** Store current state. */
    protected $stateIndexV = -1;
    /** Store state list. */
    protected $stateTableV = [];

    /** Stores a state handler $state so that it can be referenced by $index.
     * @param[in] $identifier State identifier.
     * @param[in] $state State implementation hat will handle state.
     * Null typical use case is terminate state machine.
     */
    protected function createState($identifier, State $state = null)
    {
        $this->stateTableV[$identifier] = $state;
    }

    /** @copydoc MockFromYaml\ExampleProject\Library\Interfaces\GotoStateTransitionProvider::gotState()
     */
    public function gotState($toState)
    {
        $this->stateIndexV = $toState;
        $this->changeAndNotifyStates($this->stateTableV[$toState]);
    }
}
