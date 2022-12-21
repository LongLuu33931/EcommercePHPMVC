<?php

class Route
{

    function handleRoute($url)
    {
        global $routes;
        unset($routes['default_controller']);
        $url = ltrim($url, '/');
        if (empty($url)) {
            $url = '/';
        }
        $handleURL = $url;
        if (!empty($routes)) {
            foreach ($routes as $key => $val) {
                if (preg_match('~' . $key . '~is', $url)) {
                    $handleURL = preg_replace('~' . $key . '~is', $url, $val);
                }
            }
        }
        return $handleURL;
    }
}
