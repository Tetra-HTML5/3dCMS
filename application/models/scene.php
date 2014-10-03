<?php
class Scene extends Base_Model 
{
    public $id;
    public $name;
    public $adminUserId;
    
    public $sceneObjectIdsToRemove;
 
    //references
    public $model3ds;
    public $lights;   

    
    
    
    public function __construct()
    {
        $this->load->model('mappers/scene_mapper');
        $this->sceneObjectIdsToRemove = array();
    }
    
    
    public function LoadSceneObjects()
    {
        $this->load->model('model3d'); 
        $model3dMapper =new Model3d_Mapper();
        $this->model3ds = $model3dMapper->GetOverview();
        
    }
    
    
    public function CreateFromInput($array)
    {
        $this->AutoMapInputFrom($array);
        
        //create model3ds from input
        $this->model3ds = array();
        $model3dMapper =new Model3d_Mapper();
        for($i=0; $i<count($array['model3ds']); $i++)
        {
            $model3d = new Model3d();
            $model3d->CreateFromInput($array['model3ds'][$i]);
            array_push($this->model3ds, $model3d);
        }
    }
    
}
?>
