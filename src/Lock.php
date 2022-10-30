<?php

namespace PG\Lock;

use PG\Lock\Drivers\LockMySql;

class Lock
{
    public static function mysql()
    {
        return new LockMySql;
    }
}
