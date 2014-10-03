<?php

class SceneObject_Mapper extends DataMapper_Model 
{

    function SetMappingRelations()
    {
        $this->SetProperty("id",                "id", "num");
        $this->SetProperty("name",              "name");
        $this->SetProperty("sceneId",           "sceneId", "num");
        $this->SetProperty("position_x",        "position_x", "num");
        $this->SetProperty("position_y",        "position_y", "num");
        $this->SetProperty("position_z",        "position_z", "num");
        $this->SetProperty("rotation_x",        "rotation_x", "num");
        $this->SetProperty("rotation_y",        "rotation_y", "num");
        $this->SetProperty("rotation_z",        "rotation_z", "num");
        $this->SetProperty("scale_x",           "scale_x", "num");
        $this->SetProperty("scale_y",           "scale_y", "num");
        $this->SetProperty("scale_z",           "scale_z", "num");
    }
    
    
    function Save($sceneObject)
    {
         if(empty($sceneObject->id))
            $this->Insert($sceneObject);
         else
            $this->Update($sceneObject);
    }
    
    
    
    function Insert($sceneObject)
    {
        print_r($sceneObject);
        $updatableFields = array("name", "sceneId", "position_x", "position_y", "position_z", "rotation_x",
                                "rotation_y", "rotation_z", "scale_x", "scale_y", "scale_z");
                                
        $this->SetUpdatableFields($updatableFields);
        $insertString = $this->GetInsertString($sceneObject);

        $sql = "INSERT INTO sceneObject
            {$insertString}"; 
             
        $this->db->query($sql);
        
        echo $sql;
        $sceneObject->id = $this->db->insert_id();
        $sceneObject->sceneObjectId =$sceneObject->id;
    }
    
    
    function Update($sceneObject)
    {
        $updatableFields = array("name", "sceneId", "position_x", "position_y", "position_z", "rotation_x",
                                "rotation_y", "rotation_z", "scale_x", "scale_y", "scale_z");
        $this->SetUpdatableFields($updatableFields);
        $updateString = $this->GetUpdateString($sceneObject);
        
        $sql = "UPDATE sceneObject
            SET {$updateString}
            WHERE id = {$sceneObject->id}"; 
             
        $this->db->query($sql);
    }
    
    
    
    function Delete($sceneObjectId)
    {
        $sql = "DELETE so, m3d FROM sceneObject so
                LEFT JOIN model3d m3d ON (m3d.sceneObjectId = so.id)
            WHERE so.id = {$sceneObjectId}";
  
        $this->db->query($sql); 
    }
       
    
}


?>