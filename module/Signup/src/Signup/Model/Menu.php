<?php
namespace Signup\Model;

use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;

class Menu implements InputFilterAwareInterface
{

    public $menu_id;

    public $name;

    public $parent;

    public $route;

    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->menu_id = (! empty($data['menu_id'])) ? $data['menu_id'] : null;
        $this->name = (isset($data['name'])) ? $data['name'] : null;
        $this->parent = (isset($data['parent'])) ? $data['parent'] : null;
        $this->route = (isset($data['route'])) ? $data['route'] : null;
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
                'name' => 'name',
                'required' => true,
                'validatore' => array(
                    'name' => 'Text',
                    'min' => 1,
                    'message' => 'please enter valid menu'
                )
            )
            );
            $inputFilter->add(array(
                'name' => 'route',
                'required' => true,
                'validatore' => array(
                    'name' => 'Text',
                    'min' => 1,
                    'message' => 'please enter valid route'
                )
            )
            );
            
            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
        
    }
    
}



?>