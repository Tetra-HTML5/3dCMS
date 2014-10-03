<?php
class SceneObject extends Base_Model 
{
    public $id;
    public $name;
    public $sceneId;
    public $position_x;
    public $position_y;
    public $position_z;
    public $rotation_x;
    public $rotation_y;
    public $rotation_z;
    public $scale_x;
    public $scale_y;
    public $scale_z;
    public $objectType;

    
    
    
    public function __construct()
    {
        $this->load->model('mappers/sceneobject_mapper');
    }
}
?>
