<?php

namespace App\Models;

use CodeIgniter\Model;

class Mydev_model extends Model
{

    private $last_id;

    public  $db_group_name;


    function __construct()
    {
        $this->db_group_name = \Config\Database::connect('full_ss5_v2');
        parent::__construct();
    }
    function execute($strSQL)
    {
        $query = $this->db_group_name->query($strSQL);
        return $query;
    }
    function execute_binding($strSQL, $data)
    {
        $query = $this->db_group_name->query($strSQL, array_values($data));
        return $query;
    }
    function select($strSQL)
    {
        $query = $this->db_group_name->query($strSQL);
        return $query->getResult();
    }
    function select_binding($strSQL, $data)
    {
        $query = $this->db_group_name->query($strSQL, array_values($data));
        return $query->getResult();
    }
    function get_last_id()
    {
        return $this->last_id;
    }
    function __destruct()
    {
        $this->db_group_name->close();
    }
    
    
}
