<?php
use BackYardBrood\HttpKernel\HalJsonResponse;
use Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Doctrine\Common\Annotations\AnnotationRegistry;
use BackYardBrood\Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Swagger\Annotations as SWG;

$loader = require_once __DIR__ . '/../vendor/autoload.php';
AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

$app = new Application();

$app->register(new DoctrineServiceProvider, array(
    'db.options' => array(
        'driver' => 'pdo_mysql',
        'user' => 'root',
        'password' => null,
        'host' => 'localhost',
        'dbname' => 'byb',
        'charset' => 'UTF-8'
    ),
));

$app->register(new DoctrineOrmServiceProvider(), array(
    "orm.proxies_dir" => dirname(__DIR__) . "/cache/doctrine-proxies",
    "orm.em.options" => array(
        "mappings" => array(
            array(
                "type" => "annotation",
                "namespace" => "BackyardBrood\Entity",
                "resources_namespace" => "BackyardBrood\Entity",
            )
        ),
    ),
));

$app->get('/', function () use ($app) {
    return $app->halJson(
        array('message' => 'Coming soon')
    );
});

$app->get('/user', function () use ($app) {
    return $app->halJson(
        array(
            '_links' => array(
                'self' => '/user?page=1',
                'next' => '/user?page=2',
                'previous' => '/user?page=1',
                'first' => '/user?page=first',
                'last' => '/user?page=last'
            ),
            '_embedded' => array(
                'user' => array(
                    array(
                        '_links' => array(
                            'self' => '/user/1'
                        ),
                        'email' => 'userOne@BackYardBrood.com',
                        'nameFirst' => 'One',
                        'nameLast' => 'Uno',
                        'zipCode' => '11111'
                    ),
                    array(
                        '_links' => array(
                            'self' => '/user/2'
                        ),
                        'email' => 'userTwo@BackYardBrood.com',
                        'nameFirst' => 'Two',
                        'nameLast' => 'Dos',
                        'zipCode' => '22222'
                    )
                )
            )
        )
    );
});

$app->get('/user/{id}', function () use ($app) {
    return $app->halJson(
        array(
            '_links' => array(
                'self' => '/user/1'
            ),
            'email' => 'userOne@BackYardBrood.com',
            'nameFirst' => 'One',
            'nameLast' => 'Uno',
            'zipCode' => '11111'
        )
    );
});

$app->post('/user/{id}', function () use ($app) {
    return $app->halJson(
        array(
            '_links' => array(
                'self' => '/user/1'
            ),
            'email' => 'userOne@BackYardBrood.com',
            'nameFirst' => 'One',
            'nameLast' => 'Uno',
            'zipCode' => '11111'
        ),
        201,
        array('Location' => '/user/1'));
});

$app->put('/user/{id}', function () use ($app) {
    return $app->halJson(
        array(
            '_links' => array(
                'self' => '/user/1'
            ),
            'email' => 'userOne@BackYardBrood.com',
            'nameFirst' => 'One',
            'nameLast' => 'Uno',
            'zipCode' => '11111'
        )
    );
});

$app->post('/login', function (Request $request) use ($app) {
    if ($user = $request->request->get('user') && $password = $request->request->get('password')) {
        if ($user == 'demo' && $password == 'demo') {
            return $app->halJson(
                array(
                    'token' => md5(time() . 'demo'),
                    'message' => 'Login successful',
                ),
                200
            );
        } else {
            return $app->halJson(
                array('message' => 'Authentication credentials not accepted'),
                401
            );
        }
    } else {
        return $app->halJson(
            array('message' => 'Authentication credentials required in POST data'),
            400
        );
    }
});

$app->get('/almanac', function () use ($app) {
    return $app->halJson(
        array(
            '_links' => array(
                'self' => '/almanac?page=1',
                'next' => '/almanac?page=2',
                'previous' => '/almanac?page=1',
                'first' => '/almanac?page=1',
                'last' => '/almanac?page=last',
            ),
            '_embedded' => array(
                'almanac' =>  array(
                    array(
                        '_links' => array(
                            'self' => '/almanac/2010-04-01'
                        ),
                        'date' => '2010-04-01',
                        'tempHigh' => 70,
                        'tempLow' => 50,
                        'sunRise' => '06:59',
                        'sunSet' => '18:59',
                        'sunHours' => 12,
                        'production' => 12
                    ),
                    array(
                        '_links' => array(
                            'self' => '/almanac/2010-04-02'
                        ),
                        'date' => '2010-04-02',
                        'tempHigh' => 71,
                        'tempLow' => 51,
                        'sunRise' => '06:58',
                        'sunSet' => '18:58',
                        'sunHours' => 12,
                        'production' => 11
                    ),
                ),
            )
        )
    );
});

$app->get('/almanac/{date}', function ($date) use ($app) {
    return $app->halJson(
        array(
            '_links' => array(
                'self' => '/almanac/2010-04-01'
            ),
            'date' => '2010-04-01',
            'tempHigh' => 70,
            'tempLow' => 50,
            'sunRise' => '06:59',
            'sunSet' => '18:59',
            'sunHours' => 12,
            'production' => 12
        )
    );
});

$app->get('/bird', function () use ($app) {
    return $app->halJson(
        array(
            '_links' => array(
                'self' => '/almanac?page=1',
                'next' => '/almanac?page=2',
                'previous' => '/almanac?page=1',
                'first' => '/almanac?page=1',
                'last' => '/almanac?page=last',
            ),
            '_embedded' => array(
                'bird' => array(
                    array(
                        '_links' => array(
                            'self' => '/bird/101'
                        ),
                        'name' => 'Bessie',
                        'type' => 'Ameraucana',
                        'gender' => 'hen',
                        'hatched' => '2001-01-01',
                    ),
                    array(
                        '_links' => array(
                            'self' => '/bird/102'
                        ),
                        'name' => 'Jane',
                        'type' => 'Andalusian',
                        'gender' => 'hen',
                        'hatched' => '2002-02-02',
                    ),
                )
            )
        )
    );
});

