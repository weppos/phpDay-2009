<?php

require_once 'PHPUnit/Framework.php';
require_once 'token.php';

class TokenGeneratorTest extends PHPUnit_Framework_TestCase 
{
    public function setUp()
    {
        $this->token = new TokenGenerator();
    }
    
    
    public function testGenerateWithTimestampTokenAndDefaultLength()
    {
        $this->assertRegExp("/[0-9]{10}/", $this->token->generate("TimestampToken"));
    }
    
    public function testGenerateWithTimestampTokenAndGivenLength()
    {
        $this->assertRegExp("/[0-9]{50}/", $this->token->generate("TimestampToken", 50));
    }
    
    
    public function testGenerateWithRandomTokenAndDefaultLength()
    {
        $this->assertRegExp("/[a-z]{10}/", $this->token->generate("RandomToken"));
    }
    
    public function testGenerateWithRandomTokenAndGivenLength()
    {
        $this->assertRegExp("/[a-z]{50}/", $this->token->generate("RandomToken", 50));
    }
    
    
    public function testGenerateWithIncrementalTokenAndDefaultLength()
    {
        $this->assertRegExp("/[0-9]{10}/", $this->token->generate("IncrementalToken"));
    }
    
    public function testGenerateWithIncrementalTokenAndGivenLength()
    {
        $this->assertRegExp("/[0-9]{50}/", $this->token->generate("IncrementalToken", 50));
    }
    
    public function testGenerateWithIncrementalTokenShouldIncrementBy1()
    {
        IncrementalToken::reset();
        $this->assertEquals("01", $this->token->generate("IncrementalToken", 2));
        $this->assertEquals("02", $this->token->generate("IncrementalToken", 2));
        $this->assertEquals("03", $this->token->generate("IncrementalToken", 2));
    }
}