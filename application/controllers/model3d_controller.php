<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model3d_Controller extends CI_Controller 
{
    public function view()
    {
        $this->load->helper('file');
        //$string = read_file('./cubeNormalSmooth.obj'); 
        $string = read_file('./untitled.obj');  
        //echo $string;
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($string));
    }
}
