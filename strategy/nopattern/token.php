<?php

class TokenGenerator
{
    private static $counter = 0;
    
    public function generate($strategy, $length = 10) 
    {
        switch($strategy) {
            case "TimestampToken":
                $value = time();
                $value = (strlen($value) > $length) ? 
                    substr($value, 0, $length) : 
                    str_pad($value, $length, "0");
                    break;
            case "RandomToken":
                $string = "abcdefghijklmnopqrstuvwxyz";
                $value = array();
                for ($ii = 0; $ii < $length; $ii++) {
                    $value[] = $string[rand(0, strlen($string) - 1)];
                }
                $value = implode($value);
                break;
            case "IncrementalToken":
                self::$counter++;
                $value = self::$counter;
                $value = (strlen($value) > $length) ? 
                    substr($value, 0, $length - 1) : 
                    str_pad($value, $length, "0", false);
                    break;
        }
        return $value;
    }
    
    public static function resetCounter() 
    {
        self::$counter = 0;
    }
}

