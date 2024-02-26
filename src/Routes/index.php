<?php 

use App\Controller\HomeController;
use App\Controller\SubscriptionController;
use App\Router;

$router = new Router();

$router->get('/', SubscriptionController::class, 'show');
$router->post('/subscribe', SubscriptionController::class, 'subscribe');

$router->dispatch();