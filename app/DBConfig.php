<?php


namespace app;


class DBConfig
{
    public function getDBParam()
    {
        return parse_ini_file(__DIR__ . '/../config/database.ini');
    }
}
