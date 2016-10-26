<?php
namespace Signup\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\ResultSet\ResultSet;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;


class RoleTable
{

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    // Insert the name, route and parent in the menu table
    public function enterDetails(Role $login)
    {
        try{
        $role = $login->role;
       
            $this->tableGateway->insert(array(
                'role' => $role,
     
            ));
        
        }catch (\Exception $e) {
            echo $e->getTraceAsString();
        }
    }
   
    //returns menu table details
    public function roleList()
    {
        try{
        $data = $this->tableGateway->select();
        } catch (\Exception $e) {
            echo $e->getTraceAsString();
        }
 
        return $data;
        
    }
//     public function fetchAll()
//     {
//         try{
//             $data = $this->tableGateway->select();
//         } catch (\Exception $e) {
//             echo $e->getTraceAsString();
//         }
    
//         return $data;
//     }
    public function fetchAll($paginated=false)
    {
        if ($paginated) {
            // create a new Select object for the table album
            $select = new Select('role');
            // create a new result set based on the Album entity
            $resultSetPrototype = new ResultSet();
            //$resultSetPrototype->setArrayObjectPrototype(new RoleTable());
            // create a new pagination adapter object
            $paginatorAdapter = new DbSelect(
                // our configured select object
                $select,
                // the adapter to run it against
                $this->tableGateway->getAdapter(),
                // the result set to hydrate
                $resultSetPrototype
                );
            $paginator = new Paginator($paginatorAdapter);
            return $paginator;
        }
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }


    
}