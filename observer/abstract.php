<?php

/**
 * Observer
 */
abstract class Observer
{
    public function update($method, $subject)
    {
        if (method_exists($this, $method)) {
            $this->$method($subject);
        }
        // if (1 == 1 || is_callable(array(&$this, $method))) {
        //     call_user_func_array(array(&$this, $method), array($subject));
        // }
    }
}

/**
 * Subject
 */
abstract class Subject
{
    public $observers = array();
    
    public function notifyObservers($method) 
    {
        foreach($this->observers as $observer) {
            $observer->update("after" . ucfirst($method), $this);
        }
    }
    
    public function attachObserver($observer)
    {
        $this->observers[] = $observer;
    }
    
    public function detachObserver($observer)
    {   
        $observers = array();
        foreach($this->observers as $object) {
            if ($object !== $observer) {
                $observers[] = $object;
            }
        }
        $this->observers = $observers;
    }
}
