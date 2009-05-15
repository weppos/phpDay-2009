<?php

require_once 'abstract.php';
require_once 'heap.php';


/**
 * Post
 */
class Post extends Subject
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
        $this->notifyObservers("initialize");
    }
    
    public function save() 
    {
        if ($this->isNew()) {
            // do something
            
            $this->id = time();
            $this->notifyObservers("create");
        } else {
            // do something
            
            $this->notifyObservers("update");
        }
        $this->notifyObservers("save");
        return $this;
    }
    
    public function destroy() 
    {
        // do something
        
        $this->notifyObservers("destroy");
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
