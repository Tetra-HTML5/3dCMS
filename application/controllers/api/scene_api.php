<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package        CodeIgniter
 * @subpackage    Rest Server
 * @category    Controller
 * @author        Phil Sturgeon
 * @link        http://philsturgeon.co.uk/code/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class scene_api extends REST_Controller
{
    function scene_get()  
    {  
        if(!$this->get('id'))  
        {  
            $this->response(NULL, 400);  
        }  
        
        $this->load->model('scene'); 
        $sceneMapper =new Scene_Mapper();
        $scene = $sceneMapper->GetDetail($this->get('id'));
        
        if($this->get('loadObjects'))
        {
            $scene->LoadSceneObjects(); 
        }
          
        if($scene)  
        {  
            $this->response($scene, 200); // 200 being the HTTP response code  
        }  
  
        else  
        {  
            $this->response(NULL, 404);  
        } 
    }
    
    
    
    function scene_put()  
    {  
        $this->load->model('scene');
        $this->load->model('model3d'); 
        $scene = new Scene();


        $scene->CreateFromInput($this->_put_args);
        print_r($scene->sceneObjectIdsToRemove);
        $sceneMapper =new Scene_Mapper();
        $sceneMapper->Update($scene);
        
        //save all scenobjects
        $model3dMapper =new Model3d_Mapper();

        foreach($scene->model3ds as $model3d)
        {
            $model3dMapper->Save($model3d);
        }
        
        //remove deleted sceneobjects
        $sceneObjectMapper = new SceneObject_Mapper();
        foreach($scene->sceneObjectIdsToRemove as $idToRemove)
        {
            $sceneObjectMapper->Delete($idToRemove);
        }
    }
    
    
     /*
    function model3ds_get()  
    {  
        $this->load->model('model3d'); 
        $model3dMapper =new Model3d_Mapper();
        $model3d = $model3dMapper->GetOverview(); 
          
        if($model3d)  
        {  
            $this->response($model3d, 200); // 200 being the HTTP response code  
        }  
  
        else  
        {  
            $this->response(NULL, 404);  
        } 
    } */
    
}

?>