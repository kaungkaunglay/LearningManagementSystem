<?php
require_once "Database Connection/Connect.php";
require_once "Database Connection/CRUD.php";
// Connection
Connect::setHostname("139.59.217.138");
Connect::setDbPort("3306");
Connect::setDbUsername("kaungkaung");
Connect::setDbPassword("KaungKaungLay123#");
Connect::setDbName("test");

$test = new Connect();
$pdo = $test->isConnect();
// Creating CRUD;
$CRUD =  new CRUD($pdo);
class Details{
    private static $author_name = "Aung Khant Zin";
    private static $School = "Pearl Yanda";
    private static $Title = "Learning Management System";
    private static $facebook_enabled = false;
    private static $twitter_enabled = false;
    private static $google_enabled = false;
    /**
     * @return string
     */
    public static function getAuthorName()
    {
        return self::$author_name;
    }

    /**
     * @return string
     */
    public static function getSchool()
    {
        return self::$School;
    }

    /**
     * @return string
     */
    public static function getTitle()
    {
        return self::$Title;
    }

    /**
     * @param string $Title
     */
    public static function setTitle($Title)
    {
        self::$Title = $Title;
    }

    /**
     * @param string $author_name
     */
    public static function setAuthorName($author_name)
    {
        self::$author_name = $author_name;
    }

    /**
     * @param string $School
     */
    public static function setSchool($School)
    {
        self::$School = $School;
    }

    /**
     * @return bool
     */
    public static function isFacebookEnabled()
    {
        return self::$facebook_enabled;
    }

    /**
     * @return bool
     */
    public static function isGoogleEnabled()
    {
        return self::$google_enabled;
    }

    /**
     * @return bool
     */
    public static function isTwitterEnabled()
    {
        return self::$twitter_enabled;
    }

    /**
     * @param bool $facebook_enabled
     */
    public static function setFacebookEnabled($facebook_enabled)
    {
        self::$facebook_enabled = $facebook_enabled;
    }

    /**
     * @param bool $google_enabled
     */
    public static function setGoogleEnabled($google_enabled)
    {
        self::$google_enabled = $google_enabled;
    }

    /**
     * @param bool $twitter_enabled
     */
    public static function setTwitterEnabled($twitter_enabled)
    {
        self::$twitter_enabled = $twitter_enabled;
    }
}