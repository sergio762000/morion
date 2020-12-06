<?php


namespace app;


class DBConfig
{
    public function getDBParam()
    {
        return array(
            'host' => 'localhost',
            'dbname' => 'postgres',
            'port' => 5432,
            'username' => 'postgres',
            'password' => 'postgres'
        );

    }
}
