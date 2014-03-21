<?php
namespace DFePhp\Tests;

class Mockings {
    public function oneHourAgo()
    {
        return date('H:i:s', time() - 3600);
    }
}