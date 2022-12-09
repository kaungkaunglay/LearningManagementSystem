<?php
require_once "Faker/src/autoload.php";
class CRUD{
    private static $pdo;
    private static $columns;
    private static $statement;
    private static $update_statement;
    private static $query;
    private static $order;
    private static $order_column;
    private static $group_column;
    private static $condition_column;
    private static $insert_key;
    private static $insert_value;
    private static $create_column;
    private static $alter_column;

    function __construct($PDO){
      self::$pdo = $PDO;
    }
    private static function Columns_Fetcher($colum_arr){
        for($i=0; $i < count($colum_arr); $i++){
            if($i == (count($colum_arr) -1)){
                self::$statement .= $colum_arr[$i];
            }else{
                self::$statement .= $colum_arr[$i].", ";
            }
        }
    }
    private static function Order_Fetcher($order_column)
    {
        for($i=0; $i < count($order_column); $i++){
            if($i == (count($order_column) -1)){
                self::$order_column .= $order_column[$i];
            }else{
                self::$order_column .= $order_column[$i].", ";
            }
        }
    }
    private static function Group_Fetcher($group_column)
    {
        for($i=0; $i < count($group_column); $i++){
            if($i == (count($group_column) -1)){
                self::$group_column .= $group_column[$i];
            }else{
                self::$group_column .= $group_column[$i].", ";
            }
        }
    }

