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
        $ipAddr = '';
        $data = '';
        if (!empty($_POST['ipaddr'])) {
            //todo - проверка адреса хоста на валидность
            if ($this->addressIsValid($_POST['ipaddr'])) {
                $ipAddr = $_POST['ipaddr'];
                $result = $this->checkIp->run($ipAddr);

                if (!empty($result)) {
                    $this->dbwork->saveItem($result);
                }
            } else {
                return $this->render('errorIP');
            }
        }

        $arrayListItem = $this->dbwork->listItem();

        if (!empty($arrayListItem)) {
            $data = $this->fillTableData($arrayListItem);
        }

        return $this->render('index', array('data' => $data, 'ipAddr' => $ipAddr));
    }

    private function fillTableData($arrayListItem)
    {
        $data = array();
        foreach ($arrayListItem as $item) {
            $data[$item['address_host']]['min'] = $item['min_time'];
            $data[$item['address_host']]['avg'] = $item['avg_time'];
            $data[$item['address_host']]['max'] = $item['max_time'];
        }
        return $data;
    }

    private function render($page, $vars = array())
    {
        $dirTemplates = __DIR__ . '/../web/template/';
        if (file_exists($dirTemplates . $page . ".tpl.php")) {
            ob_start();
            extract($vars);
            require ($dirTemplates . $page . ".tpl.php");
            return ob_get_flush();
        }
    }

    private function addressIsValid($ipaddr)
    {
        //todo - проверка адреса хоста на валидность
        //при необходимости сюда добавляются другие типы проверок (IPv6, etc)
        //Используем саму простую проверку (можно добавить проверку через регулярные выражения)
        return (ip2long($ipaddr)) ? true: false;
    }

}
