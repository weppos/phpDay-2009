<?php

/**
 * Observer
 */
abstract class Observer
{
    public function __construct()
    {
        ObserverRegistry::registerObserver($this, $this->observedClasses);
    }
    
    public function update($method, $subject)
    {
        if (method_exists($this, $method)) {
            $this->$method($subject);
        }
    }
}

/**
 * Subject
 */
abstract class Subject
{
    public function notifyObservers($method) 
    {
        foreach(ObserverRegistry::getObservers("Post") as $observer) {
            $observer->update("after" . ucfirst($method), $this);
        }
    }
    
    public function attachObserver($observer)
    {
        ObserverRegistry::registerObserver($observer, __CLASS__);
    }
}

class ObserverRegistry
{
    protected static $registry = array();
    
    public function registerObserver($observer, $observedClasses)
    {
        $observedClasses = (array) $observedClasses;
        foreach($observedClasses as $subjectClass) {
            self::$registry[$subjectClass][] = $observer;
        }
    }
    
    public static function initializeObservers($observers)
    {
        $observers = (array) $observers;
        foreach($observers as $observerClass) {
            $observer = new $observerClass();
        }
    }
    
    public static function getObservers($subjectClass) 
    {
        return self::$registry[$subjectClass];
    }
}
