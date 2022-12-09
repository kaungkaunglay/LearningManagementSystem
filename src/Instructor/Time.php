<?php
class Time{
    public static function TimeToSecond($time): int{
        $array = explode(":", $time);
        if(count($array) == 3){
            return $array[0] * 3600 + $array[1] * 60 + $array[2];
        }
        return $array[0] * 60 + $array[1];
    }
}