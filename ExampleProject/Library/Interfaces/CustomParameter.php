<?php
namespace MockFromYaml\ExampleProject\Library\Interfaces;

/** Interface CustomParameter
 * API for something that holds a custom parameter.
 */
interface CustomParameter
{
    /** Gets custom parameter thing.
     * @return Whatever was passed to setCustomParameter().
     * null is the default value.
     */
    public function getCustomParameter();

    /** Sets value custom parameter value.
     * @param[in] $custom Thing to stash custom parameter information.
     * @return Instance of implementing object.
     */
    public function setCustomParameter($custom);
}
