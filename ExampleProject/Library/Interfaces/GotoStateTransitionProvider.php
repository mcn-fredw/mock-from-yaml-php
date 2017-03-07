<?php
namespace MockFromYaml\ExampleProject\Library\Interfaces;

/** Interface GotoStateTransitionProvider
 * Public API used by State objects to change states.
 */
interface GotoStateTransitionProvider
{
    /** Transitions to another state.
     * @param[in] $toState Identifier value of state to transition to.
     */
    public function gotState($toState);
}
