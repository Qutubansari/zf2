<?php
namespace Signup\Form;

use Zend\Form\Form;

class RoleForm extends Form
{

    public function __construct($name = null)
    {
        parent::__construct('dashboard');
        
        $this->add(array(
            'name' => 'role',
            'type' => 'Text',
            'options' => array(
                'label' => 'Job Role'
            )
        )
        );
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'submit'
            )
        ));
    }
}

?>