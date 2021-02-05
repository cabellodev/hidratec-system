<?php
class LocationModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function getLocation()
    {
        $query = "SELECT * FROM locations";
        return $this->db->query($query)->result();
    }

    public function insertLocation($name,$description)
    {
        $query = "INSERT INTO locations (locations.name ,locations.description, states) VALUES (?, ?, ?)";
      return $this->db->query($query, array($name, $description, true));
    }

   
    public function updateLocation($name,$description,$id)
    {
        $query = "UPDATE locations SET locations.name= ?,locations.description= ? WHERE id_location =?";
        return $this->db->query($query, array($name, $description, $id));
     }
    

    public function changeState($id, $state)
    {
       $query = "UPDATE locations SET states = ? WHERE id_location = ?";
       return $this->db->query($query, array($state, $id));
    }
 
}