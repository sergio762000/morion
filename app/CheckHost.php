<?php


namespace app;


class CheckHost
{
    public function run($ipaddr, $protocol = 4)
    {
        $result = '';

        if ((int) $protocol == 4) {
            exec('ping -c 4 ' . $ipaddr, $answer);
            $answerRTT = explode('=', array_pop($answer));
            $answerRTTParam = explode(' ', trim($answerRTT[0]));

            array_shift($answerRTTParam);
            $answerRTTParam = explode('/', $answerRTTParam[0]);
            $answerRTTValue = explode('/', trim($answerRTT[1]));

            $result = array();
            foreach ($answerRTTParam as $key => $param) {
                $arrParam[$ipaddr][$param] = $answerRTTValue[(int) $key];
                $result['ipaddr'] = $ipaddr;
                $result['data'] = $arrParam[$ipaddr];
            }
        }

        //todo - Разбор ответа на значения
        //В результате проверки могут быть следующие ситуации
        //1) Хост ответил на все запросы
        //2) Хост ответил на часть запросов
        //3) Хост не ответил ни на один запрос
        // Данное решение обрабатывает 1 вариант



        return $result;
    }
}