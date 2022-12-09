<?php
include "getID3-master/getID3-master/getid3/getid3.php";
class UploadHandler{
    private static $allowedExts = array("jpg", "jpeg", "gif", "png", "mp3", "mp4", "wma");
    private $target_directory;
    private $filename;
    private $target_file;
    private $extension ;
    private $allowed_extension;
    private $unique = null;
    public function __construct($filename, $target_directory){
        if($_FILES[$filename]['size'] == 0 ){
            die("form data should be declared with enctype or unknown error");
        }else{
            $this->filename = $filename;
            $this->target_file = $_FILES[$filename]["name"];
            $this->target_directory = $target_directory."/";
            $this->extension = pathinfo($_FILES[$filename]['name'],PATHINFO_EXTENSION);
        }

    }
    public function GetTargetFile($unique=null): string
    {
        if(is_null($unique)){
            return $this->target_directory.basename($this->target_file);
        }else if($unique){
            return $this->target_directory.$unique."_".basename($this->target_file);
        }
    }
    public function GetType(): string{
        return strtolower(pathinfo($this->GetTargetFile(),PATHINFO_EXTENSION));
    }
    public function Formatter($type)
    {
        if($type == "video" || $type == "videos"){
            $this->allowed_extension = array("mp4","avi");
            foreach($this->allowed_extension as $item){
                 if($item == $this->extension){
                   return true;
                 }
            }
        }
        else if($type == "image" || $type == "images"){
            $this->allowed_extension = array("png","jpeg","gif","jpg");
            foreach($this->allowed_extension as $item){
                if($item == $this->extension){
                    return true;
                }
            }
        }
    }
    public function IsFileExist(): bool{
        if(file_exists($this->GetTargetFile())){
            return true;
        }else{
            return false;
        }
    }
    public function GetSize($format=null): string{

        if(is_null($format)){
            return $_FILES[$this->filename]["size"];
        }
        else if($format == "kb"){
            return $_FILES[$this->filename]["size"] / 1024;
        }
        else if($format == "mb"){
            return $_FILES[$this->filename]["size"] / 1048576;
        }
        else if($format == "gb"){
            return $_FILES[$this->filename] / (1048576 * 1024);
        }
        return $_FILES[$this->filename]["size"];
    }
    public function Upload($file_size, $type=null,  $format, $unique=null){
        $size = $this->GetSize($type); // Uploaded File Size
        if(!is_null($unique)){
            $this->unique = $unique;
        }
       if($size < $file_size){
           if($this->Formatter($format))
          {
              echo "All Okay";
              move_uploaded_file($_FILES[$this->filename]["tmp_name"],$this->GetTargetFile($unique));
          }
       }
    }
    public function GetDuration(){
        $getID3 = new getID3;
        $file = $getID3->analyze($this->GetTargetFile($this->unique));
        return $file['playtime_string'];
    }
}