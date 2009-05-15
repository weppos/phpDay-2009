<?php

require_once 'strategies.php';

class TokenGenerator
{
    public function generate($strategy, $length = 10) 
    {
        $s = new $strategy();
        return $s->generate($length);
    }
}

