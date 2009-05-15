<?php

require_once 'abstract.php';


/**
 * CacheSweeper
 */
class CacheSweeper extends Observer
{
    $observedClasses = array("Post"); // Post, Comment ...

    public function afterSave($subject)
    {
        print __CLASS__ . ": Deleted single cache at /cache/post/$subject->id/post.cache\n";
    }
    
    public function afterDestroy($subject) 
    {
        print __CLASS__ . ": Deleted folder cache at /cache/post/$subject->id/\n";
    }
}

/**
 * PostEmailNotifier
 */
class PostSubscriberNotifier extends Observer
{
    $observedClasses = array("Post");

    public function afterUpdate($subject)
    {
        $subscribers = array("weppos@weppos.net"); // ...
        foreach($subscribers as $subscriber) {
            //mail($subscriber, "New Updates for Post $subject->id", "Check them out!");
            print __CLASS__ . ": New Updates for Post $subject->id\n";
        }
    }
}

/**
 * PostEmailNotifier
 */
class PostGrowlNotifier extends Observer
{
    $observedClasses = array("Post");
    
    public function afterInitialize($subject)
    {
        $this->sendNotification($subject, "initialized");
    }
    
    public function afterCreate($subject)
    {
        $this->sendNotification($subject, "saved");
    }
    
    public function afterUpdate($subject)
    {
        $this->sendNotification($subject, "updated");
    }
    
    protected function sendNotification($subject, $action)
    {
        print __CLASS__ . ": Post $subject->id has been succesfully $action: $subject->title\n";
    }
}
