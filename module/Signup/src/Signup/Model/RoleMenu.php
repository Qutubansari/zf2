<?php
namespace Signup\Model;

use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;


class RoleMenu implements InputFilterAwareInterface
{

    public $role;

    public $menu_id;

    protected $inputFilter;

    public function exchangeArray($data)
    {
        //print_r($data);
       // die;
        try {
            $this->menu_id = (isset($data['menu'])) ? $data['menu'] : null;

            $this->role = (isset($data['role'])) ? $data['role'] : null;
             
        } catch (\Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    // Add content to these methods:
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

  
    public function getInputFilter()
    {
        try {
            if (! $this->inputFilter) {
                $inputFilter = new InputFilter();

                


                $this->inputFilter = $inputFilter;
            }

            return $this->inputFilter;
        } catch (\Exception $e) {
            echo $e->getTraceAsString();
        }
    }
}



?>