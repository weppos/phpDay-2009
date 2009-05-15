<?php

class TimestampToken 
{
    public function generate($length)
    {
        $value = time();
        $value = (strlen($value) > $length) ? 
            substr($value, 0, $length) : 
            str_pad($value, $length, "0");
        return $value;
    }
}

class RandomToken
{
    public function generate($length)
    {
        $string = "abcdefghijklmnopqrstuvwxyz";
        $value = array();
        for ($ii = 0; $ii < $length; $ii++) {
            $value[] = $string[rand(0, strlen($string) - 1)];
        }
        return implode($value);
    }
}

class IncrementalToken
{
    private static $counter = 0;
    
    public function generate($length)
    {
        self::$counter++;
        $value = self::$counter;
        $value = (strlen($value) > $length) ? 
            substr($value, 0, $length - 1) : 
            str_pad($value, $length, "0", false);
        return $value;
    }
    
    public static function reset()
    {
        self::$counter = 0;
    }
}
