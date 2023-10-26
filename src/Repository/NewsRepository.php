<?php

declare(strict_types=1);

namespace App\Repository;

use App\Utils\Db;
use App\Entity\News;
use App\Entity\Comment;

class NewsRepository
{
    private $db;
    private $commentRepository;

    public function __construct(
        Db $db,
        CommentRepository $commentRepository
    ) {
        $this->db = $db;
        $this->commentRepository = $commentRepository;
    }

    /**
     * @Documentation
     * Adding property types on parameter
     * Implement mysql injection blocker
     */
    public function addNews(string $title, string $body): int
    {
        $attributes = [
            'title' => $title,
            'body' => $body,
        ];

        return $this->db->insert(new News(), $attributes);
    }

    /**
    * list all news
    */
    public function listNews(): array
    {
        $rows = $this->db->select('SELECT * FROM `news`');

        $news = [];
        foreach($rows as $row) {
            $n = new News();
            $news[] = $n->setId(intval($row['id']))
              ->setTitle($row['title'])
              ->setBody($row['body'])
              ->setCreatedAt($row['created_at']);
        }

        return $news;
    }

    /**
    * deletes a news, and also linked comments
    */
    public function deleteNews(int $id)
    {
        $comments = $this->commentRepository->listComments();
        $idsToDelete = [];

        foreach ($comments as $comment) {
            if ($comment->getNewsId() == $id) {
                $idsToDelete[] = $comment->getId();
            }
        }

        foreach($idsToDelete as $id) {
            $this->commentRepository->deleteComment($id);
        }

        $news = new News();
        $news->setId($id);
        return $this->db->delete($news);
    }
}
