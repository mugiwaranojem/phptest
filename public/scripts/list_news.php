<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/index.php';

use App\Repository\NewsRepository;
use App\Repository\CommentRepository;

$newsRepository = $container->get(NewsRepository::class);
$commentRepository = $container->get(CommentRepository::class);

foreach ($newsRepository->listNews() as $news) {
	echo("############ NEWS " . $news->getTitle() . " ############\n");
	echo($news->getBody() . "\n");
	foreach ($commentRepository->listComments() as $comment) {
		if ($comment->getNewsId() == $news->getId()) {
			echo("Comment " . $comment->getId() . " : " . $comment->getBody() . "\n");
		}
	}
}