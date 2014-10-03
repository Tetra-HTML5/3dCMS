<?php
class Model3dAsset extends CI_Model 
{
    public $id;
    public $name;
    public $accessId;
    public $fileName;
    public $materialAssetId;
    
    //loaded from file
    public $fileContent;
    
    
    public function __construct()
    {
        $this->load->model('mappers/model3dasset_mapper');
    }
    
    
}
?>
