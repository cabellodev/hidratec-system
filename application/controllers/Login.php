<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function Index()
	{
		$this->load->view('sh_digitales/login');
    }
    
    public function loginPage()
    {
        if ($this->accesscontrol->checkAuth()['correct']) {
            redirect(base_url() . 'menu', 'refresh');
        } else {
            $this->load->view('Login');
        }
    }

    public function LoginUser()
    {
        if ($this->input->is_ajax_request()) {
            $data = $this->input->post('data');
            $rut = $data['rut'];
            $pass = $data['passwd'];

            $err = array();
            if ($rut == "")   $err['rut'] = "Ingrese un rut.";
            if ($pass == "")    $err['passwd'] = "Ingrese la contraseña.";

            if (count($err) != 0) {
                $this->response->sendJSONResponse(array('msg' => "Corrija los errores del formulario.", 'err' => $err), 400);
                return;
            }

            $this->load->model('LoginModel');
            if ($userData = $this->LoginModel->checkUser($rut)) {
                $res = password_verify($pass, $userData->password_hash);
                $block = $this->LoginModel->checkState($rut);
                if ($block->cant >= 1) {
                    $this->response->sendJSONResponse(array('msg' => "Usuario no tiene permisos para acceder al sistema."), 400);
                } else {
                    if ($res) {
                        $_SESSION['id_user'] = $userData->rut;
                        $_SESSION['username'] = $userData->nombre;
                        $_SESSION['email'] = $userData->email;
                        $_SESSION['rango'] = $userData->range;
                        $this->response->sendJSONResponse(array('msg' => "Acceso correcto."));
                    } else {
                        $this->response->sendJSONResponse(array('msg' => "El correo o la clave es inválida. Reintente."), 400);
                    }
                }
            } else {
                $this->response->sendJSONResponse(array('msg' => "El correo o la clave es inválida. Reintente."), 400);
            }
        } else {
            $this->response->sendJSONResponse(array('msg' => "No se pudo encontrar el recurso."), 404);
        }
    }

    public function logoutUser()
    {
        session_destroy();
        $_SESSION['id_user'] = null;
        $_SESSION['username'] = null;
        $_SESSION['email'] = null;
        $this->response->sendJSONResponse(array('msg' => "Se ha cerrado la sesión."));
    }
}