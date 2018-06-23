<?php
namespace Foundation\Weather\Reader;
/**
 * Foundation Framework
 *
 * @package   Weather
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if( !defined( 'APPLICATION_VERSION' ) )
    die( '-1' );

/**
 * Interface class for weather reader objects that can have responsibilities added to them dynamically.
 *
 * @category   Foundation
 * @package    Weather
 * @subpackage Reader
 * @version    1.0.0
 * @since      1.0.0
 */
interface ReaderInterface
{

    /**
     * Reads data. Returns the readed data or FALSE on failure.
     *
     * @param  string $url Uniform Resource Locator.
     * @return mixed
     * @throws \RuntimeException If the connection does not exist.
     * @throws \Foundation\Exception\InvalidArgumentException If an option could not be successfully set.
     */
    public function read( $url );
}