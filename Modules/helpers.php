<?php

/**
 * Restituisce il percorso della root dell'applicazione.
 * Se viene passata una stringa, crea un percorso totalmente qualificato
 * 
 * @param string|null $path
 * @return string
 */
if (!function_exists('basePath')) {
    function basePath(?string $path = null): string
    {
        return dirname(__FILE__, 2) . '/' . $path;
    }
}

/**
 * Restituisce il percorso della cartella config.
 * Se viene passata una stringa, crea un percorso totalmente qualificato
 * 
 * @param string|null $path
 * @return string
 */
if (!function_exists('configPath')) {
    function configPath(?string $path = null): string
    {
        return basePath() . "config/" . $path;
    }
}

/**
 * Restituisce il percorso della cartella routes.
 * Se viene passata una stringa, crea un percorso totalmente qualificato
 * 
 * @param string|null $path
 * @return string
 */
if (!function_exists('routesPath')) {
    function routesPath(?string $path = null): string
    {
        return basePath() . "routes/" . $path;
    }
}

/**
 * Restituisce il percorso della cartella Modules.
 * Se viene passata una stringa, crea un percorso totalmente qualificato
 * 
 * @param string|null $path
 * @return string
 */
if (!function_exists('modulesPath')) {
    function modulesPath(?string $path = null): string
    {
        return basePath() . "Modules/" . $path;
    }
}

/**
 * Restituisce il percorso della cartella public.
 * Se viene passata una stringa, crea un percorso totalmente qualificato
 * 
 * @param string|null $path
 * @return string
 */
if (!function_exists('publicPath')) {
    function publicPath(?string $path = null): string
    {
        return basePath() . "public/" . $path;
    }
}

/**
 * Restituisce il percorso della cartella public.
 * Se viene passata una stringa, crea un percorso totalmente qualificato
 * 
 * @param string|null $path
 * @return string
 */
if (!function_exists('storagePath')) {
    function storagePath(?string $path = null): string
    {
        return basePath() . "storage/" . $path;
    }
}

/**
 * Restituisce il CSRF Token presente in sessione
 * 
 * @return string
 */
if (!function_exists('csrfToken')) {
    function csrfToken(): string
    {
        return $_SESSION['csrf_token'];
    }
}

/**
 * Mostra il contenuto delle variabili e interrompe l'esecuzione dello script.
 *
 * @param mixed ...$vars
 * @return void
 */
if (!function_exists('dd')) {
    function dd(mixed ...$vars): void
    {
        echo "<pre style='background-color:#000; padding: 10px; border-radius: 5px; color: #fff;'>";
        foreach ($vars as $var) {
            var_dump($var);
            echo "<br>";
        }
        echo "</pre>";
        die();
    }
}


function checkAtomDate($string){
    $date = DateTime::createFromFormat(DateTime::ATOM, $string);

    return $date;
}
