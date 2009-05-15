<?php

/**
 * Post
 */
class Post
{
    public $id = NULL;
    public $title = NULL;
    
    
    public function isNew() 
    {
        return NULL === $this->id;
    }
    
    public function __construct($title)
    {
        $this->title = $title;

        print "PostGrowlNotifier: Post $this->id has been succesfully initialized: $this->title\n";
    }
    
    public function save() 
    {
        if ($this->isNew()) {
            // do something
            
            $this->id = time();

            print "PostGrowlNotifier: Post $this->id has been succesfully created: $this->title\n";
        } else {
            // do something
            
            print "PostSubscriberNotifier: New Updates for Post $subject->id\n";
            print "PostGrowlNotifier: Post $this->id has been succesfully updated: $this->title\n";
        }

        print "CacheSweeper: Deleted single cache at /cache/post/$this->id/post.cache\n";

        return $this;
    }
    
    public function destroy() 
    {
        // do something
        
        print "CacheSweeper: Deleted folder cache at /cache/post/$this->id/\n";
        print "PostGrowlNotifier: Post $this->id has been succesfully destroyed: $this->title\n";
        
        return $this;
    }
    
    public function update_attribute($attribute, $value) 
    {
        $this->$attribute = $value;
        return $this->save();
    }
    
    public static function create($title) 
    {
        $post = new Post($title);
        return $post->save();
    }  
}
