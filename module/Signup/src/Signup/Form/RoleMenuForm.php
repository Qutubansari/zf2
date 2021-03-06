<?php
namespace Signup\Form;

use Zend\Form\Form;


class RoleMenuForm extends Form
{

    /**
     *
     * @name constructor
     *      
     *       used to create form elements
     *      
     * @param
     *            variable whichh contains name of form
     *            
     *            
     * @return void
     */
    public function __construct($name = null)
    {
        try {
            // we want to ignore the name passed
            parent::__construct($name);
            
            $this->add(array(
                'name' => 'menu',
                'type' => 'Select',
                'options' => array(
                    'label' => 'select Menu'
                )
            ));
            
            $this->add(array(
                'name' => 'role',
                'type' => 'Select',
                'options' => array(
                    'label' => 'Select Role'
                )
            ));
            
            $this->add(array(
                'name' => 'submit',
                'type' => 'Submit',
                'attributes' => array(
                    'value' => 'submit'
                )
            ));
            
            
        } catch (\Exception $e) {
            echo $e->getTraceAsString();
        }
    }
}