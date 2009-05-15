<?php

require_once 'post.php';
require_once 'observers.php';

$post = new Post("I'm a cool blog post");
$post->attachObserver(new CacheSweeper);
$post->attachObserver(new PostSubscriberNotifier);
$post->attachObserver(new PostGrowlNotifier);
$post->update_attribute("title", "This is a great new title");

$post = new Post("I'm a cool blog post, but the second one");
$post->attachObserver(new CacheSweeper);
$post->attachObserver(new PostSubscriberNotifier);
$post->attachObserver(new PostGrowlNotifier);
$post->save();
$post->title = "I love changing title over and over again";
$post->save();
$post->destroy();

$post = Post::create("All in one, baby!");
$post->attachObserver(new CacheSweeper);
$post->attachObserver(new PostSubscriberNotifier);
$post->attachObserver(new PostGrowlNotifier);
$post->destroy();