<?php
class Base_Model extends CI_Model 
{
    protected function AutoMapInput()
    {
        //loop through all fields in post
        foreach($this->input->post() as $key => $value) 
        {
            //if a property with the same name exists, fill value
            if(property_exists(get_class($this), $key))
            {
                $this->$key = $value; 
            }
        }
    }
    
    
    protected function AutoMapInputFrom($array)
    {
        //loop through all fields in post
        foreach($array as $key => $value) 
        {
            //if a property with the same name exists, fill value
            if(property_exists(get_class($this), $key))
            {
                $this->$key = $value; 
            }
        }
    }
}

?>