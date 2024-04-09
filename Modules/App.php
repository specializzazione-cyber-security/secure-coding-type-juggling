<?php

namespace App\Modules;

use App\Modules\Router\Route;

class App
{
    public static App $app;
    public Route $router;
    public Database $database;

    public function __construct(Database $database, Route $router)
    {
        $this->database = $database;
        $this->router = $router;
        self::$app = $this;
    }

    /**
     * Rigenera sessione e CSRF token nel caso fosse scattato il timeout di sessione
     * @return void
     */
    protected function regenerateSessionIfNeeded(): void
    {
        if (!isset($_SESSION['session_created'])) {
            $_SESSION['session_created'] = time();
        } else if (time() - $_SESSION['session_created'] > $_ENV['SESSION_LIFETIME']) {
            session_regenerate_id(true);
            $_SESSION['csrf_token'] = Csrf::generateToken();
            $_SESSION['session_created'] = time();
        }
    }

    public function regenerateSession(){
        session_unset();
        session_regenerate_id(true);
        $_SESSION['csrf_token'] = Csrf::generateToken();
        $_SESSION['session_created'] = time();
    }

    public function setInSession($key, $params){
        foreach($params as $offset => $param){
            $_SESSION[$key][$offset] = $param;
        }
    }

    public function run(): void
    {
        session_start();

        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = Csrf::generateToken();
        }

        $this->regenerateSessionIfNeeded();
        $this->router::resolve();
    }
}
