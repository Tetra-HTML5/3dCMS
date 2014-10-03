<?php
if ( ! function_exists('model3dassetsPath'))
{
    function Model3dAssetsPath($filename)
    {
        $fullpath = APPPATH  . "../assets/model3d/". $filename;
        return $fullpath;
    }
    
    
    function TextureAssetsUrl($filename)
    {
        $url = site_url("../assets/texture/". $filename);
        return $url;
    }
}


?>
