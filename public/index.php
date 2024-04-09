<?php

/**
 * Registriamo alcuni helper utili per gestire i percorsi
 */
require_once dirname(__FILE__, 2) . "/Modules/helpers.php";

/**
 * Registriamo l'autoloader di Composer e le funzioni helpers delle rotte
 */
require_once basePath("vendor/autoload.php");
require_once modulesPath("Router/helpers.php");

$app = require_once configPath("app.php");

/**
 * L'applicazione raccoglie la richiesta e la risolve
 */
$app->run();

