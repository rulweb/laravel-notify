<?php

if (!function_exists('notify')) {
    /**
     * @return RulWeb\Notify\Notify
     */
    function notify()
    {
        return app('notify');
    }
}