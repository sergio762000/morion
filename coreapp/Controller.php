<?php


namespace coreapp;


use app\CheckIp;
use app\DBWork;

class Controller
{
    private $checkIp;
    private $dbwork;

    public function __construct()
    {
        $this->checkIp = new CheckIp();
        $this->dbwork = new DBWork();
    }

    public function index()
    {
        if (!empty($_POST['ipaddr'])) {
            //todo - проверка адреса хоста на валидность
            if ($this->addressIsValid($_POST['ipaddr'])) {
                $_SESSION[$_POST['ipaddr']] = array();
                $result = $this->checkIp->run($_POST['ipaddr']);
                if ($result) {
                    $this->dbwork->saveItem($result);
                }
            } else {
                return $this->render('errorIP');
            }
        }

        $arrayListItem = $this->dbwork->listItem();
        $this->fillTableData($arrayListItem);

        return $this->render('index');
    }

    private function fillTableData($arrayListItem)
    {
        foreach ($arrayListItem as $item) {
            $_SESSION[$item['address_host']]['min'] = $item['min_time'];
            $_SESSION[$item['address_host']]['avg'] = $item['avg_time'];
            $_SESSION[$item['address_host']]['max'] = $item['max_time'];
        }
    }

    private function render($page)
    {
        ob_start();
        $fileTemplate = __DIR__ . '/../web/template/' . $page . ".php";
        include $fileTemplate;
        return ob_end_flush();
    }

    private function addressIsValid($ipaddr)
    {
        //todo - проверка адреса хоста на валидность
        //при необходимости сюда добавляются другие типы проверок (IPv6, etc)
        return (ip2long($ipaddr)) ? true: false;
    }

}
