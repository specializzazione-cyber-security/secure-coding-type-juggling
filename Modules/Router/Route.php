<?php

namespace App\Modules\Router;

use App\Modules\Csrf;
use Closure;

class Route
{
    protected static array $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [], //! non funziona
        'DELETE' => [], //! non funziona
    ];

    /**
     * Registra una rotta per i vari metodi HTTP.
     *
     * @param string $uri
     * @param Closure|array $callback
     * @return void
     */
    public static function get(string $uri, Closure|array $callback): void
    {
        self::$routes['GET'][$uri] = $callback;
    }

    public static function post(string $uri, Closure|array $callback): void
    {
        self::$routes['POST'][$uri] = $callback;
    }

    public static function put(string $uri, Closure|array $callback): void
    {
        self::$routes['PUT'][$uri] = $callback;
    }

    public static function delete(string $uri, Closure|array $callback): void
    {
        self::$routes['DELETE'][$uri] = $callback;
    }

    /**
     * Verifica se l'URI richiesto corrisponde alla rotta specificata.
     *
     * @param string $uri
     * @return bool
     */
    public static function routeIs(string $uri): bool
    {
        return $uri == parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    /**
     * Risolve la richiesta HTTP corrente e chiama la funzione di callback associata alla rotta corrispondente.
     *
     * @return mixed
     */
    public static function resolve()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // if ($method === 'POST') {
        //     if (!isset($_POST['csrf_token']) || !Csrf::verifyToken($_POST['csrf_token'])) {
        //         http_response_code(419);

        //         return view('errors/419');
        //     }
        // }

        $callback = self::$routes[$method][$uri] ?? null;

        if (!$callback) {
            http_response_code(404);

            return view('errors/404');
        }

        if (is_array($callback) && count($callback) === 2) {
            $controller = new $callback[0]();
            $methodName = $callback[1];

            return $controller->call($methodName, []);
        } elseif ($callback instanceof Closure) {
            return $callback();
        }
    }
}
