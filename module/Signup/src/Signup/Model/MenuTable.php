<?php
namespace Signup\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class MenuTable
{

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    // Insert the name, route and parent in the menu table
    public function enterDetails(Menu $login)
    {
        try{
        $name = $login->name;
        $route = $login->route;
        $parent = $login->parent;
        if ($parent == "NO PARENT") {
            $this->tableGateway->insert(array(
                'name' => $name,
                'route' => $route,
                'parent' => "NULL"
            ));
        } else {
            $this->tableGateway->insert(array(
                'name' => $name,
                'route' => $route,
                'parent' => $parent
            ));
        }
        }catch (\Exception $e) {
            echo $e->getTraceAsString();
        }
    }
   
    //returns menu table details
    public function parentList()
    {
        try{
        $data = $this->tableGateway->select();
        } catch (\Exception $e) {
            echo $e->getTraceAsString();
        }
      // print_r($data);
        return $data;
        
    }

    //returns list of parent route 
    public function parent()
    {
        try{
        $data = $this->tableGateway->select(function (Select $select) {
            $select->where->like('parent', 'NULL');
        });
        } catch (\Exception $e) {
                echo $e->getTraceAsString();
        }
        return $data;
       
   }
    
    
}