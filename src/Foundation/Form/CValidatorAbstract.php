<?php
namespace Foundation\Form;

/**
 * Foundation Framework
 *
 * @package   Form
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
defined('APPLICATION_VERSION') || die('-1');

/**
 * Parent class for form validator class.
 *
 * @category   Foundation
 * @package    Form
 * @version    1.0.0
 * @since      1.0.0
 */
abstract class CValidatorAbstract implements \Foundation\Form\ValidatorInterface
{
    /** Class section
     * ************** */

    /**
     * Class unique ID
     * @var string
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    private $_sDebugID = '';

    /**
     * Constructor.
     *
     * @param array $aDefinition Arguments for filtering.
     * A valid key is a string containing a variable name and a valid value is either a filter type, or an array
     * optionally specifying the filter, flags and options. If the value is an array, valid keys are filter which
     * specifies the filter type, flags which specifies any flags that apply to the filter, and options which specifies
     * any options that apply to the filter.
     *
     * @codeCoverageIgnore
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __construct(array $aDefinition)
    {
        $this->_aDefinition = $aDefinition;
    }

    /**
     * Destructor.
     *
     * @codeCoverageIgnore
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __destruct()
    {
        $this->_aData       = false;
        $this->_aDataRaw    = [ ];
        $this->_aDefinition = [ ];
    }

    /**
     * Writing data to inaccessible properties is not allowed.
     *
     * @param string $name
     * @param mixed  $value
     * @throws \BadMethodCallException
     * @codeCoverageIgnore
     */
    final public function __set($name, $value)
    {
        throw new \BadMethodCallException('Writing data to inaccessible properties is not allowed.');
    }

    /**
     * Reading data from inaccessible properties is not allowed.
     *
     * @param string $name
     * @throws \BadMethodCallException
     * @codeCoverageIgnore
     */
    final public function __get($name)
    {
        throw new \BadMethodCallException('Reading data from inaccessible properties is not allowed.');
    }

    /** Message section
     * **************** */

    /**
     * List of messages to report when validation fails.
     *
     * @var array
     */
    private $_aMessages = [ ];

    /**
     * Add a custom error message to return in the event of failed validation
     *
     * @param string $sElement Input identifier
     * @param string $sMessage Message
     */
    final protected function setMessage($sElement, $sMessage)
    {
        // Validate inputs
        $sElement = ( is_string($sElement) ) ? trim($sElement) : '';
        $sMessage = ( is_string($sMessage) ) ? trim($sMessage) : '';

        // Add to the list
        if ((strlen($sElement) > 0) && (strlen($sMessage) > 0)) {
            $this->_aMessages[$sElement] = $sMessage;
        }
    }

    /**
     * Get validation error messages, if any.
     *
     * Returns a hash of element names/messages for all elements failing
     * validation, or, if $sElement is provided, messages for that element
     * only.
     *
     * @return array
     */
    final public function getMessages($sElement = null)
    {
        // Validate input
        $sElement = ( is_string($sElement) ) ? trim($sElement) : null;

        if (is_null($sElement)) {
            $aReturn = $this->_aMessages;
        } elseif (isset($this->_aMessages[$sElement])) {
            $aReturn = [ $sElement => $this->_aMessages[$sElement] ];
        } else {
            $aReturn = [ ];
        }

        return $aReturn;
    }

    /** Data section
     * ************* */

    /**
     * Arguments for filtering.
     *
     * A valid key is a string containing a variable name and a valid value is either a filter type, or an array
     * optionally specifying the filter, flags and options. If the value is an array, valid keys are filter which
     * specifies the filter type, flags which specifies any flags that apply to the filter, and options which specifies
     * any options that apply to the filter.
     *
     * @var array
     */
    private $_aDefinition = [ ];

    /**
     * Data being validated.
     *
     * @var array
     */
    private $_aDataRaw = [ ];

    /**
     * Filtered data.
     *
     * @var bool|array
     */
    protected $_aData = false;

    /**
     * Set data to validate.
     *
     * @param array $data the data being validated
     * @return \Foundation\Form\ValidatorInterface
     */
    final public function setData(array $data = [ ])
    {
        // The new data have not been validated
        $this->_bHasValidated = false;
        $this->_aMessages     = [ ];

        // Filter the data
        $this->_aDataRaw = $data;
        $this->_aData    = filter_var_array($data, $this->_aDefinition);

        return $this;
    }

