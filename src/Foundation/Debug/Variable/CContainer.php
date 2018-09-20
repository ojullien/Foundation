<?php
namespace Foundation\Debug\Variable;

/**
 * Foundation Framework
 *
 * @package   Debug
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if (! defined('APPLICATION_VERSION')) {
    die('-1');
}

/**
 * This class implements usefull methods for superglobal variable monitoring.
 *
 * @category   Foundation
 * @package    Debug
 * @subpackage Variable
 * @version    1.0.0
 * @since      1.0.0
 * @codeCoverageIgnore
 */
final class CContainer
{
    /** Class management
     * ***************** */

    /**
     * Constructor.
     *
     * @param mixed $variable An array or an instance of ArrayObject.
     */
    public function __construct($variable)
    {
        if ($variable instanceof \ArrayObject) {
            $this->_aVariable = $variable->getArrayCopy();
        } elseif (is_array($variable)) {
            $this->_aVariable = $variable;
        } else {
            throw new \Foundation\Exception\InvalidArgumentException('The argument must be an array or an instance of ArrayObject.');
        }
    }

    /**
     * Clone is not allowed.
     *
     * @throws \Foundation\Exception\BadMethodCallException
     */
    public function __clone()
    {
        throw new \Foundation\Exception\BadMethodCallException('Cloning is not allowed.');
    }

    /**
     * Writing data to inaccessible properties is not allowed.
     *
     * @param string $name
     * @param mixed $value
     * @throws \Foundation\Exception\BadMethodCallException
     */
    public function __set($name, $value)
    {
        throw new \Foundation\Exception\BadMethodCallException('Writing data to inaccessible properties is not allowed.');
    }

    /**
     * Reading data from inaccessible properties is not allowed.
     *
     * @param string $name
     * @codeCoverageIgnore
     */
    public function __get($name)
    {
        throw new \Foundation\Exception\BadMethodCallException('Reading data from inaccessible properties is not allowed.');
    }

    /** Variable management
     * ******************** */

    const KEY_IDENTICAL = 1;
    const KEY_UPDATED   = 2;
    const KEY_DELETED   = 4;
    const KEY_ADDED     = 8;
    const VALUE_ARRAYS  = 16;
    const VALUE_OTHERS  = 32;

    /**
     * Superglobal content
     * @var array
     */
    private $_aVariable;

    /**
     * Compare two arrays and returns an array containing all the diffrencies.
     * [$key] = array( 'status' => KEY_IDENTICAL | KEY_UPDATED | KEY_DELETED | KEY_ADDED
     *                 'values' => array ( 'type' => VALUE_ARRAYS | VALUE_OTHERS,
     *                                    'start' => ...,
     *                                      'end' => ... ) );
     *
     * @param  array $haystack The array with master keys to check.
     * @param  array $needle   An array to compare against.
     * @return array
     */
    private function compareTwoArrays(array $haystack, array $needle)
    {
        $aDiff    = [ ];
        $aDiff[0] = self::KEY_IDENTICAL;

        // Old one
        foreach ($haystack as $key => $value) {
            // Key
            ////////////////////////////////////////////////////////////////////
            $aDiff[$key] = [ 'status' => false,
                'values' => [ 'type'  => self::VALUE_OTHERS,
                    'start' => $value,
                    'end'   => null ] ];

            // Values
            ////////////////////////////////////////////////////////////////////
            $pDiff = &$aDiff[$key];
            if (isset($needle[$key]) || array_key_exists($key, $needle)) {
                // Key exists in both array
                if (is_array($value) && is_array($needle[$key])) {
                    // Compare arrays
                    $aSub                    = $this->compareTwoArrays($value, $needle[$key]);
                    $pDiff['status']         = $aDiff[0]                = $aSub[0];
                    $pDiff['values']['type'] = self::VALUE_ARRAYS;
                    $pDiff['values']['end']  = $aSub;
                } else {
                    $pDiff['values']['end'] = $needle[$key];
                    // Compare values
                    if ($value != $needle[$key]) {
                        // Not equals
                        $pDiff['status'] = self::KEY_UPDATED;
                        $aDiff[0]        = self::KEY_UPDATED;
                    } else {
                        // Equals
                        $pDiff['status'] = self::KEY_IDENTICAL;
                    }//if(...
                }//if( is_array(...
            } else {
                // Key does not exist in the needle array
                $pDiff['status'] = self::KEY_DELETED;
                $aDiff[0]        = self::KEY_UPDATED;
            }//if( isset(...
        }//foreach(...
        // New key
        foreach ($needle as $key => $value) {
            if (! isset($haystack[$key]) && ! array_key_exists($key, $haystack)) {
                $aDiff[$key] = [ 'status' => self::KEY_ADDED,
                    'values' => [ 'type'  => self::VALUE_OTHERS,
                        'start' => null,
                        'end'   => $value ] ];
                $aDiff[0]    = self::KEY_UPDATED;
            }//if( !isset(...
        }//foreach(...

        return $aDiff;
    }

    /**
     * Returns an array containing all the differencies.
     * [$key] = array( 'status' => KEY_IDENTICAL | KEY_UPDATED | KEY_DELETED | KEY_ADDED
     *                 'values' => array ( 'type' => VALUE_ARRAYS | VALUE_OTHERS,
     *                                    'start' => ...,
     *                                      'end' => ... ) );
     *
     * @param  mixed $needle An array (or an instance of Arrayobject) to compare against.
     * @return array
     */
    public function compare($needle)
    {
        if ($needle instanceof \ArrayObject) {
            $needle = $needle->getArrayCopy();
        }
        if (! is_array($needle)) {
            throw new \Foundation\Exception\InvalidArgumentException('The argument must be an array or an instance of ArrayObject.');
        }
        return $this->compareTwoArrays($this->_aVariable, $needle);
    }
}
