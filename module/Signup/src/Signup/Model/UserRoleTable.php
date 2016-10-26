<?php
namespace Signup\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class UserRoleTable
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

    public function save(UserRole $role)
    {
        try {
            $data = array(
                'role_id' => $role->role_id,
                'user_id' => $role->user_id
            );
            
            $this->tableGateway->insert($data);
        } catch (\Exception $e) {
            echo $e->getTraceAsString();
        }
    }
}
