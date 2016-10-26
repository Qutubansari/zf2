<?php
namespace Signup\Model;

use Zend\Db\TableGateway\TableGateway;

class SignupTable
{

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    // enter the signup details  in user table
    public function enterDetails(Signup $signup)
    {
        try{
        $password = md5($signup->password);
        $email = $signup->email;
        $username = $signup->username;
        $display_name = $signup->display_name;
        $this->tableGateway->insert(array(
           
            'email' =>$email,     
            'password' => $password,
            'username' => $username,
            'display_name' => $display_name,
          
        ));
        } catch (\Exception $e) {
            echo $e->getTraceAsString();
        }
        
    }
    public function fetchAll()
    {
        try{
            $data = $this->tableGateway->select();
        } catch (\Exception $e) {
            echo $e->getTraceAsString();
        }
        
        return $data;
    }
}