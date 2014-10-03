<?php

class TextureAsset_Mapper extends DataMapper_Model 
{

    function SetMappingRelations()
    {
        $this->SetProperty("id",                "id", "num");
        $this->SetProperty("name",              "name");
        $this->SetProperty("accessId",          "accessId", "num");
        $this->SetProperty("fileName",          "fileName");
    }
    
 
    function GetOverview()
    {   
        $sql = "SELECT id, name, accessId, fileName 
            FROM asset_texture
            ORDER BY name";  
        
        $query = $this->db->query($sql);
        $rows = $query->num_rows();
        $result = $query->result();
        
        for ($i = 0; $i < $rows; $i++) 
        {
            $data = $result[$i];  
            $textureAsset = new TextureAsset();
            $this->MapDbToObject($data, $textureAsset);
            //set file path
            $textureAsset->filePath = TextureAssetsUrl($textureAsset->fileName); 
            $returnArr[$i] =  $textureAsset;
        }
        
        return $returnArr;
    }
    
    
    
    function GetDetail($id)
    {   
        $sql = "SELECT id, name, accessId, fileName 
            FROM asset_texture
           WHERE id = {$id}";  
        
        $query = $this->db->query($sql);
        $result = $query->result();
        if($query->num_rows()> 0)
        {
            $data = $result[0];
            //map
            $textureAsset = new TextureAsset();
            $this->MapDbToObject($data, $textureAsset);
            return $textureAsset;
        }

    }
    
    
    
    function Update($textureAsset)
    {
        $updatableFields = array("name", "accessId", "fileName");
        $this->SetUpdatableFields($updatableFields);
        $updateString = $this->GetUpdateString($textureAsset);
        
        $sql = "UPDATE asset_texture
            SET {$updateString}
            WHERE id = {$textureAsset->id}"; 
             
        $this->db->query($sql);
    }
    
    
    
    function Insert($textureAsset)
    {
        $updatableFields = array("name", "accessId", "fileName");
        $this->SetUpdatableFields($updatableFields);
        $insertString = $this->GetInsertString($textureAsset);
        
        $sql = "INSERT INTO asset_texture
            {$insertString}"; 
             
        $this->db->query($sql);
        $textureAsset->id = $this->db->insert_id();
    }
    
}

?>