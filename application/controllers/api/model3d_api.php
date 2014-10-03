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

class model3d_api extends REST_Controller
{
    function model3d_get()  
    {  
        if(!$this->get('id'))  
        {  
            $this->response(NULL, 400);  
        }  
  
        $this->load->model('model3d'); 
        $model3dMapper =new Model3d_Mapper();
        $model3d = $model3dMapper->GetDetail($this->get('id')); 
          
        if($model3d)  
        {  
            $this->response($model3d, 200); // 200 being the HTTP response code  
        }  
  
        else  
        {  
            $this->response(NULL, 404);  
        } 
    } 
    
    
    
    
    function model3dassets_get()  
    {  
        $this->load->model('model3dasset');
        
        $model3dassetMapper =new Model3dAsset_Mapper();
        $model3dAssets = $model3dassetMapper->GetOverview();
        
        if($model3dAssets)  
        {  
            $this->response($model3dAssets, 200); // 200 being the HTTP response code  
        }  
  
        else  
        {  
            $this->response(NULL, 404);  
        }  
         
    } 
    
    
    
    
    function model3dasset_get()  
    {  
        if(!$this->get('id'))  
        {  
            $this->response(NULL, 400);  
        }  
  
        //$user = $this->user_model->get( $this->get('id') ); 
        $this->load->model('model3dasset'); 

        $model3dassetMapper =new Model3dAsset_Mapper();
        $model3dAsset = $model3dassetMapper->GetDetail($this->get('id')); 
          
        if($model3dAsset)  
        {  
            $this->response($model3dAsset, 200); // 200 being the HTTP response code  
        }  
  
        else  
        {  
            $this->response(NULL, 404);  
        } 
    } 
    
    
    
        
    function users_get()
    {
        echo "ok";
        //$users = $this->some_model->getSomething( $this->get('limit') );
        $users = array(
            array('id' => 1, 'name' => 'Some Guy', 'email' => 'example1@example.com'),
            array('id' => 2, 'name' => 'Person Face', 'email' => 'example2@example.com'),
            3 => array('id' => 3, 'name' => 'Scotty', 'email' => 'example3@example.com', 'fact' => array('hobbies' => array('fartings', 'bikes'))),
        );
        
        if($users)
        {
            $this->response($users, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    } 
  
    function user_put()  
    {  
        // create a new user and respond with a status/errors  
    }  
  
    function user_post()  
    {  
        // update an existing user and respond with a status/errors  
    }  
  
    function user_delete()  
    {  
        // delete a user and respond with a status/errors  
    } 
    

    
 
}
