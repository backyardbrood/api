<?php
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Application();

$app->get('/', function () use ($app) {
    return $app->json(array('message' => 'Coming soon'));
});

$app->get('/login', function (Request $request) use ($app) {
    if ($user = $request->request->get('user') && $password = $request->request->get('password')) {
        if ($user == 'demo' && $password == 'demo') {
            return $app->json(
                array(
                    'token' => md5(time() . 'demo'),
                    'message' => 'Login successful',
                ),
                200
            );
        } else {
            return $app->json(array('message' => 'Authentication credentials not accepted'), 401);
        }
    } else {
        return $app->json(array('message' => 'Authentication credentials required in POST data'), 400);
    }
});

$app->get('/almanac', function () use ($app) {
    return $app->json(array('message' => 'Coming soon'));
});

$app->run();
