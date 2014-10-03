<?php

class Model3d_Mapper extends SceneObject_Mapper 
{  

    function SetMappingRelations()
    {
        parent::SetMappingRelations();
        $this->SetProperty("id",                "id", "num");
        $this->SetProperty("sceneObjectId",     "sceneObjectId", "num");
        $this->SetProperty("model3dAssetId",    "model3dAssetId", "num");
        $this->SetProperty("materialAssetId",   "materialAssetId", "num");

    }
    
 
 

    
    function GetOverview()
    {
        $sql = "SELECT m3d.id, m3d.sceneObjectId, m3d.model3dAssetId, m3d.materialAssetId,
                so.sceneId, so.name, so.position_x, so.position_y, so.position_z,
                so.rotation_x, so.rotation_y, so.rotation_z,
                so.scale_x, so.scale_y, so.scale_z
            FROM model3d as m3d
            INNER JOIN sceneObject as so ON (so.id = m3d.sceneObjectId)
            ORDER BY id";
            
        $query = $this->db->query($sql);
        $rows = $query->num_rows();
        $result = $query->result();
        
        for ($i = 0; $i < $rows; $i++) 
        {
            $data = $result[$i];  
            //map   
            $model3d = new Model3d();
            $this->MapDbToObject($data, $model3d);
            $returnArr[$i] =  $model3d;
        }
        
        return $returnArr;
    }
    
    

    
    
    function GetDetail($id)
    {
        $sql = "SELECT id, sceneObjectId, model3dAssetId, materialAssetId 
            FROM model3d
            WHERE id = $id";
        
        $query =  $this->db->query($sql);
        $result = $query->result();
        if($query->num_rows()>= 0)
        {
            $data = $result[0];
            //map
            $model3d = new Model3d();
            $this->MapDbToObject($data, $model3d);
            return $model3d;
        }

        
        return null;
    }
    
    
    
    
    function Save($model3d)
    {
         if(empty($model3d->id))
            $this->Insert($model3d);
         else
            $this->Update($model3d);
    }
    
        
    function Update($model3d)
    {
        $updatableFields = array("sceneObjectId", "model3dAssetId", "materialAssetId");
        $this->SetUpdatableFields($updatableFields);
        $updateString = $this->GetUpdateString($model3d);
        
        $sql = "UPDATE model3d
            SET {$updateString}
            WHERE id = {$model3d->id}"; 
             
        $this->db->query($sql);
        
        $sceneObjectMapper = new SceneObject_Mapper();
        $sceneObjectMapper->Update($model3d);
    }
    
    
    
    function Insert($model3d)
    {
        $sceneObjectMapper = new SceneObject_Mapper();
        $sceneObjectMapper->Save($model3d);
        
        echo "insert model3d ";
        print_r($model3d);
        $updatableFields = array("sceneObjectId", "model3dAssetId", "materialAssetId");
        $this->SetUpdatableFields($updatableFields);
        $insertString = $this->GetInsertString($model3d);

        $sql = "INSERT INTO model3d
            {$insertString}"; 
             
        $this->db->query($sql);
        
        echo $sql;
        $model3d->id = $this->db->insert_id();
        
        //$sceneObjectMapper = new SceneObject_Mapper();
        //$sceneObjectMapper->Update($model3d);
    }

    
}

?>