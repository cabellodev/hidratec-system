<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Location extends CI_Controller
{
    public function adminLocation()
    { 
        
        if ($this->accesscontrol->checkAuth()['correct']) {
            $this->load->view('admin/header');
            $this->load->view('admin/adminLocation');
            $this->load->view('admin/footer');
        } else {
            redirect(base_url() . 'login', 'refresh');
        }
    }


    public function getLocation()
    {
        if ($this->accesscontrol->checkAuth()['correct']) {
            $this->load->model('LocationModel');
            $datos = $this->LocationModel->getLocation();
            $this->response->sendJSONResponse($datos);
        } else {
            $this->response->sendJSONResponse(array('msg' => 'Permisos insuficientes'), 400);
        }
    }

    public function createLocation()
    {
        if ($this->accesscontrol->checkAuth()['correct']) {
            $data = $this->input->post('data');
            $name = $data['name'];
            $description = $data['description'];

            $ok = true;
            $err = array();

            if ($name == "") {
                $ok = false;
                $err['name']  = "Ingrese un nombre.";
            }
            if ($description == "") {
                $ok = false;
                $err['descripcion'] = "Ingrese una descripcion.";
            }
           
            if ($ok) {
              
                $this->load->model('LocationModel');
                $this->LocationModel->insertLocation($name,$description);
                $this->response->sendJSONResponse(array('msg' => "Ubicación creada."));
            } else {
                $this->response->sendJSONResponse(array('msg' => "Corrija los errores del formulario", 'err' => $err), 400);
            }
        } else {
            $this->response->sendJSONResponse(array('msg' => 'Permisos insuficientes'), 400);
        }
    }

    
    public function editLocation()
	{
		if ($this->accesscontrol->checkAuth()['correct']) {
			$data = $this->input->post('data');
			$name = $data['name'];
			$description = $data['description'];
			$id= $data['id'];
	
			$ok = true;
			$err = array();

			if ($name == "") {
				$ok = false;
				$err['name']  = "Ingrese un nombre para el usuario.";
			}
			if ($description == "") {
				$ok = false;
				$err['description'] = "Ingrese un correo electrónico.";
			}
		
			if ($ok) {
				$this->load->model('LocationModel');
				$res = $this->LocationModel->updateLocation($name, $description,$id);
				if ($res) {
					$this->response->sendJSONResponse(array('msg' => "Ubicación modificada."));
				} else {
					$this->response->sendJSONResponse(array('msg' => "No se pudo modificar el usuario."), 400);
				}
			} else {
				$this->response->sendJSONResponse(array('msg' => "Corrija los errores del formulario", 'err' => $err), 400);
			}
		} else {
			$this->response->sendJSONResponse(array('msg' => 'Permisos insuficientes'), 400);
		}
    }


    public function changeState()
	{
		if ($this->accesscontrol->checkAuth()['correct']) {
			$this->load->model('LocationModel');
			$data = $this->input->post('data');
			$state = $data['state'];
			$id = $data['id'];
			$res = $this->LocationModel->changeState($id, $state);
			if ($res) {
				$this->response->sendJSONResponse(array('msg' => "Estado cambiado exitosamente."));
			} else {
				$this->response->sendJSONResponse(array('msg' => "No se pudo cambiar el estado."), 400);
			}
		} else {
			$this->response->sendJSONResponse(array('msg' => 'Permisos insuficientes'), 400);
		}
	}







    
}
