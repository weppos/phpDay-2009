<?php

/**
 * Heap
 */
class Heap
{
    protected static $commands = array();
    
    public static function execute($receiver, $message)
    {
        self::$commands[] = array($receiver, $message);
        return $this;
    }
    
    public static function clear()
    {
        self::$commands = array();
    }
    
    public static function getCommands()
    {
        return self::$commands;
    }
    
    public static function getCommandsForReceiver($who)
    {
        $commands = array();
        foreach(self::getCommands() as $command) {
            list($receiver, $message) = $command;
            if ($receiver == $who) {
                $commands[] = $command;
            }
        }
        return $commands;
    }
    
    public static function getCommandsAsStrings()
    {
        $commands = array();
        foreach(self::getCommands() as $command) {
            list($receiver, $message) = $command;
            $commands[] = "$receiver: $message\n";
        }
        return $commands;
    }
}

