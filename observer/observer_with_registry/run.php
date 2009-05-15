<?php

require_once 'post.php';
require_once 'observers.php';

// Unfortunately, PHP comes with a really cool bug called "Late State Binding"
// that prevents me to implement the Observer pattern at class level.
// It would be great to be able to register observers at runtime
// and ask each Observer to kindly attach itself to the observed class
// when initialized.
// 
// PostSubscriberNotifier::observe("Post");
// PostSubscriberNotifier::observedClasses(); // Post
// CacheSweeper::observe(array("Post", "Comment"));
// CacheSweeper::observedClasses(); // Post, Comment
// PostSubscriberNotifier::observedClasses(); // BUG: Post, Post, Comment
// 
// Observer::initializeObservers(array(
//     "PostSubscriberNotifier", 
//     "CacheSweeper",
//     "PostSubscriberNotifier"
//     ));
// 
// $post = new Post();
// $post->$observers(); 
// // "PostSubscriberNotifier", "CacheSweeper", "PostSubscriberNotifier"

ObserverRegistry::initializeObservers(array("PostSubscriberNotifier", "CacheSweeper", "PostGrowlNotifier"));


$post = new Post("I'm a cool blog post");
$post->update_attribute("title", "This is a great new title");

$post = new Post("I'm a cool blog post, but the second one");
$post->save();
$post->title = "I love changing title over and over again";
$post->save();
$post->destroy();

$output = Heap::getCommandsAsStrings();
print implode($output);
$post = Post::create("All in one, baby!");
$post->destroy();