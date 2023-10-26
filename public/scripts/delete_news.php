<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/index.php';

use App\Repository\NewsRepository;

$newsRepository = $container->get(NewsRepository::class);

if (!$argv[1]) {
    exit('No news ID entered.');
}

$newsId = intval($argv[1]);
$newsRepository->deleteNews($newsId);
