<?php

class Model3dAsset_Mapper extends DataMapper_Model 
{

    function SetMappingRelations()
    {
        $this->SetProperty("id",                "id", "num");
        $this->SetProperty("name",              "name");
        $this->SetProperty("accessId",          "accessId", "num");
        $this->SetProperty("fileName",          "fileName");
        $this->SetProperty("materialAssetId",   "materialAssetId", "num");
    }
    
 
    function GetOverview()
    {   
        $sql = "SELECT id, name, accessId, fileName, materialAssetId 
            FROM asset_model3d
            ORDER BY name";  
        
        $query = $this->db->query($sql);
        $rows = $query->num_rows();
        $result = $query->result();
        
        for ($i = 0; $i < $rows; $i++) 
        {
            $data = $result[$i];  
            $model3dasset = new Model3dAsset();
            $this->MapDbToObject($data, $model3dasset);
            //load file
            $fullpath = Model3dAssetsPath($model3dasset->fileName);
            $model3dasset->fileContent = file_get_contents($fullpath); 
            $returnArr[$i] =  $model3dasset;
        }
        
        return $returnArr;
    }
    
    

 
    
    
    function GetDetail($id)
    {
        $sql = "SELECT id, name, accessId, fileName, materialAssetId 
            FROM asset_model3d
            WHERE id = $id";  
        
        $query =  $this->db->query($sql);
        $result = $query->result();
        if($query->num_rows()>= 0)
        {
            $data = $result[0];
            //map
            $model3dasset = new Model3dAsset();
            $this->MapDbToObject($data, $model3dasset);
            //load file
            $fullpath = model3dassetsPath($model3dasset->fileName);
            $model3dasset->fileContent = file_get_contents($fullpath); 
            return $model3dasset;
        }

        
        return null;
    }
    
    
       /*
    function Update($complaintAction)
    {
        $this->SetMappingRelations();
        
        //autoremove "_F" from columnfields
        $this->CleanFormattedColumnNames();
        
        $updatableFields = array("nr", "actionType", "description", "remark", "contactType", "actionByUser", "executerUser", 
                                "status", "dateModified");
        $this->SetUpdatableFields($updatableFields);

        //override specific values
        $this->OverridePropertyValue("dateModified", "UTC_TIMESTAMP()");

        $updateString = $this->GetUpdateString($customerComplaint);

      
        $sql = "UPDATE Complaints_CustActions
            SET {$updateString}
            WHERE intQCustNr = {$customerComplaint->qCustNr} AND intComplaintNr = {$customerComplaint->complaintNr}
            AND intCompActionNr = {$customerComplaint->nr}";
      
        //$this->db->query($sql);
        echo $sql;
    } */
    
}

?>