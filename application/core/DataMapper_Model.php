<?php

class DataMapper_Model extends CI_Model 
{
    //sql
    protected $sql;
    protected $sqlcond;
    protected $sqlgroupby;
    protected $sqlsort;
    protected $sqlLimit;
    
    //mapping
    protected $propertiesArr;       //links property names of object to column names in db (key=propertyname, value=array('columnName', 'type', 'overrideValue'))
    protected $updatableFields;     //array of all fields that should be contained inthe update string
    protected $extraDbFields;       //array of extra dbColumns and values that should be added to the insert or update string
    
    
    public function __construct()
    {
        parent::__construct();
        $this->propertyArr = array();
        $this->updatableFields = array();
        $this->extraDbFields = array();
        $this->SetMappingRelations();
    }
    

    //SQL FUNCTIONS
    protected function ApplyLimit($start, $limit)
    {
        if($start == "")
            $start = 0;
        $this->sqlLimit = " LIMIT $start, $limit";
        if($limit == 0)
            $this->sqlLimit = "";
    }
    
    
    function SetMappingRelations()
    {}
    
    function GetOverviewCount($glob_intQCustNr, $username, $searchParameters)
    {}
    
    function GetOverview($glob_intQCustNr, $username, $start = 0, $limit = 0, $searchParameters=null, $sort=null)
    {}
    
    function QueryOverviewFrom($glob_intQCustNr, $username)
    {}
    
    function QueryOverviewGroupBy()
    {}
    
    function QueryOverviewSearch($glob_intQCustNr, $username, $searchParametersArr)
    {}
    
    function QueryOverviewSort($sort)
    {}
    
    
    //MAPPING FUNCTIONS
    //TODO naamgeving basis functie
    protected function MapVariable(&$dataValue, &$property)
    {
        if(isset($dataValue))
            $property = $dataValue;   
    }
    
  
    protected function MapDbToObject($data, $object)
    {
        foreach ($this->propertiesArr as $variableName => $propertyAttr) 
        {
            $dbColumnName = $propertyAttr['columnName'];
            if(property_exists(get_class($object), $variableName) && isset($data->$dbColumnName))
            {
                $object->$variableName = $data->$dbColumnName; 
            }
        }
    }
    
    
    public function GetUpdateArray($object)
    {
        $returnArr = array();
        
        //loop updatable fields
       // echo "<br/> GetUpdateArray count: " . count($this->updatableFields);
        
        foreach ($this->updatableFields as $propertyName) 
        {    
            //check if field is in propertyarr
            if(array_key_exists($propertyName, $this->propertiesArr))
            {      
                $propertyAttr = $this->propertiesArr[$propertyName];
                $dbColumnName = $propertyAttr['columnName'];
                $type = $propertyAttr['type'];
                $dbValue;
                
                if(property_exists(get_class($object), $propertyName))
                {
                    //switch on datatype, quotes and dateformat?
                    switch($type)
                    {
                        case "alpha":
                            $dbValue =  "'" . $object->$propertyName . "'";
                            break;
                        case "num":
                            $dbValue = $object->$propertyName;
                            break;
                        case "date":
                            $dbValue = "'" . FormatDateTime($object->$propertyName) . "'";
                            break;
                    }
                }
                
                //override value?
                if (!empty($propertyAttr['overrideValue']))
                {
                    $dbValue = $propertyAttr['overrideValue'];
                }
                
                $returnArr[$dbColumnName] = $dbValue;
            }
        }
        
        //add extra db columns
        foreach ($this->extraDbFields as $dbColumnName => $value) 
        {
             $returnArr[$dbColumnName] = $value; 
        }
        
        return $returnArr;
    }
    
    
    
    
    protected function GetUpdateString($object)
    {
        $dataArr = $this->GetUpdateArray($object);
        $returnStr = "";
        foreach ($dataArr as $dbColumnName => $value) 
        {  
            $returnStr .= $dbColumnName . " = " . $value . ", ";
        } 
        $returnStr = rtrim($returnStr, " ");
        $returnStr = rtrim($returnStr, ",");
        return $returnStr;
    }
    
    
    protected function GetInsertString($object)
    {
        $dataArr = $this->GetUpdateArray($object); 
        $returnStr = "";
        $columnStr = "";
        $valueStr = "";  
        foreach ($dataArr as $dbColumnName => $value) 
        {    
            $columnStr .= $dbColumnName . ", ";
            $valueStr .= $value . ", ";
        }
        $columnStr = rtrim($columnStr, " ");
        $columnStr = rtrim($columnStr, ",");
        $valueStr = rtrim($valueStr, " ");
        $valueStr = rtrim($valueStr, ",");
        $returnStr = "({$columnStr}) VALUES ({$valueStr})";

        return $returnStr;
    }


    
    
    protected function SetProperty($propertyName, $dbColumnName, $type = "alpha")
    {
         $this->propertiesArr[$propertyName]['columnName'] = $dbColumnName;
         $this->propertiesArr[$propertyName]['type'] = $type;
    }
    
    
    protected function ChangePropertyColumnName($propertyName, $dbColumnName)
    {
         if(array_key_exists($propertyName, $this->propertiesArr))
         {
             $this->propertiesArr[$propertyName]['columnName'] = $dbColumnName;
         }
    }
    
    
    
    protected function OverridePropertyValue($propertyName, $value)
    {
        if (array_key_exists($propertyName, $this->propertiesArr)) 
        {
            $this->propertiesArr[$propertyName]['overrideValue'] = $value;
        }
    }
    
    
    protected function AddDatabaseValue($dbColumnName, $value)
    {
        $this->extraDbFields[$dbColumnName] = $value;
    }

    
    
    protected function CleanFormattedColumnNames()
    {
        foreach ($this->propertiesArr as $variableName => $propertyAttr) 
        {
             $this->propertiesArr[$variableName]['columnName'] = rtrim( $propertyAttr['columnName'], "_F");
        }
    }
    
    
    protected function AddFieldAsUpdatable($variableName)
    {
         if(!in_array($variableName, $this->updatableFields))
         {
            array_push($this->updatableFields, $variableName);
         }
    }
    

    
    protected function SetUpdatableFields($variableNamesArray)
    {
        $this->updatableFields = $variableNamesArray;  
    }
    
    
    
    
    
    protected function TestMultiplArguments()
    {
        
       // call_user_func_array()
       echo "Number of arguments: " . func_num_args() . "<br />";
          for($i = 0 ; $i < func_num_args(); $i++) {
              echo "Argument $i = " . func_get_arg($i) . "<br />";
          }
    }
    
    

    

    
}

?>