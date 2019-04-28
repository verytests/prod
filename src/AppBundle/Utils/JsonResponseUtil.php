<?php

namespace AppBundle\Utils;


class JsonResponseUtil
{
    const USER_ALREADY_REGISTERED = 'Such user is already registered!';

    public static function constructData($msg, $data = [])
    {
        return [
            'msg' => $msg,
            'data' => $data
        ];
    }
}
