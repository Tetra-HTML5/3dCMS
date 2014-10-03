<?php
class MaterialAsset extends Base_Model 
{
    public $id;
    public $name;
    public $accessId;
    public $textureId;
    public $colorDiffuse_r;
    public $colorDiffuse_g;
    public $colorDiffuse_b;
    public $colorSpecular_r;
    public $colorSpecular_g;
    public $colorSpecular_b;
    
    //references
    public $texture;
    
    
    public function __construct()
    {
        $this->load->model('mappers/materialasset_mapper');
    }
    
    
    public function CreateFromInput($array)
    {
        $this->AutoMapInputFrom($array);
    }
    
}
?>
