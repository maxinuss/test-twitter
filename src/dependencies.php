<?php
declare(strict_types=1);

use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Cache\CacheProvider;
use Doctrine\Common\Cache\MemcachedCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;
use League\Fractal\Manager;
use League\Fractal\Serializer\DataArraySerializer;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;

use Tweets\Domain\Model\Tweet\TweetRepository;
use Tweets\Infrastructure\Domain\Model\Tweet\DoctrineMysqlTweetRepository;
use Tweets\Infrastructure\Service\JsonTransformer;

$container = [];
$container['settings'] = [
    'httpVersion' => '1.1',
    'displayErrorDetails' => getenv('ENVIRONMENT') != 'production',
    'environment' => getenv('ENVIRONMENT') ?: 'development',
    'outputBuffering' => 'append',
    'responseChunkSize' => 4096,
    'addContentLengthHeader' => false,
    'determineRouteBeforeAppMiddleware' => true,
    'cachePath' => getenv('CACHE_PATH'),
    'logger' => [
        'name' => 'tweets-app',
        'path' => getenv('LOGS_PATH'). '/app.log',
        'level' => \Monolog\Logger::DEBUG,
    ],
    'doctrine' => [
        'driver' => getenv('DB_DRIVER'),
        'host' => getenv('DB_HOST'),
        'user' => getenv('DB_USERNAME'),
        'password' => getenv('DB_PASSWORD'),
        'dbname' => getenv('DB_NAME'),
    ]
];

$container[JsonTransformer::class] = function ($c) {
    $manager = new Manager();
    $manager->setSerializer(new DataArraySerializer());
    return new JsonTransformer($manager);
};

$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Logger($settings['name']);
    $logger->pushProcessor(new UidProcessor());
    $logger->pushHandler(new StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

$container[EntityManagerInterface::class] = function ($c) {
    $settings = $c->get('settings');

    $configuration = Setup::createYAMLMetadataConfiguration(
        [__DIR__ . '/Infrastructure/Persistence/Doctrine/Mapping/Mysql'],
        $settings['environment'] == 'development'
    );

    $cacheDriver = $c->get(CacheProvider::class);
    $configuration->setQueryCacheImpl($cacheDriver);
    $configuration->setResultCacheImpl($cacheDriver);

    $configuration->setProxyDir($settings['cachePath'] . '/Proxies');
    
    return EntityManager::create($settings['doctrine'], $configuration);
};

$container[TweetRepository::class] = function ($c) {
    return new DoctrineMysqlTweetRepository($c->get(EntityManagerInterface::class));
};

return $container;
