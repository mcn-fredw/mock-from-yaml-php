<?php
namespace MockFromYaml\ExampleProject\Library\Interfaces;

/** Interface CharStreamProvider
 * API for character access input stream.
 */
interface CharInputStreamProvider
{
    /** Gets next character from stream.
     * @return next character from stream as an int.
     * Returns -1 on end of stream.
     */
    public function getChar();

    /** Puts character back in stream.
     * @param[in] $ch Character to put back in the stream.
     */
    public function ungetChar($ch);
}
