<?php



if (!function_exists('getCreateSubtaskRules')) {
    function getCreateSubtaskRules()
    {

        return array(

            array(
                'field' => 'name',
                'label' => 'Nombre',
                'rules' => 'required',
                'errors' => array('required' => 'El %s requerido.'),

            ),

        );
    }
}
