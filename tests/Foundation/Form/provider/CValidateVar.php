<?php
namespace Foundation\Test\Form;

final class CValidateVar extends \Foundation\Form\CValidatorAbstract
{
    /** Class section
     * ************** */

    /**
     * Constructor.
     */
    public function __construct(array $aDefinition)
    {
        parent::__construct($aDefinition);
        $this->_aKeyDefinition = array_keys($aDefinition);
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        $this->_aKeyDefinition = [ ];
        parent::__destruct();
    }

    /**
     * Validate the form.
     *
     * @return bool
     */
    public function isValid()
    {
        $bReturn = true;
        foreach ($this->_aKeyDefinition as $sKey) {
            $bReturn = $bReturn && $this->validateVar($sKey, $sKey);
        }
        return $bReturn;
    }

    /** Test section
     * ************* */

    /**
     * Arguments for filtering.
     *
     * @var array
     */
    private $_aKeyDefinition = [ ];
}
