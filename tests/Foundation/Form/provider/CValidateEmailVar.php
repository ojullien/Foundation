<?php
namespace Foundation\Test\Form;

final class CValidateEmailVar extends \Foundation\Form\CValidatorAbstract
{
    /** Class section
     * ************** */

    /**
     * Constructor.
     */
    public function __construct( array $aDefinition, $bCheckDNS = FALSE )
    {
        parent::__construct( $aDefinition );
        $this->_aKeyDefinition = array_keys( $aDefinition );
        $this->_bCheckDNS      = $bCheckDNS;
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
        $bReturn = TRUE;
        foreach( $this->_aKeyDefinition as $sKey )
        {
            $bReturn = $bReturn && $this->validateEmailVar( $sKey, $sKey, $this->_bCheckDNS );
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

    /**
     * Check DNS
     *
     * @var boolean
     */
    private $_bCheckDNS = FALSE;

}