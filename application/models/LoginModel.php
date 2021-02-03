<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function checkUser($rut)
    {
        $query = 'SELECT u.id,u.rut, u.nombre, u.email,u.password_hash, u.estado,u.range 
                  FROM user u
                  WHERE u.rut = ?';

        return $this->db->query($query, array($rut))->row();
    }

    public function checkState($rut)
    {
        $query = 'SELECT COUNT(*) as cant
                  FROM user u
                  WHERE u.rut = ? AND u.estado = false';
        return $this->db->query($query, array($rut))->row();
    }

    public function recoverPassword($email, $hash)
    {
        $query = 'UPDATE user SET recover_hash = ?, recover_day = NOW() WHERE email_access = ?';

        return $this->db->query($query, array($hash, $email))->row();
    }
}
