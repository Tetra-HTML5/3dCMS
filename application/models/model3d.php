<?php
class Model3d extends SceneObject 
{
    public $id;
    public $sceneObjectId;
    public $model3dAssetId;
    public $materialAssetId;
    
    //references
    public $model3dAsset;
    public $materialAsset;
    
    
    
    public function __construct()
    {
        $this->load->model('sceneobject');
        $this->load->model('mappers/model3d_mapper');
    }
    
    
    public function CreateFromInput($array)
    {
        $this->AutoMapInputFrom($array); 
    }
}
?>
