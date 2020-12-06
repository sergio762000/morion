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
        $dbconnect = $this->dbConfig->getDBParam();
        $dsn = "pgsql:
            host={$dbconnect['host']};
            port={$dbconnect['port']};
            dbname={$dbconnect['dbname']};
            user={$dbconnect['username']};
            password={$dbconnect['password']}";

        return new \PDO($dsn);
    }

}
