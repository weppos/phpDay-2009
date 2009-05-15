<?php

require_once 'heap.php';

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

        Heap::execute("PostGrowlNotifier", "Post $this->id has been succesfully initialized: $this->title");
    }
    
    public function save() 
    {
        if ($this->isNew()) {
            // do something
            
            $this->id = time();

            Heap::execute("PostGrowlNotifier", "Post $this->id has been succesfully created: $this->title");
        } else {
            // do something
            
            Heap::execute("PostSubscriberNotifier", "New Updates for Post $subject->id");
            Heap::execute("PostGrowlNotifier", "Post $this->id has been succesfully updated: $this->title");
        }

        Heap::execute("CacheSweeper", "Deleted single cache at /cache/post/$this->id/post.cache");

        return $this;
    }
    
    public function destroy() 
    {
        // do something
        
        Heap::execute("CacheSweeper", "Deleted folder cache at /cache/post/$this->id/");
        Heap::execute("PostGrowlNotifier", "Post $this->id has been succesfully destroyed: $this->title");
        
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
