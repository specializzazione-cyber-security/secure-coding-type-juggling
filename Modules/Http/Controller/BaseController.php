<?php

namespace App\Modules\Http\Controller;

use BadMethodCallException;

abstract class BaseController
{
    /**
     * Cerca un metodo chiamato come la stringa passata e lo esegue, altrimenti lancia un'eccezione
     * 
     * @param string $method
     * @param array $parameters
     */
    public function call(string $method, array $parameters)
    {
        if (method_exists($this, $method)) {
            return $this->{$method}(...array_values($parameters));
        }

        throw new BadMethodCallException(
            "Il metodo $method non esiste in " . get_class($this)
        );
    }
}
