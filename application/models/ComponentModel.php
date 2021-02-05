<?php
class ComponentModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function getComponent()
    {
        $query = "SELECT * FROM component";
        return $this->db->query($query)->result();
    }

    public function insertComponent($name,$description)
    {
        $query = "INSERT INTO component (component.name ,component.description, states) VALUES (?, ?, ?)";
      return $this->db->query($query, array($name, $description, true));
    }

   
    public function updateComponent($name,$description,$id)
    {
        $query = "UPDATE component SET component.name= ?,component.description= ? WHERE id_component =?";
        return $this->db->query($query, array($name, $description, $id));
     }
    

    public function changeState($id, $state)
    {
       $query = "UPDATE component SET states = ? WHERE id_component = ?";
       return $this->db->query($query, array($state, $id));
    }
 
}