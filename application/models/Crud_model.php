<?php

class Crud_model extends CI_Model{
    
    public function insert($table,$data){
        $this->db->insert($table,$data);
        return $this->db->insert_id();
    }
    public function update($table,$id,$data){
        $this->db->where("id",$id);
        $this->db->update($table,$data);
    }
    public function delete($table,$id){
        $this->db->where("id",$id);
        $this->db->delete($table);
    }
}
