<?php
namespace Signup\Form;

use Zend\Form\Form;


class SignupForm extends Form
{

    public function __construct($name = null)
    {
        parent::__construct("Signup");

        $this->add(array(
            'name' => 'username',
            'type' => 'text',
            'options' => array(
                'label' => 'Username'
            )
        )
            );
        $this->add(array(
            'name' => 'email',
            'type' => 'email',
            'options' => array(
                'label' => 'Email'
            )
        )
        );
        $this->add(array(
            'name' => 'display_name',
            'type' => 'text',
            'options' => array(
                'label' => 'Display Name'
            )
        )
            );
        $this->add(array(
            'name' => 'password',
            'type' => 'password',
            'options' => array(
                'label' => 'Password'
            )
        ));
        
        
       
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'submit'
            )
        ));
        
        
       
        
    }
    
}