    private static function Order($order_column, $is_Ascending){
        if(!is_null($order_column)){
            self::Order_Fetcher($order_column);
            if($is_Ascending){
               self::$order = "ASC";
            }else{
                self::$order = "DESC";
            }
        }
    }
    private static function Group($group_column){
        if(!is_null($group_column))
        {
            self::Group_Fetcher($group_column);
        }
    }
/*
This method return associative array
*/
    public static function Select($TableName, $colum_arr=null, $condition = null,$limit=null, $order_column=null, $is_Ascending=true, $group_column=null){
        self::Order($order_column, $is_Ascending);
      self::Group($group_column);
        self::$statement = null;
      try{
          if(is_null($colum_arr) && is_null($order_column) && is_null($group_column) && is_null($condition) && is_null($limit)) {
              self::$statement = "Select * From " . $TableName;
              self::$query = self::$pdo->query(self::$statement);
              return self::$query->fetchAll(PDO::FETCH_ASSOC);
          }
          else if(is_null($colum_arr) && is_null($order_column) && is_null($group_column) && is_null($condition) && !is_null($limit)) {
              self::$statement = "Select * From " . $TableName." LIMIT ".$limit;
              self::$query = self::$pdo->query(self::$statement);
              return self::$query->fetchAll(PDO::FETCH_ASSOC);
          }
          else if(is_null($colum_arr) && is_null($order_column) && is_null($group_column) && !is_null($condition) && is_null($limit)) {
              self::$statement = "Select * From " . $TableName." WHERE ".self::Select_Condition_Fetcher($condition);
              self::$query = self::$pdo->query(self::$statement);
              return self::$query->fetchAll(PDO::FETCH_ASSOC);
          }
          else if(is_null($colum_arr) && is_null($order_column) && is_null($group_column) && !is_null($condition) && !is_null($limit)) {
              self::$statement = "Select * From " . $TableName." WHERE ".self::Select_Condition_Fetcher($condition)." LIMIT ".$limit;
              self::$query = self::$pdo->query(self::$statement);
              return self::$query->fetchAll(PDO::FETCH_ASSOC);
          }
          else if(is_null($colum_arr) && !is_null($order_column) && is_null($condition) && is_null($limit) ){
              self::Order($order_column, $is_Ascending);
              self::$statement = "Select * From ".$TableName." ORDER BY ".self::$order_column." ".self::$order;
              self::$query = self::$pdo->query(self::$statement);
              return self::$query->fetchAll(PDO::FETCH_ASSOC);
          }
          else if(is_null($colum_arr) && !is_null($order_column) && !is_null($condition) && !is_null($limit)){
              self::Order($order_column, $is_Ascending);
              self::$statement = "Select * From ".$TableName." WHERE ".self::Select_Condition_Fetcher($condition)." ORDER BY ".self::$order_column." ".self::$order." LIMIT ".$limit;
              self::$query = self::$pdo->query(self::$statement);
              return self::$query->fetchAll(PDO::FETCH_ASSOC);
          }
          else if(!is_null($colum_arr) && is_null($order_column) && is_null($group_column) && is_null($condition) && is_null($limit)){ // require
              self::Columns_Fetcher($colum_arr);
              self::$columns = "Select ".self::$statement."  From ".$TableName;
              self::$query = self::$pdo->query(self::$columns);
              return self::$query->fetchAll(PDO::FETCH_ASSOC);
          }
          else if(!is_null($colum_arr) && is_null($order_column) && is_null($group_column) && is_null($condition) && !is_null($limit)){ // require
              self::Columns_Fetcher($colum_arr);
              self::$columns = "Select ".self::$statement."  From ".$TableName." LIMIT ".$limit;
              self::$query = self::$pdo->query(self::$columns);
              return self::$query->fetchAll(PDO::FETCH_ASSOC);
          }
          else if(!is_null($colum_arr) && is_null($order_column) && is_null($group_column) && !is_null($condition) && is_null($limit)){ // require

              self::Columns_Fetcher($colum_arr);
              self::$columns = "Select ".self::$statement."  From ".$TableName." WHERE ".self::Select_Condition_Fetcher($condition);
              self::$query = self::$pdo->query(self::$columns);
              return self::$query->fetchAll(PDO::FETCH_ASSOC);
          }
          else if(!is_null($colum_arr) && is_null($order_column) && is_null($group_column) && !is_null($condition) && !is_null($limit)){ // require

              self::Columns_Fetcher($colum_arr);
              self::$columns = "Select ".self::$statement."  From ".$TableName." WHERE ".self::Select_Condition_Fetcher($condition)." LIMIT ".$limit;
              self::$query = self::$pdo->query(self::$columns);
              return self::$query->fetchAll(PDO::FETCH_ASSOC);
          }
          else if(!is_null($colum_arr) && is_null($order_column) && !is_null($group_column) && is_null($condition) && is_null($limit)){ // require
              self::Columns_Fetcher($colum_arr);
              self::$columns = "Select ".self::$statement."  From ".$TableName." GROUP BY ".self::$group_column;
              self::$query = self::$pdo->query(self::$columns);
              return self::$query->fetchAll(PDO::FETCH_ASSOC);
          }
          else if(!is_null($colum_arr) && is_null($order_column) && !is_null($group_column) && is_null($condition) && !is_null($limit)){ // require
              self::Columns_Fetcher($colum_arr);
              self::$columns = "Select ".self::$statement."  From ".$TableName." GROUP BY ".self::$group_column." LIMIT ".$limit;
              self::$query = self::$pdo->query(self::$columns);
              return self::$query->fetchAll(PDO::FETCH_ASSOC);
          }
          else if(!is_null($colum_arr) && is_null($order_column) && !is_null($group_column) && !is_null($condition) && is_null($limit)){ // require
              self::Columns_Fetcher($colum_arr);
              self::$columns = "Select ".self::$statement."  From ".$TableName." WHERE ".self::Select_Condition_Fetcher($condition)." GROUP BY ".self::$group_column;
              self::$query = self::$pdo->query(self::$columns);
              return self::$query->fetchAll(PDO::FETCH_ASSOC);
          }
          else if(!is_null($colum_arr) && is_null($order_column) && !is_null($group_column) && !is_null($condition) && !is_null($limit)){ // require
              self::Columns_Fetcher($colum_arr);
              self::$columns = "Select ".self::$statement."  From ".$TableName." WHERE ".self::Select_Condition_Fetcher($condition)." GROUP BY ".self::$group_column." LIMIT ".$limit;
              self::$query = self::$pdo->query(self::$columns);
              return self::$query->fetchAll(PDO::FETCH_ASSOC);
          }
          else if(!is_null($colum_arr) && !is_null($order_column) && is_null($group_column) && is_null($condition) && is_null($limit)) { // require
              self::Columns_Fetcher($colum_arr);
              self::$columns = "Select " . self::$statement . "  From " . $TableName . " ORDER BY " . self::$order_column . " " . self::$order;
              self::$query = self::$pdo->query(self::$columns);
              return self::$query->fetchAll(PDO::FETCH_ASSOC);
          }
          else if(!is_null($colum_arr) && !is_null($order_column) && is_null($group_column) && is_null($condition) && !is_null($limit)) { // require
              self::Columns_Fetcher($colum_arr);
              self::$columns = "Select " . self::$statement . "  From " . $TableName . " ORDER BY " . self::$order_column . " " . self::$order." LIMIT ".$limit;
              self::$query = self::$pdo->query(self::$columns);
              return self::$query->fetchAll(PDO::FETCH_ASSOC);
          }
          else if(!is_null($colum_arr) && !is_null($order_column) && is_null($group_column) && !is_null($condition) && is_null($limit)) { // require
              self::Columns_Fetcher($colum_arr);
              self::$columns = "Select " . self::$statement . "  From " . $TableName . " WHERE ". self::Select_Condition_Fetcher($condition). " ORDER BY " . self::$order_column . " " . self::$order;
              self::$query = self::$pdo->query(self::$columns);
              return self::$query->fetchAll(PDO::FETCH_ASSOC);
          }
          else if(!is_null($colum_arr) && !is_null($order_column) && is_null($group_column) && !is_null($condition) && !is_null($limit)) { // require
              self::Columns_Fetcher($colum_arr);
              self::$columns = "Select " . self::$statement . "  From " . $TableName . " WHERE ". self::Select_Condition_Fetcher($condition). " ORDER BY " . self::$order_column . " " . self::$order." LIMIT ".$limit;
              self::$query = self::$pdo->query(self::$columns);
              return self::$query->fetchAll(PDO::FETCH_ASSOC);
          }
          else if(!is_null($colum_arr) && !is_null($order_column) && !is_null($group_column) && is_null($condition) && is_null($limit)) { // require
              self::Columns_Fetcher($colum_arr);
              self::$columns = "Select " . self::$statement . "  From " . $TableName . " ORDER BY " . self::$order_column . " " . self::$order." GROUP BY ".self::$group_column;
              self::$query = self::$pdo->query(self::$columns);
              return self::$query->fetchAll(PDO::FETCH_ASSOC);
          }
          else if(!is_null($colum_arr) && !is_null($order_column) && !is_null($group_column) && is_null($condition) && !is_null($limit)) { // require
              self::Columns_Fetcher($colum_arr);
              self::$columns = "Select " . self::$statement . "  From " . $TableName . " ORDER BY " . self::$order_column . " " . self::$order." GROUP BY ".self::$group_column." LIMIT ".$limit;
              self::$query = self::$pdo->query(self::$columns);
              return self::$query->fetchAll(PDO::FETCH_ASSOC);
          }
          else if(!is_null($colum_arr) && !is_null($order_column) && !is_null($group_column) && !is_null($condition) && is_null($limit)) { // require
              self::Columns_Fetcher($colum_arr);
              self::$columns = "Select " . self::$statement . "  From " . $TableName ." WHERE ".self::Select_Condition_Fetcher($condition).  " ORDER BY " . self::$order_column . " " . self::$order." GROUP BY ".self::$group_column;
              self::$query = self::$pdo->query(self::$columns);
              return self::$query->fetchAll(PDO::FETCH_ASSOC);
          }
          else if(!is_null($colum_arr) && !is_null($order_column) && !is_null($group_column) && !is_null($condition) && !is_null($limit)) { // require
              self::Columns_Fetcher($colum_arr);
              self::$columns = "Select " . self::$statement . "  From " . $TableName ." WHERE ".self::Select_Condition_Fetcher($condition).  " ORDER BY " . self::$order_column . " " . self::$order." GROUP BY ".self::$group_column." LIMIT ".$limit;
              self::$query = self::$pdo->query(self::$columns);
              return self::$query->fetchAll(PDO::FETCH_ASSOC);
          }
      }catch(PDOException $ex){
          echo "<textarea rows='4' cols='50' readonly>".self::$columns."</textarea>"."<br><br>";
          die($ex->getMessage());
      }
    }
    public static function Clean(){

        self:: $columns = null;
        self:: $statement = null;;
        self:: $update_statement = null;;
        self:: $query = null;;
        self:: $order = null;;
        self:: $order_column = null;;
        self:: $group_column = null;;
        self:: $condition_column = null;;
        self:: $insert_key = null;;
        self:: $insert_value = null;;
        self:: $create_column = null;;
        self:: $alter_column = null;;

    }
    private static function Update_Fetcher($update_columns){
        $string_Array = array();
        foreach($update_columns as $key => $values){
            if(gettype($values) != "integer"){
                self::$update_statement = $key."="."'".$values."'";
                $string_Array[] = self::$update_statement;
            }else{
                self::$update_statement = $key."=".$values;
                $string_Array[] = self::$update_statement;
            }
        }
        return implode(", ",$string_Array);
    }
    private static function Condition_Fetcher($condition_column)
    {
        $string_Array = array();
        foreach($condition_column as $key => $values){
            if(gettype($values) != "integer"){
                self::$condition_column = $key."="."'".$values."'";
                $string_Array[] = self::$condition_column;
            }else{
                self::$condition_column = $key."=".$values;
                $string_Array[] = self::$condition_column;
            }
        }
       return implode(", ",$string_Array);
    }
    private static function UpdateCondition_Fetcher($condition_column)
    {
        $string_Array = array();
        foreach($condition_column as $key => $values){
            if(gettype($values) != "integer"){
                self::$condition_column = $key."="."'".$values."'";
                $string_Array[] = self::$condition_column;
            }else{
                self::$condition_column = $key."=".$values;
                $string_Array[] = self::$condition_column;
            }
        }
        return implode("AND ",$string_Array);
    }
    private static function Select_Condition_Fetcher($condition){
        $string_Array2 = array();
        foreach($condition as $key => $values){
            if(gettype($values) != "integer"){
                self::$condition_column = $key."="."'".$values."'";
                $string_Array2[] = self::$condition_column;
            }else{
                self::$condition_column = $key."=".$values;
                $string_Array2[] = self::$condition_column;
            }
        }
        return implode("AND ",$string_Array2);
    }
    public static function Update($TableName, $update_columns,$conditions)
    {
            if(is_null($TableName) && is_null($update_columns)){
                return "TableName and update column arguments  are required";
            }else{
                try{
                  self::$statement = "UPDATE ".$TableName." SET ".self::Update_Fetcher($update_columns)." WHERE ".self::UpdateCondition_Fetcher($conditions);
                    self::$pdo->query(self::$statement);
                }catch(PDOException $ex){
                    echo "<textarea rows='4' cols='50' readonly>".self::$statement."</textarea>"."<br><br>";
                    die($ex->getMessage());
                }
                return true;
            }
    }
    private static function InsertKey_Fetcher($insert_columns){
        foreach($insert_columns as $key => $values){
            self::$insert_key = $key;
            $string_Array[] = self::$insert_key;
        }
        return implode(", ",$string_Array);
    }
    private static  function InsertValues_Fetcher($insert_columns){
        foreach($insert_columns as $key => $values){
            if(gettype($values) != "integer"){
                self::$insert_value = self::$pdo->quote($values);
                $string_Array[] = self::$insert_value;
            }else{
                self::$insert_value = $values;
                $string_Array[] = self::$insert_value;
            }
        }
        return implode(", ",$string_Array);
    }
    private static function AlterValues_Fetcher($alter_columns){
        foreach($alter_columns as $key => $values){
            if(gettype($values) != "integer"){
                self::$alter_column = $key. " ". $values;
                $string_Array[] = "ADD ".self::$alter_column;
            }else{
                self::$alter_column = $values;
                $string_Array[] = "ADD ".self::$alter_column;
            }
        }
        return implode(", ",$string_Array);
    }
    private static function CreateValues_Fetcher($create_columns){
        foreach($create_columns as $key => $values){
            self::$create_column = $key." ".$values;
            $stringArray[] = self::$create_column;
        }
        return implode(", ",$stringArray);
    }
    public static function Drop($TableName){
        try{
            self::$statement = "DROP TABLE IF EXISTS ".$TableName;
            self::$pdo->query(self::$statement);
        }catch(PDOException $ex){
            echo "<textarea rows='4' cols='100' readonly>".self::$statement."</textarea>"."<br><br>";
            die($ex->getMessage());
        }
    }
    public static function Truncate($TableName){
        try{
            self::$statement = "TRUNCATE TABLE ".$TableName;
            self::$pdo->query(self::$statement);
        }catch(PDOException $ex){
            echo "<textarea rows='4' cols='100' readonly>".self::$statement."</textarea>"."<br><br>";
            die($ex->getMessage());
        }
        return true;
    }
   public static function Insert($TableName, $insert_columns){
        try{
            if(is_null($TableName) && is_null($insert_columns)){
                return "TableName and update columns arguments are required";
            }else{

                self::$statement = "INSERT INTO ".$TableName." ( ".self::InsertKey_Fetcher($insert_columns)." ) "." VALUES "." (".self::InsertValues_Fetcher($insert_columns)." );";
                self::$pdo->query(self::$statement);
            }
        }catch(PDOException $ex){
            echo "<textarea rows='4' cols='100' readonly>".self::$statement."</textarea>"."<br><br>";
            die($ex->getMessage());
        }
       return true;
   }
   public static function Delete($TableName, $condition){
        try{
            self::$statement = null;
            self::$statement .= "DELETE FROM ".$TableName." WHERE ".self::Delete_Fetcher($condition);
            self::$statement  =  self::$pdo->prepare(self::$statement);
            self::$statement->execute();
            if(!self::$statement->rowcount()){
                return false;
            }else{
                return true;
            }
            return self::$statement;
        }catch(Exception $ex){
            echo "<textarea rows='4' cols='100' readonly>".self::$statement."</textarea>"."<br><br>";
            die($ex->getMessage());
        }
   }
   private static function Delete_Fetcher($condition){
       $string_Array2 = array();
       foreach($condition as $key => $values){
           if(gettype($values) != "integer"){
               self::$condition_column = $key."="."'".$values."'";
               $string_Array2[] = self::$condition_column;
           }else{
               self::$condition_column = $key."=".$values;
               $string_Array2[] = self::$condition_column;
           }
       }
       return implode("AND ",$string_Array2);
   }

