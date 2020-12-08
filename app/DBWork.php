<?php


namespace app;

class DBWork
{
    protected $connection;

    public function __construct()
    {
        $this->connection = new DBConnect();
    }

    public function listItem()
    {

        $sql = 'SELECT * FROM public.result ORDER BY update_time DESC';
        $conn = $this->connection->connect();
        $statement = $conn->query($sql);

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function saveItem(array $result)
    {
        $status = false;
        $checkHostInDB = $this->checkItem($result);

        $conn = $this->connection->connect();
        if ($checkHostInDB) {
            $sql = 'UPDATE public.result SET (min_time, avg_time, max_time, update_time) = (:min_time, :avg_time, :max_time, :update_time) 
                         WHERE address_host = :address_host';

            $statement = $conn->prepare($sql);
            $status = $statement->execute(array(
                'address_host' => $result['ipaddr'],
                'min_time' => $result['data']['min'],
                'avg_time' => $result['data']['avg'],
                'max_time' => $result['data']['max'],
                'update_time' => date(DATE_ATOM, time())
            ));
        } else {
            $sql = "INSERT INTO public.result (address_host, min_time, avg_time, max_time) VALUES (:address_host, :min_time, :avg_time, :max_time)";
            $statement = $conn->prepare($sql);
            $status = $statement->execute(array(
                'address_host' => $result['ipaddr'],
                'min_time' => $result['data']['min'],
                'avg_time' => $result['data']['avg'],
                'max_time' => $result['data']['max']
            ));
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

        return ($count['count'] == null) ? false: true;
    }

}
