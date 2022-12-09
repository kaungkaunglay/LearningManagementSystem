<?php
require_once "UploadHandler.php";
if(isset($_POST['submit'])){
    $target_directory = "InstructorVideos";
    $upload_handler = new UploadHandler("File", $target_directory);
    if($upload_handler->GetSize() != 0){
        echo $upload_handler->GetTargetFile()."<br>";
        echo $upload_handler->GetSize("mb")."Mbytes"."<br>";
        echo $upload_handler->GetType()."<br>";
        $is_true = $upload_handler->Formatter("videos");
        $unique = uniqid();
        $upload_handler->Upload(100,"mb","videos",$unique);
        echo $upload_handler->GetDuration();
    }else{
        die("File name is not set");
    }

}

?>

<form action="file.php" method="post" enctype="multipart/form-data">
    <input accept="video/mp4, video/*" type="file" name="File" value="Click here to upload">
    <input type="submit" name="submit" value="Upload">
</form>

