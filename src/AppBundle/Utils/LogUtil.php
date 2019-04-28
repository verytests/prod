<?php

namespace AppBundle\Utils;


class LogUtil
{
    const NEW_USER_LOG = 'New user';
    const ADD_TEST_LOG_SUCCESS = 'New test is added';
    const ADD_TEST_LOG_ERROR = "New test wasn't added";
    const REMOVE_TEST_LOG_ERROR = "Test wasn't removed";
    const REMOVE_TEST_LOG_SUCCESS = "Test was removed";
    const UPDATE_TEST_STATUS_SUCCESS = "Status was updated";
    const UPDATE_TEST_STATUS_ERROR = "Status wasn't updated";
    const CRITICAL_SERVER_ERROR = "Critical server error";

    public static function constructData($action, $data = [])
    {
        return [
            'action' => $action,
            'data' => $data
        ];
    }
}
