<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/index.php';

use App\Repository\NewsRepository;
use App\Repository\CommentRepository;

$newsRepository = $container->get(NewsRepository::class);
$commentRepository = $container->get(CommentRepository::class);

$newsToInsert = [
    [
        'title' => 'News 1',
        'body' => 'Test body news 1',
        'comments' => [
           'body' => 'News 1 Comment' 
        ]
    ],
    [
        'title' => 'News 2',
        'body' => 'Test body news 2',
        'comments' => [
            'body' => 'News 2 Comment' 
         ]
    ],
    [
        'title' => 'News 3',
        'body' => 'Test body news 3',
        'comments' => [
            'body' => 'News 3 Comment' 
         ]
    ],
];

foreach($newsToInsert as $news) {
    $newsId = $newsRepository->addNews($news['title'], $news['body']);
    $commentId = $commentRepository->addCommentForNews($news['comments']['body'], $newsId);
    echo "Inserted News ID [$newsId], with Comment ID [$commentId]\n"; 
}

