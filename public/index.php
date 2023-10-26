<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

/**
 * @Documentation
 * Implementing Dependency injection,
 * DI pattern will have huge impact when it comes to
 * resuseability, maintainability and modularity
 */
use DI\ContainerBuilder;
use App\Utils\Db;
use App\Repository\CommentRepository;
use App\Repository\NewsRepository;
use function DI\create;
use function DI\get;

$db = Db::getInstance();
$containerBuilder = new ContainerBuilder();
$containerBuilder->useAutowiring(false);
$containerBuilder->useAnnotations(false);
$containerBuilder->addDefinitions([
    CommentRepository::class => \DI\create(CommentRepository::class)
        ->constructor($db),
    NewsRepository::class => \DI\create(NewsRepository::class)
        ->constructor($db, new CommentRepository($db)),
]);
 
$container = $containerBuilder->build();
