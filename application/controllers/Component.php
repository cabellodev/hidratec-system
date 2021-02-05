<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Component extends CI_Controller
{
    public function adminComponent()
    { 
        
        if ($this->accesscontrol->checkAuth()['correct']) {
            $this->load->view('admin/header');
            $this->load->view('admin/adminComponent');
            $this->load->view('admin/footer');
        } else {
            redirect(base_url() . 'login', 'refresh');
        }
    }

    public function getComponent()
    {
        if ($this->accesscontrol->checkAuth()['correct']) {
            $this->load->model('ComponentModel');
            $datos = $this->ComponentModel->getComponent();
            $this->response->sendJSONResponse($datos);
        } else {
            $this->response->sendJSONResponse(array('msg' => 'Permisos insuficientes'), 400);
        }
    }


    public function createComponent()
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
              
                $this->load->model('ComponentModel');
                $this->ComponentModel->insertComponent($name,$description);
                $this->response->sendJSONResponse(array('msg' => "Componente creado."));
            } else {
                $this->response->sendJSONResponse(array('msg' => "Corrija los errores del formulario", 'err' => $err), 400);
            }
        } else {
            $this->response->sendJSONResponse(array('msg' => 'Permisos insuficientes'), 400);
        }
    }




    public function editComponent()
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
				$this->load->model('ComponentModel');
				$res = $this->ComponentModel->updateComponent($name, $description,$id);
				if ($res) {
					$this->response->sendJSONResponse(array('msg' => "Componente modificado."));
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
			$this->load->model('ComponentModel');
			$data = $this->input->post('data');
			$state = $data['state'];
			$id = $data['id'];
			$res = $this->ComponentModel->changeState($id, $state);
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
