<?php


namespace app;


class DBConnect
{
    private $dbConfig;

    public function __construct()
    {
        $this->dbConfig = new DBConfig();
    }

    public function connect()
    {
        $dbconf = $this->dbConfig->getDBParam();

        $dsn = "pgsql:host=" . $dbconf['host']
                . ";port=" . $dbconf['port']
                . ";dbname=" . $dbconf['dbname']
                . ";user=" . $dbconf['username']
                . ";password=" . $dbconf['password'];

        return new \PDO($dsn);
    }

}
