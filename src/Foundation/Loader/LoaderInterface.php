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
 * Interface for classes that may register with the spl_autoload registry
 *
 * @category   Foundation
 * @package    Loader
 * @version    1.0.0
 * @since      1.0.0
 */
interface LoaderInterface
{

    /**
     * Constructor.
     *
     * @param  null|array $options Autoloader configuration.
     */
    public function __construct(array $options = null);

    /**
     * Configure the autoloader.
     *
     * @param array $options Autoloader configuration.
     * @return void
     */
    public function setOptions(array $options);

    /**
     * Attempts to load the class specified.
     * Returns a boolean FALSE on failure, or a string indicating the class loaded on success.
     *
     * @param   string $class
     * @return  mixed
     */
    public function autoload($class);

    /**
     * Register the autoloader with spl_autoload registry.
     *
     * @return void
     */
    public function register();
}
