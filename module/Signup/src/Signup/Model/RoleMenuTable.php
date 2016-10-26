<?php
namespace Signup\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class RoleMenuTable
{

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        try {
            $this->tableGateway = $tableGateway;
        } catch (\Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function save(RoleMenu $role)
    {
        echo "<pre>";//var_dump($role);
        //echo "emnu id is".$role->menu;
        echo"</pre>";
        try {
            $data = array(
                'role' => $role->role,
                'menu_id' => $role->menu_id,
            );
            
            $this->tableGateway->insert($data);
        } catch (\Exception $e) {
            echo $e->getTraceAsString();
        }
    }
}
