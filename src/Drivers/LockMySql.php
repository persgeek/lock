<?php

namespace PG\Lock\Drivers;

use Illuminate\Database\MySqlConnection;
use PG\Lock\Contracts\LockContract;
use Illuminate\Support\Facades\DB;

class LockMySql implements LockContract
{
    protected function connection()
    {
        $connection = DB::connection();

        if ( ! $connection instanceof MySqlConnection ) {

            throw new \InvalidArgumentException('You have to use mysql for the lock.');
        }

        return $connection;
    }

    public function acquire($name)
    {
        $response = $this->connection()->selectOne('SELECT GET_LOCK(?, 20) as acquired', [$name]);

        if ($response->acquired) {
            return true;
        }

        return false;
    }

    public function release($name)
    {
        $response = $this->connection()->selectOne('SELECT RELEASE_LOCK(?) as released', [$name]);

        if ($response->released) {
            return true;
        }

        return false;
    }
}
