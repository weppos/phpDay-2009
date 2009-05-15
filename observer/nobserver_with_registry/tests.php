<?php

require_once 'PHPUnit/Framework.php';
require_once 'post.php';


class PostTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
    }
    
    
    public function testConstructShuldRequireTitle()
    {
        try {
            $post = new Post();
            $this->fail('An expected exception has not been raised.');
        } catch(Exception $e) {
            $this->assertRegExp("/Missing argument 1/", $e->getMessage());
        }
    }
    
    public function testConstructShouldSetTitle() 
    {
        $post = new Post("My Title");
        $this->assertEquals("My Title", $post->title);
    }
    
    
    public function testShouldNotifyGrowlAfterInitialize()
    {
        Heap::clear();
        
        $post = new Post("My Title");
        $this->assertNotified("PostGrowlNotifier", "/succesfully initialized/");
    }
    
    
    public function testShouldNotifyGrowlAfterDestroy()
    {
        $post = new Post("My Title");
        
        Heap::clear();
        $post->destroy();
        $this->assertNotified("PostGrowlNotifier", "/succesfully destroyed/");
    }
    
    public function testShouldNotifyCacheSweeperAfterDestroy()
    {
        $post = new Post("My Title");
        
        Heap::clear();
        $post->destroy();
        $this->assertNotified("CacheSweeper", "@Deleted folder cache@");
        $this->assertNotified("CacheSweeper", "@/cache/post/$post->id/@");
    }
    
    
    
    protected function assertNotified($receiver, $pattern)
    {
        $commands = Heap::getCommandsForReceiver($receiver);
        $this->assertGreaterThan(0, count($commands));
        $this->assertNotificationMatches($reveiver, $pattern, $commands[0]);
    }
    
    protected function assertNotificationMatches($receiver, $pattern, $command)
    {
        list($receiver, $message) = $command;
        $this->assertRegExp($pattern, $message);
    }
}
