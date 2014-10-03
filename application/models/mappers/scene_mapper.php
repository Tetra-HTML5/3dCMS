<?php

class Scene_Mapper extends DataMapper_Model 
{

    function SetMappingRelations()
    {
        $this->SetProperty("id",                "id", "num");
        $this->SetProperty("name",              "name");
        $this->SetProperty("adminUserId",      "adminUserId", "num");
    }
       
       
    function GetDetail($id)
    {
        $sql = "SELECT id, name, adminUserId
            FROM scene
            WHERE id = $id";  
        
        $query =  $this->db->query($sql);
        $result = $query->result();
        if($query->num_rows()> 0)
        {
            $data = $result[0];
            //map
            $scene = new Scene();
            $this->MapDbToObject($data, $scene);
            return $scene;
        }

        
        return null;
    }
    
    
    function Update($scene)
    {
        $updatableFields = array("name");
        $this->SetUpdatableFields($updatableFields);
        $updateString = $this->GetUpdateString($scene);
        
        $sql = "UPDATE scene
            SET {$updateString}
            WHERE id = {$scene->id}"; 
             
        $this->db->query($sql);
    }
    
}


?>