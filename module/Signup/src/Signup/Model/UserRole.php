<?php
namespace Signup\Model;

use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;


class UserRole implements InputFilterAwareInterface
{

    public $role_id;

    public $user_id;

    protected $inputFilter;

    public function exchangeArray($data)
    {
        try {
            $this->user_id = (isset($data['user'])) ? $data['user'] : null;

            $this->role_id = (isset($data['role'])) ? $data['role'] : null;
             
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