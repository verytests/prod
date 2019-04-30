<?php

namespace AppBundle\Utils;

class PregUtil
{
    public static function pregText($text)
    {
        $res = preg_replace('/[[:^print:]]/', '', $text);

        return preg_replace("/[^a-zA-Z.,-?0-9\s]/", "", $res);
    }

    public static function pregKeyword($keyword)
    {
        $res = preg_replace('/[[:^print:]]/', '', $keyword);

        return preg_replace("/[^a-zA-Z]/", "", $res);
    }
}