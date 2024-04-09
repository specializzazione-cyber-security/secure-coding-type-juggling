<?php

namespace App\routes;

use App\Modules\Router\Route;
use App\Modules\Http\Controller\LogController;
use App\Modules\Http\Controller\PublicController;
use App\Modules\Http\Controller\ArticleController;
use App\Modules\Http\Controller\ProfileController;

$route = new Route;

$route::get('/', function () {
    return view('welcome');
});

$route::get('/login', [PublicController::class, 'login']);

$route::post('/login/submit', [PublicController::class, 'tryLogin']);
$route::post('/logout', [PublicController::class, 'logout']);

$route::get('/monitoring/siem', [LogController::class, 'controlPanel']);
$route::get('/profile', [ProfileController::class, 'profilePage']);
$route::post('/profile/update', [ProfileController::class, 'update']);

return $route;
