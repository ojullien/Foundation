<?php
namespace Foundation\Test\Form;

final class CValidator extends \Foundation\Form\CValidatorAbstract
{
    /** Class section
     * ************** */

    /**
     * Constructor.
     */
    public function __construct(array $aDefinition)
    {
        parent::__construct($aDefinition);
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        parent::__destruct();
    }

    /**
     * Validate the form.
     *
     * @return bool
     */
    public function isValid()
    {
        $this->_bHasValidated = true;
        $this->setMessage('ELEMENT_1', 'The description for element 1');
        $this->setMessage('ELEMENT_2', 'The description for element 2');
        return true;
    }
}
