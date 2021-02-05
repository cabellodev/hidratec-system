<?php
class BrandModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function getBrand()
    {
        $query = "SELECT * FROM brand";
        return $this->db->query($query)->result();
    }

    public function insertBrand($name)
    {
        $query = "INSERT INTO brand (brand.name , states) VALUES (?, ?)";
      return $this->db->query($query, array($name, true));
    }

   
    public function updateBrand($name,$id)
    {
        $query = "UPDATE brand SET brand.name= ? WHERE id_brand =?";
        return $this->db->query($query, array($name, $id));
     }
    

    public function changeState($id, $state)
    {
       $query = "UPDATE brand  SET states = ? WHERE id_brand = ?";
       return $this->db->query($query, array($state, $id));
    }
 
}