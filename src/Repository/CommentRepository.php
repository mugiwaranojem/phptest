<?php
declare(strict_types=1);

namespace App\Repository;

use App\Utils\Db;
use App\Entity\Comment;

class CommentRepository
{
    private $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function listComments(): array
	{
		$rows = $this->db->select('SELECT * FROM `comment`');

		$comments = [];
		foreach($rows as $row) {
			$n = new Comment();
			$comments[] = $n->setId(intval($row['id']))
			  ->setBody($row['body'])
			  ->setCreatedAt($row['created_at'])
			  ->setNewsId(intval($row['news_id']));
		}

		return $comments;
	}

    public function addCommentForNews(string $body, int $newsId): int
    {
        $attributes = [
            'body' => $body,
            'news_id' => $newsId
        ];

        return $this->db->insert(new Comment(), $attributes);
    }

    public function deleteComment(int $id): void
	{
        $comment = new Comment();
        $comment->setId($id);
		$this->db->delete($comment);
	}
}