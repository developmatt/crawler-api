<?php

namespace Flame;

use App\config\Database;

class Model {
    
    protected $db;

    public function __construct(){
        $db = new Database();
        $this->db = $db->getConnection(); 
    }

    public function all(){
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function find($id){
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = "' . $id . '"';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findByColumn($column, $value){
        $query = 'SELECT * FROM ' . $this->table . ' WHERE ' . $column . ' = "' . $value . '"';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}