<?php
namespace Signup\Model;

use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;

class Role implements InputFilterAwareInterface
{

    public $id;

    public $role;



    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->id = (! empty($data['id'])) ? $data['id'] : null;
        $this->role = (isset($data['role'])) ? $data['role'] : null;

    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("exception");
    }

    public function getInputFilter()
    {
        if (! $this->inputFilter) {
            $inputFilter = new InputFilter();
            
            $inputFilter->add(array(
                'name' => 'role',
                'required' => true,
                'validatore' => array(
                    'name' => 'Text',
                    'min' => 1,
                    'message' => 'please enter valid menu'
                )
            )
            );

            
            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
        
    }
    
}



?>