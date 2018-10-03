<?php

/**
 * @param string $key
 * @return string
 */
function getSetting($key = '')
{
    $setting = \App\Models\Settings::whereKeyCd(strtoupper($key))->first();

    if ($setting) {
        return $setting->value;
    } else {
        return '';
    }
}

/**
 * @return array
 */
function getNamedRoutes()
{
    $routeCollection = Route::getRoutes();

    $routes = [];

    foreach ($routeCollection as $route) {
        if ($route->getName()) {
            $routes[$route->getName()] = $route->getName();
        }
    }

    return $routes;
}