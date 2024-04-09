<?php

/**
 * Carica e visualizza una vista con i dati specificati.
 *
 * @param string $viewName
 * @param array|null $data
 * @return mixed
 */
if (!function_exists('view')) {
    function view($viewName, $data = [])
    {
        extract($data);

        return include_once __DIR__ . '/../../Templates/' . $viewName . '.php';
    }
}

/**
 * Reindirizza l'utente a una determinata rotta.
 *
 * @param string $route
 * @return void
 */
if (!function_exists('redirect')) {
    function redirect($route)
    {
        header("Location: $route", true, 302);
        exit();
    }
}
