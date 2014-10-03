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

class texture_api extends REST_Controller
{ 
    
    function textures_get()  
    {  
        $this->load->model('textureasset'); 

        $textureAssetMapper =new TextureAsset_Mapper();
        $textureAssets = $textureAssetMapper->getOverview(); 

        if($textureAssets)  
        {  
            $this->response($textureAssets, 200); // 200 being the HTTP response code  
        }  
  
        else  
        {  
            $this->response(NULL, 404);  
        } 
    }
    
    
    function texture_get()  
    {  
        if(!$this->get('id'))  
        {  
            $this->response(NULL, 400);  
        }  
        
        $this->load->model('textureasset'); 
        $textureAssetMapper = new TextureAsset_Mapper();
        $textureAsset = $textureAssetMapper->GetDetail($this->get('id'));
          
        if($textureAsset)  
        {  
            $this->response($textureAsset, 200); // 200 being the HTTP response code  
        }  
  
        else  
        {  
            $this->response(NULL, 404);  
        } 
    }
    
    
    
    
    function texture_post()
    {
        $upload_path_url = './assets/texture/';
    
        $config['upload_path'] = $upload_path_url;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']    = '30000';


        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload("upl"))
        {
            $error = array('error' => $this->upload->display_errors());
            echo '{"status":"error"}';
            exit;
        }
        else
        {
            $data =  $this->upload->data();
                        
            //add new texture in database
            $this->load->model('textureasset'); 
            $texture = new TextureAsset();
            $texture->name = $this->input->post('name');
            $texture->fileName = $data["file_name"];
            $texture->accessId = 1;
            
            $textureAssetMapper = new TextureAsset_Mapper();
            $textureAssetMapper->Insert($texture);

            echo '{"status":"success", "id":' . $texture->id . '}';
            exit;
        }
    } 
    
     
}
