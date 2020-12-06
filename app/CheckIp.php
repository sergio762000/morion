<?php


namespace app;


class CheckIp
{
    public function run($ipaddr)
    {
        exec('ping -c 4 ' . $ipaddr, $answer);

        //todo - Разбор ответа на значения
        $answerRTT = explode('=', array_pop($answer));
        $answerRTTParam = explode(' ', trim($answerRTT[0]));

        array_shift($answerRTTParam);
        $answerRTTParam = explode('/', $answerRTTParam[0]);
        $answerRTTValue = explode('/', trim($answerRTT[1]));

        $result = array();
        foreach ($answerRTTParam as $key => $param) {
            $_SESSION[$ipaddr][$param] = $answerRTTValue[(int) $key];
            $result['ipaddr'] = $ipaddr;
            $result['data'] = $_SESSION[$ipaddr];
        }

        return $result;
    }
}