<?php
class GETPageName{
   public static function GETPageName (){
        return rtrim(substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1),".php");
}
}
