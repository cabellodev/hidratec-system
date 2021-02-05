<?php
class SubtaskModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function getSubtask()
    {
        $query = "SELECT * FROM subtask";
        return $this->db->query($query)->result();
    }

    public function insertSubtask($name,$description)
    {
        $query = "INSERT INTO subtask (subtask.name ,subtask.description, states) VALUES (?, ?, ?)";
      return $this->db->query($query, array($name, $description, true));
    }

   
    public function updateSubtask($name,$description,$id)
    {
        $query = "UPDATE subtask SET subtask.name= ?,subtask.description= ? WHERE id_subtask =?";
        return $this->db->query($query, array($name, $description, $id));
     }
    

    public function changeState($id, $state)
    {
       $query = "UPDATE subtask SET states = ? WHERE id_subtask = ?";
       return $this->db->query($query, array($state, $id));
    }
 
}
