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

class material_api extends REST_Controller
{ 
    
    function materials_get()  
    {  
        $this->load->model('materialasset'); 

        $materialAssetMapper =new MaterialAsset_Mapper();
        $materialAssets = $materialAssetMapper->getOverview(); 
          
        if($materialAssets)  
        {  
            $this->response($materialAssets, 200); // 200 being the HTTP response code  
        }  
  
        else  
        {  
            $this->response(NULL, 404);  
        } 
    } 
    
    
    
         
  
    function material_put()  
    {  
        $this->load->model('materialasset');
        $materialasset = new MaterialAsset();


        $materialasset->CreateFromInput($this->_put_args);
        print_r($materialasset);
        
        $materialassetMapper =new MaterialAsset_Mapper();
        $materialassetMapper->Update($materialasset);
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
