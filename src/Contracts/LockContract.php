<?php

namespace PG\Lock\Contracts;

interface LockContract
{
    public function acquire($name);

    public function release($name);
}
