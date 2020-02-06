<?php

namespace OrlandoLibardi\PageBuildCms\app;
use OrlandoLibardi\FilesCms\app\Repositories\ImageRepository;
use OrlandoLibardi\PageBuildCms\app\ServicePage;
use File;
use Storage;

class ServicePicture extends ImageRepository
{   
    
    public function createPicture($img)
    {

        $return = [];            
        if(!empty($img)){
            $storage_name = $this->replaces($img);
            
            if(Storage::exists($storage_name)) {
                
                $storage_path = storage_path('app/');
                
                $name  = explode("/", $storage_name);
                $name  = end($name);
                $path  = str_replace($name , "", $storage_name);

                list($width, $height) = getimagesize($storage_path . $storage_name);
                $sizes = array(  
                    '360' => $this->scaleSize(360, $width, $height),  
                    '576' => $this->scaleSize(576, $width, $height),  
                    '1024' => $this->scaleSize(1024, $width, $height),
                    '1140' => $this->scaleSize(1140, $width, $height)
                );
                
                foreach($sizes as $k=>$v)
                {
                    if(!empty($v))
                    {
                        //new name
                        $new_image = $this->pictureName($name, $k, $v);
                        //clone
                        $this->cloneImage($name, $path, $new_image);
                        //resize image
                        $this->imageFit($path, $new_image, array('width' => $k, 'height' => $v));
                        //return 
                        $return[$k] = str_replace('public', 'storage', $path) . $new_image;

                    }else
                    {
                        $return[$k] = str_replace('public', 'storage', $path) . $name;
                    }
                }
            }            
        }
        return $return;
    }

    public function pictureName($name, $k, $v)
    {
        $temp = explode(".", $name); 
        $ext = ".".$temp[1];
        $n_ext = "_" . $k . "_" . $v . "_" .$ext;
        $new_name = str_replace($ext, $n_ext, $name);
        return $new_name;
    }

    public function scaleSize($width, $original_width, $original_height)
    {
      if($original_width <  $width) return false;      
      $p = $width/$original_width;
      $new_value = $original_height * $p;
      return ceil($new_value);      
    }

}