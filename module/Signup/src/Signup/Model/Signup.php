<?php
namespace Signup\Model;

use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;

class Signup implements InputFilterAwareInterface
{

    public $user_id;
    public $email;

    public $password;


    public $username;

    public $display_name;


    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->user_id = (isset($data['user_id'])) ? $data['user_id'] : null;
        $this->email = (isset($data['email'])) ? $data['email'] : null;
        $this->password = (isset($data['password'])) ? $data['password'] : null;
        $this->username = (! empty($data['username'])) ? $data['username'] : null;
        $this->display_name = (! empty($data['display_name'])) ? $data['display_name'] : null;
     
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
                'name' => 'email',
                'required' => true
            )
            );
            
            $inputFilter->add(array(
                'name' => 'password',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 8,
                            'message' => "invalid"
                        )
                    )
                )
            ));
            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
        
    }
    
}



?>