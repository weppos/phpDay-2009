<?php

require_once 'post.php';

$post = new Post("I'm a cool blog post");
$post->update_attribute("title", "This is a great new title");

$post = new Post("I'm a cool blog post, but the second one");
$post->save();
$post->title = "I love changing title over and over again";
$post->save();
$post->destroy();

$post = Post::create("All in one, baby!");
$post->destroy();