<?php

namespace Bot\Model;
use Bot\Start;
use Illuminate\Database\Capsule\Manager as DB;

class Model
{
    protected $bot;
    public function __construct($bot = null)
    {
        $this->bot = $bot;
    }
}