<?php
namespace Signup\Form;

use Zend\Form\Form;

class MenuForm extends Form
{

    public function __construct($name = null)
    {
        parent::__construct('dashboard');
        
        $this->add(array(
            'name' => 'name',
            'type' => 'Text',
            'options' => array(
                'label' => 'Name'
            )
        )
        );
        $this->add(array(
            'name' => 'route',
            'type' => 'Text',
            'options' => array(
                'label' => 'Route'
            )
        )
        );
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'parent'
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