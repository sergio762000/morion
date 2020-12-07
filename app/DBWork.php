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

    public function listItem()
    {

        $sql = "SELECT * FROM public.result ORDER BY update_time DESC";
        $conn = $this->connection->connect();
        $statement = $conn->query($sql);

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function saveItem(array $result)
    {
//        echo '<pre>';
//        var_export($result['ipaddr']);
//        echo '</pre>';
//        die(__METHOD__);

        $status = false;
        $checkHostInDB = $this->checkItem($result);

        $conn = $this->connection->connect();
        if ($checkHostInDB) {
            //todo - запись существует - UPDATE
            $sql = "UPDATE `public`.result SET ('min_time', 'avg_time', 'max_time', 'update_time') = (:min_time, :avg_time, :max_time, :update_time) 
                         WHERE address_host = :address_host";

            $statement = $conn->prepare($sql);
            $status = $statement->execute(array(
                'address_host' => $result['ipaddr'],
                'min_time' => $result['data']['min'],
                'avg_time' => $result['data']['avg'],
                'max_time' => $result['data']['max'],
                'update_time' => time()
            ));
        } else {
            //todo - запись не существует - INSERT
            $sql = "INSERT INTO `public`.result ('address_host', 'min_time', 'avg_time', 'max_time') 
                            VALUES (:address_host, :min_time, :avg_time, :max_time)";
            $statement = $conn->prepare($sql);
//            $statement->bindValue(':address_host', $result['ipaddr'], \PDO::PARAM_STR);
//            $statement->bindValue(':min_time', $result['data']['min']);
//            $statement->bindValue(':avg_time', $result['data']['avg']);
//            $statement->bindValue(':max_time', $result['data']['max']);
//            echo '<pre>';
//            var_export($statement);
//            echo '</pre>';
//            die(__METHOD__);

            $status = $statement->execute(array(
                'address_host' => $result['ipaddr'],
                'min_time' => $result['data']['min'],
                'avg_time' => $result['data']['avg'],
                'max_time' => $result['data']['max']
            ));

//            $status = $statement->execute();
        }

        return $status;
    }

    private function checkItem($checkData)
    {
        $sql = "SELECT COUNT(*) FROM public.result WHERE address_host = :address_host";
        $conn = $this->connection->connect();
        $statement = $conn->prepare($sql);

        $statement->execute(array(
            'address_host' => $checkData['ipaddr']
        ));
        $count = $statement->fetch();

        return $count['count'];
    }

}
