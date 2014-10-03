<?php

class MaterialAsset_Mapper extends DataMapper_Model 
{

    function SetMappingRelations()
    {
        $this->SetProperty("id",                "id", "num");
        $this->SetProperty("name",              "name");
        $this->SetProperty("accessId",           "accessId", "num");
        $this->SetProperty("textureId",         "textureId", "num");
        $this->SetProperty("colorDiffuse_r",    "colorDiffuse_r", "num");
        $this->SetProperty("colorDiffuse_g",    "colorDiffuse_g", "num");
        $this->SetProperty("colorDiffuse_b",    "colorDiffuse_b", "num");
        $this->SetProperty("colorSpecular_r",   "colorSpecular_r", "num");
        $this->SetProperty("colorSpecular_g",   "colorSpecular_g", "num");
        $this->SetProperty("colorSpecular_b",   "colorSpecular_b", "num");
    }
    
 
     
    function GetOverview()
    {
        $sql = "SELECT id, name, accessId, textureId, colorDiffuse_r, colorDiffuse_g, colorDiffuse_b,
            colorSpecular_r, colorSpecular_g, colorSpecular_b
            FROM asset_material
            ORDER BY id";
            
        $query = $this->db->query($sql);
        $rows = $query->num_rows();
        $result = $query->result();
        
        for ($i = 0; $i < $rows; $i++) 
        {
            $data = $result[$i];  
            //map   
            $material = new MaterialAsset();
            $this->MapDbToObject($data, $material);
            $returnArr[$i] =  $material;
        }
        
        return $returnArr;
    }
    
    
    function GetDetail($id)
    {
        $sql = "SELECT id, name, accessId, textureId, colorDiffuse_r, colorDiffuse_g, colorDiffuse_b,
            colorSpecular_r, colorSpecular_g, colorSpecular_b
            FROM asset_material
            WHERE id = $id";
        
        $query =  $this->db->query($sql);
        $result = $query->result();
        if($query->num_rows()>= 0)
        {
            $data = $result[0];
            //map
            $materialasset = new MaterialAsset();
            $this->MapDbToObject($data, $materialasset);
            return $materialasset;
        }

        return null;
    }
    
    
    
        
    function Update($materialasset)
    {
        $updatableFields = array("name", "textureId", "colorDiffuse_r", "colorDiffuse_g", "colorDiffuse_b",
                                "colorSpecular_r", "colorSpecular_g", "colorSpecular_b");
        $this->SetUpdatableFields($updatableFields);
        $updateString = $this->GetUpdateString($materialasset);
        
        $sql = "UPDATE asset_material
            SET {$updateString}
            WHERE id = {$materialasset->id}"; 
             
        $this->db->query($sql);
    }
    
    

    
}

?>