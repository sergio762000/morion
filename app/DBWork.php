<?php


namespace app;

use app\DBConnect;

class DBWork
{
    protected $connection;

    public function __construct()
    {
        $this->connection = new DBConnect();
    }

    public function save(array $result)
    {
        //todo - создать sql запрос "создать/добавить"
        //
        //todo - запись существует - UPDATE
        //
        //todo - запись не существует - INSERT
        //
        //
        //todo - вернуть последние 10 записей, сортировка по времени обновления

        echo '<pre>';
        var_export($result);
        echo '</pre>';
        die(__METHOD__);

    }

}