   public static function Alter_ADD($TableName, $alter_columns){
        try{
            self::$statement = "ALTER TABLE ". $TableName. " " . self::AlterValues_Fetcher($alter_columns);
            self::$pdo->query(self::$statement);
        }catch (PDOException $ex){
            echo "<textarea rows='4' cols='100' readonly>".self::$statement."</textarea>"."<br><br>";
            die($ex->getMessage());
        }
        return true;
    }
   public static function Create($TableName, $create_columns,$override = false){
       if(is_null($TableName) && is_null($create_columns)){
            return "TableName and Create Columns arguments are required";
       }else{
           try{
               if($override){
                   self::Drop($TableName);
               }
               self::$statement = "CREATE TABLE ".$TableName." ( ".self::CreateValues_Fetcher($create_columns)." );";
               self::$pdo->query(self::$statement);
           }catch(PDOException $ex){
               echo "<textarea rows='4' cols='100' readonly>".self::$statement."</textarea>"."<br><br>";
               die($ex->getMessage());
           }
       }
   }

   public static function FreeHand($statement){
        try{
           $temp =  self::$pdo->query($statement);
           echo gettype($temp);
           if(gettype($temp) == "array"){
                return $temp->fetchAll(PDO::FETCH_ASSOC);
           }else if(gettype($temp) == "object"){
               return true;
           }
        }catch(PDOException $ex){
            echo "<textarea rows='4' cols='100' readonly>".self::$statement."</textarea>"."<br><br>";
            die($ex->getMessage());
        }
   }
   /*
   /* Faker Data
   Credit: https://github.com/fzaninotto/Faker
   For More Faker Data use this library
  */
    public static function Fake_UserName($gender=null){
        $faker = \Faker\Factory::create();
        return $faker->name($gender);
    }
    public static function Fake_FirstName($gender=null){
        $faker = \Faker\Factory::create();
        return $faker->firstName($gender);
    }
    public static function Fake_LastName($gender=null){
        $faker = \Faker\Factory::create();
        return $faker->lastName($gender);
    }
    public static function Fake_Country(){
        $faker = \Faker\Factory::create();
        return $faker->country;
    }
    public static function Fake_City(){
        $faker = \Faker\Factory::create();
        return $faker->city;
    }
    public static function Fake_PersonalEmail(){
        $faker = \Faker\Factory::create();
        return $faker->email;
    }
    public static function Fake_BusinessEmail(){
        $faker = \Faker\Factory::create();
        return $faker->companyEmail;
    }
    public static function Fake_IPAddress(){
        $faker = \Faker\Factory::create();
        return $faker->ipv4;
    }
    public static  function Fake_PhoneNumber(){
        $faker = \Faker\Factory::create();
        return $faker->phoneNumber;
    }
    public static function Fake_Password(){
        $faker = \Faker\Factory::create();
        return $faker->password;
    }
    public static function Fake_CreditCardType(){
        $faker = \Faker\Factory::create();
        return $faker->creditCardType;
    }
    public static function Fake_CreditCardNumber(){
        $faker = \Faker\Factory::create();
        return $faker->creditCardNumber;
    }
    public static function Fake_CreditCardExpiryDate(){
        $faker = \Faker\Factory::create();
        return $faker->creditCardExpirationDate;
    }
    public static  function Fake_Date(){
        $faker = \Faker\Factory::create();
        return $faker->date;
    }
    public static  function Fake_TimeZone(){
        $faker = \Faker\Factory::create();
        return $faker->timezone;
    }
    public static function Fake_SHA256(){
        $faker = \Faker\Factory::create();
        return $faker->sha256;
    }
    public static function Fake_UserID(){
        $faker = \Faker\Factory::create();
        return $faker->uuid;
    }
    public static function Fake_image($width, $height){
        $faker = \Faker\Factory::create();
        return $faker->imageUrl($width,$height);
    }
    public static function Fake_Text($max_chars){
        $faker = \Faker\Factory::create();
        return $faker->text($max_chars);
    }
    public static function Fake_Time($format="H:i:s",$max='now'){
        $faker = \Faker\Factory::create();
        return $faker->time($format,$max);
    }
    public static function Fake_RealText($max_chars,$index_size= 2){
        $faker = \Faker\Factory::create();
        return $faker->text($max_chars,$index_size);
    }

    public static function Fake_Characters($how_many){
        $temp = "";
        $faker = \Faker\Factory::create();
        for($i = 0; $i < $how_many; $i++){
            $temp .= $faker->randomDigit;
        }
        return $temp;
    }
}