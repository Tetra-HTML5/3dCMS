<?php
class TextureAsset extends CI_Model 
{
    public $id;
    public $name;
    public $accessId;
    public $fileName;
    
    public $filePath;

    

    
    public function __construct()
    {
        $this->load->model('mappers/textureasset_mapper');
    }
    
    
    
    
}
?>
