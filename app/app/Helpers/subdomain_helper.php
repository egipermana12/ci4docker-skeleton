<?php

if (!function_exists('get_subdomain')) {
    function get_subdomain()
    {
        $host = service('request')->getServer('HTTP_HOST');
        $mainDomain = 'localhost';
        return str_replace('.' . $mainDomain, '', $host);
    }
}
