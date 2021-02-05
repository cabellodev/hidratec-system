<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subtask extends CI_Controller
{
    public function adminSubtask()
    { 
        
        if ($this->accesscontrol->checkAuth()['correct']) {
            $this->load->view('admin/header');
            $this->load->view('admin/adminSubtask');
            $this->load->view('admin/footer');
        } else {
            redirect(base_url() . 'login', 'refresh');
        }
    }

    public function getSubtask()
    {
        if ($this->accesscontrol->checkAuth()['correct']) {
            $this->load->model('SubtaskModel');
            $datos = $this->SubtaskModel->getSubtask();
            $this->response->sendJSONResponse($datos);
        } else {
            $this->response->sendJSONResponse(array('msg' => 'Permisos insuficientes'), 400);
        }
    }
    
    public function createSubtask()
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
              
                $this->load->model('SubtaskModel');
                $this->SubtaskModel->insertSubtask($name,$description);
                $this->response->sendJSONResponse(array('msg' => "Subtarea creada."));
            } else {
                $this->response->sendJSONResponse(array('msg' => "Corrija los errores del formulario", 'err' => $err), 400);
            }
        } else {
            $this->response->sendJSONResponse(array('msg' => 'Permisos insuficientes'), 400);
        }
    }




    public function editSubtask()
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
				$err['name']  = "Ingrese un nombre .";
			}
			if ($description == "") {
				$ok = false;
				$err['description'] = "Ingrese descripción.";
			}
		
			if ($ok) {
				$this->load->model('SubtaskModel');
				$res = $this->SubtaskModel->updateSubtask($name, $description,$id);
				if ($res) {
					$this->response->sendJSONResponse(array('msg' => "Subtarea modificada."));
				} else {
					$this->response->sendJSONResponse(array('msg' => "No se pudo modificar la subtarea."), 400);
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
			$this->load->model('SubtaskModel');
			$data = $this->input->post('data');
			$state = $data['state'];
			$id = $data['id'];
			$res = $this->SubtaskModel->changeState($id, $state);
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