    /**
     * Return validated data. A valid key is a string containing a variable name and a valid value is either a value or
     * FALSE if the filter fails or NULL if the variable is not set.
     *
     * @return bool|array Return FALSE on failure.
     */
    final public function getData()
    {
        return $this->_aData;
    }

    /**
     * Return Data being validated.
     *
     * @return array
     */
    final public function getDataRaw()
    {
        return $this->_aDataRaw;
    }

    /** Validation section
     * ******************* */

    /**
     * Whether or not validation has occurred.
     *
     * @var bool
     */
    protected $_bHasValidated = false;

    /**
     * Result of last validation operation.
     *
     * @var bool
     */
    protected $_bIsValid = false;

    /**
     * Check if the form has been validated.
     *
     * @return bool
     */
    final public function hasValidated()
    {
        return $this->_bHasValidated;
    }

    /**
     * Validates the value of the defined key $sKey from the already filtered inputs $_aData.
     * Returns TRUE if the key exists and if the value is not equals to NULL or FALSE.
     * Returns FALSE if the key does not exist in the filtered inputs or if the value is NULL or FALSE.
     * Error messages are added to the list.
     *
     * @param string $sKey   Value to check.
     * @param string $sLabel Label of the test. Used for message.
     * @return boolean
     */
    final protected function validateVar($sKey, $sLabel)
    {
        // Initialize
        $sKey    = ( is_string($sKey) ) ? trim($sKey) : '';
        $sLabel  = ( is_string($sLabel) ) ? trim($sLabel) : '';
        $bReturn = false;

        // Validate
        if (( '' != $sKey ) && ( '' != $sLabel ) && is_array($this->_aData) && array_key_exists($sKey, $this->_aData)) {
            if (null === $this->_aData[$sKey]) {
                $this->setMessage($sKey, $sLabel . ' is mandatory.');
            } elseif (false === $this->_aData[$sKey]) {
                $this->setMessage($sKey, $sLabel . ' is not valid.');
            }

            // Data are valid
            $bReturn = ( null !== $this->_aData[$sKey] ) && ( false !== $this->_aData[$sKey] );
        }

        return $bReturn;
    }

    /**
     * Validates the already filtered value of the defined key $sKey as a checkbox input.
     *
     * @param string $sKey   Name of the checkbox variable.
     * @param string $sLabel Label of the test. Used for message.
     * @return boolean
     */
    final protected function validateCheckboxVar($sKey, $sLabel)
    {
        $bReturn = $this->validateVar($sKey, $sLabel);

        if ($bReturn) {
            $this->_aData[$sKey] = true;
        }

        return $bReturn;
    }

    /**
     * Validates the already filtered value of the defined key $sKey as a checkbox input.
     *
     * @param string  $sKey      Name of the checkbox variable.
     * @param string  $sLabel    Label of the test. Used for message.
     * @param boolean $bCheckDNS [OPTIONAL] True if the domain should be fully qualified (FQDN) and resolvable to an A
     *                           or MX domain name system record.
     * @return boolean
     */
    final protected function validateEmailVar($sKey, $sLabel, $bCheckDNS = false)
    {
        $bReturn = $this->validateVar($sKey, $sLabel);

        if ($bReturn) {
            $pValidator = new \Foundation\Type\Complex\CEmailAddress($this->_aData[$sKey]);
            $bReturn    = $pValidator->isValid();

            // Validate email
            if ($bReturn) {
                // We are working with punycode
                $this->_aData[$sKey] = $pValidator->getPunycode();
            } else {
                $this->_aData[$sKey] = false;
                $this->setMessage($sKey, $sLabel . ' is not valid.');
            }

            // Validate DNS
            if ($bCheckDNS && $bReturn && ! $pValidator->checkDNS(false)) {
                $bReturn             = false;
                $this->_aData[$sKey] = false;
                $this->setMessage($sKey, $sLabel . ' has not an resolvable to MX domain name system record.');
            }

            unset($pValidator);
        }

        return $bReturn;
    }
}
