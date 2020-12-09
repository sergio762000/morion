<?php


namespace coreapp;


use app\CheckHost;
use app\DBWork;

class Controller
{
    private $checkHost;
    private $dbwork;

    public function __construct()
    {
        $this->checkHost = new CheckHost();
        $this->dbwork = new DBWork();
    }

    public function index()
    {
        $ipAddr = '';
        $data = '';
        if (!empty($_POST['ipaddr'])) {
            //todo - проверка адреса хоста на валидность
            if ($this->addressIsValid($_POST['ipaddr'], $_POST['protocol'])) {
                $ipAddr = $_POST['ipaddr'];
                $protocol = $_POST['protocol'];
                $result = $this->checkHost->run($ipAddr, $protocol);

                if (!empty($result)) {
                    $this->dbwork->saveItem($result);
                }
            } else {
                return $this->render('errorIP', array(
                    'ipaddr' => $_POST['ipaddr'],
                    'protocol' => $_POST['protocol']
                ));
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

    private function addressIsValid($ipaddr, $protocol)
    {
        if ($protocol == 4) {
            //todo - Проверка адреса IPv4
            $resultCheckAddr = filter_var($ipaddr, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
        } else {
            $resultCheckAddr = filter_var($ipaddr, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);
        }

        return $resultCheckAddr;

        //при необходимости сюда добавляются другие типы проверок (IPv6, etc)
        //Используем саму простую проверку (можно добавить проверку через регулярные выражения)
//        return (ip2long($ipaddr)) ? true: false;
    }

}
