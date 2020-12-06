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
                    $this->dbwork->save($result);
                }
            } else {
                return $this->render('errorIP');
            }
        }

        return $this->render('index');

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
