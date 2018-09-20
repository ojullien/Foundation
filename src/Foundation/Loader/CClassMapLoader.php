<?php
namespace Foundation\Loader;

/**
 * Foundation Framework
 *
 * @package   Loader
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if (! defined('APPLICATION_VERSION')) {
    die('-1');
}

/**
 * This class implements a class map autoloading strategy.
 *
 * @category   Foundation
 * @package    Loader
 * @version    1.0.0
 * @since      1.0.0
 */
final class CClassMapLoader implements \Foundation\Loader\LoaderInterface
{
    /** Class section
     * ************** */

    /**
     * Constructor.
     *
     * @param null|array $options Array of options, where each option is either a filename returning a class map, or
     *                            an associative array of class name/filename pairs.
     *                            As an example: a configuration defining both a file-based class map, and an array map
     *                           $options = array( __DIR__ . '/src/autoloader_classmap.php', // file-based class map
     *                                             array( 'Aa\Bb' => __DIR__ . '/Aa/Bb.php',     // array class map
     *                                                    'Cc\Dd' => __DIR__ . '/Cc/Dd.php' ) );
     * @codeCoverageIgnore
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __construct(array $options = null)
    {
        if (null !== $options) {
            $this->setOptions($options);
        }
    }

    /**
     * Destructor
     *
     * @codeCoverageIgnore
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __destruct()
    {
        $this->_aMap        = [ ];
        $this->_aMapsLoaded = [ ];
    }

    /**
     * Writing data to inaccessible properties is not allowed.
     *
     * @param string $name
     * @param mixed $value
     * @throws \Foundation\Exception\BadMethodCallException
     * @codeCoverageIgnore
     */
    public function __set($name, $value)
    {
        throw new \Foundation\Exception\BadMethodCallException('Writing data to inaccessible properties is not allowed.');
    }

    /**
     * Reading data from inaccessible properties is not allowed.
     *
     * @param string $name
     * @throws \Foundation\Exception\BadMethodCallException
     * @codeCoverageIgnore
     */
    public function __get($name)
    {
        throw new \Foundation\Exception\BadMethodCallException('Reading data from inaccessible properties is not allowed.');
    }

    /** Loarder section
     * **************** */

    /**
     * Registry of map files that have already been loaded
     * @var array
     */
    private $_aMapsLoaded = [ ];

    /**
     * Class name/filename map
     * @var array
     */
    private $_aMap = [ ];

    /**
     * Configure the autoloader. Register an autoload map.
     *
     * @param array $options Array of options, where each option is either a filename returning a class map, or
     *                       an associative array of class name/filename pairs.
     *                           $options = array( __DIR__ . '/src/autoloader_classmap.php', // file-based class map
     *                                             array( 'Aa\Bb' => __DIR__ . '/Aa/Bb.php',     // array class map
     *                                                    'Cc\Dd' => __DIR__ . '/Cc/Dd.php' ) );
     * @throws \Foundation\Exception\InvalidArgumentException If the file does not exist.
     * @return void
     */
    public function setOptions(array $options)
    {

        foreach ($options as $option) {
            // Initialize
            $sLocation = false;

            // Load the map from a file
            if (is_string($option)) {
                // Check if the file exists and gets the absolute class name.
                $sLocation = realpath($option);

                // The file does not exist
                if (false === $sLocation) {
                    throw new \Foundation\Exception\InvalidArgumentException(sprintf('Map file provided does not exist: %s', $sLocation));
                }

                // Already loaded this map
                if (in_array($sLocation, $this->_aMapsLoaded)) {
                    continue;
                }

                // Load the map
                $option = include($sLocation);
            }

            // Option should be an array
            if (! is_array($option)) {
                throw new \Foundation\Exception\InvalidArgumentException(sprintf('The option provided is not a map: %s', gettype($option)));
            }

            // Merge the map
            $this->_aMap = array_merge($this->_aMap, $option);

            // Save the loaded file name
            if (false !== $sLocation) {
                $this->_aMapsLoaded[] = $sLocation;
            }
        }
    }

    /**
     * Attempts to load the class specified.
     * Returns a boolean FALSE on failure, or a string indicating the class loaded on success.
     *
     * @param   string $class
     * @return  mixed
     */
    public function autoload($class)
    {
        // Initialize
        $sReturn = false;
        $class   = ( is_string($class) ) ? trim($class) : '';

        if (strlen($class) > 0) {
            if (isset($this->_aMap[$class])) {
                require_once $this->_aMap[$class];
                $sReturn = $class;
            }
        }

        return $sReturn;
    }

    /**
     * Register the autoloader with spl_autoload registry.
     *
     * @return void
     */
    public function register()
    {
        spl_autoload_register([ $this, 'autoload' ], true, true);
    }

    /**
     * Retrieve current autoload map.
     *
     * @return array
     */
    public function getAutoloadMap()
    {
        return $this->_aMap;
    }
}