$app->post('/bird', function (Request $request) use ($app) {
    return $app->halJson(
        array(
            '_links' => array(
                'self' => '/bird/101'
            ),
            'name' => 'Bessie',
            'type' => 'Ameraucana',
            'gender' => 'hen',
            'hatched' => '2001-01-01',
        ),
        201,
        array('Location' => '/bird/3'));
});

$app->get('/bird/{id}', function ($id) use ($app) {
    return $app->halJson(
        array(
            '_links' => array(
                'self' => '/bird/101'
            ),
            'name' => 'Bessie',
            'type' => 'Ameraucana',
            'gender' => 'hen',
            'hatched' => '2001-01-01',
        )
    );
});

$app->put('/bird/{id}', function ($id) use ($app) {
    return $app->halJson(
        array(
            'id' => 1,
            'name' => 'Bessie',
            'type' => 'Ameraucana',
            'gender' => 'hen',
            'hatched' => '2001/01/01',
        )
    );
});

$app->get('/bird/{id}/production', function ($id) use ($app) {
    return $app->halJson(
        array(
            '_links' => array(
                'self' => '/bird/1/production?page=1',
                'next' => '/bird/1/production?page=2',
                'previous' => '/bird/1/production?page=1',
                'first' => '/bird/1/production?page=1',
                'last' => '/bird/1/production?page=last',
            ),
            '_embedded' => array(
                'production' => array(
                    array(
                        '_links' => array(
                            'self' => '/production/301',
                            'bird' => '/bird/1'
                        ),
                        'date' => '2010-04-01',
                        'count' => 5,
                    ),
                    array(
                        '_links' => array(
                            'self' => '/production/315',
                            'bird' => '/bird/1'
                        ),
                        'date' => '2010-04-02',
                        'count' => 6,
                    ),
                )
            )
        )
    );
});

$app->get('/production', function () use ($app) {
    return $app->halJson(
        array(
            '_links' => array(
                'self' => '/production?page=1',
                'first' => '/production?page=1',
                'next' => '/production?page=2',
                'last' => '/production?page=last',
            ),
            'entries' => array(
                array(
                    '_links' => array(
                        'self' => '/production/212',
                        'bird' => '/bird/1'
                    ),
                    'date' => '2010-04-01',
                    'count' => 5
                ),
                array(
                    '_links' => array(
                        'self' => '/production/312',
                        'bird' => '/bird/2'
                    ),
                    'date' => '2010-04-01',
                    'count' => 6
                ),
            )
        )
    );
});

$app->post('/production', function (Request $request) use ($app) {
    return $app->halJson(
        array(
            '_links' => array(
                'self' => '/production/500',
                'bird' => '/bird/2'
            ),
            'date' => '2010-04-01',
            'count' => 6
        ),
        201,
        array('Location' => '/production/500')
    );
});

$app->get('/production/{id}', function ($id) use ($app) {
    return $app->halJson(
        array(
            '_links' => array(
                'self' => '/production/500',
                'bird' => '/bird/2'
            ),
            'date' => '2010-04-01',
            'count' => 6
        )
    );
});

$app->put('/production/{id}', function ($id) use ($app) {
    return $app->halJson(
        array(
            '_links' => array(
                'self' => array('href' => '/production/500'),
                'bird' => array('href' => '/bird/2')
            ),
            'date' => '2010-04-01',
            'count' => 6
        )
    );
});

$app->get('/ledger', function() use ($app) {
    return $app->halJson(
        array(
            '_links' => array(
                'self' => array('href' => '/ledger/?page=1'),
                'next' => array('href' => '/ledger/?page=2'),
                'previous' => array('href' => '/ledger/?page=1'),
                'first' => array('href' => '/ledger/?page=1'),
                'last' => array('href' => '/ledger/?page=last'),
            ),
            '_embedded' => array(
                array(
                    '_links' => array(
                        'self' => array('href' => '/ledger/100')
                    ),
                    'date' => '2010-01-01',
                    'description' => 'Feed',
                    'amount' => -23.54
                ),
                array(
                    '_links' => array(
                        'self' => array('href' => '/ledger/101')
                    ),
                    'date' => '2010-01-03',
                    'description' => 'Farmers Market sale',
                    'amount' => 30.00
                )
            ),
        )
    );
});

$app->post('/ledger', function(Request $request) use ($app) {
    return $app->halJson(
        array(
            '_links' => array(
                'self' => array('href' => '/ledger/102')
            ),
            'date' => '2010-01-01',
            'description' => 'Feed',
            'amount' => 12.34
        ),
        201,
        array('Location' => '/ledger/102')
    );
});

$app->get('/ledger/{id}', function($id) use ($app) {
    return $app->halJson(
        array(
            '_links' => array(
                'self' => array('href' => '/ledger/100')
            ),
            'date' => '2010-01-01',
            'description' => 'Feed',
            'amount' => -23.54
        )
    );
});

$app->put('/ledger/{id}', function($id) use ($app) {
    return $app->halJson(
        array(
            '_links' => array(
                'self' => array('href' => '/ledger/100')
            ),
            'date' => '2010-01-01',
            'description' => 'Feed',
            'amount' => -23.54
        )
    );
});

$app->run();
