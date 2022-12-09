<?php
class Connect{
    private static $hostname;
    private static $db_name;
    private static $db_port; // optional
    private static $db_username;
    private static $db_password;
    private $dbh;
    private $is_Connect;
    /**
     * @param mixed $hostname
     */
    public static function setHostname($hostname)
    {
        self::$hostname = $hostname;
    }

    /**
     * @return mixed
     */
    public static function getHostname()
    {
        return self::$hostname;
    }

    /**
     * @param mixed $db_name
     */
    public static function setDbName($db_name)
    {
        self::$db_name = $db_name;
    }

    /**
     * @return mixed
     */
    public static function getDbName()
    {
        return self::$db_name;
    }

    /**
     * @param mixed $db_port
     */
    public static function setDbPort($db_port)
    {
        self::$db_port = $db_port;
    }

    /**
     * @return mixed
     */
    public static function getDbPort()
    {
        return self::$db_port;
    }

    /**
     * @param mixed $db_username
     */
    public static function setDbUsername($db_username)
    {
        self::$db_username = $db_username;
    }

    /**
     * @return mixed
     */
    public static function getDbUsername()
    {
        return self::$db_username;
    }

    /**
     * @param mixed $db_password
     */
    public static function setDbPassword($db_password)
    {
        self::$db_password = $db_password;
    }

    /**
     * @return mixed
     */
    public static function getDbPassword()
    {
        return self::$db_password;
    }
    private function Create_Log($message,$directory){
        $file_name = $directory."/Log".date('d-m-Y').".txt";
        if(!file_exists($file_name)){
            $myfile = fopen($file_name,"w");
            $message = $message . "\n";
            fwrite($myfile, $message);
            fclose($myfile);
        }else{
            $myfile2 = fopen($file_name, "a");
            fwrite($myfile2, $message);
            fclose($myfile2);
        }
    }
    public function __construct(){
       if(!extension_loaded('pdo')){
          die("PDO extension is needed");
       }else{
           try{
               $this->dbh = new PDO('mysql:host='.self::getHostname().":".self::getDbPort().";"."dbname=".self::getDbName(),self::getDbUsername(),self::getDbPassword());
               $this->is_Connect = true;
          //     $this->Create_Log("Connected from  IP:".$_SERVER['REMOTE_ADDR'],"Logs");
           }catch(PDOException $ex)
           {
            //   $this->Create_Log($ex->getMessage());
                die("Connection is not possible: see in ErrorLog");
           }
       }
    }
    public function isConnect(){ // Return PDO Object
        if($this->is_Connect){
          return $this->dbh;
        }else{
           return $this->dbh->errorInfo();
        }
    }
}