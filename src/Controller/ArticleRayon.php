<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;

/**
 * Get Articles by Rayon
 */
class ArticleRayon
{
    private $articlesRepository;    

    public function __construct(ArticlesRepository $articlesRepository)
    {
        $this->articlesRepository = $articlesRepository;
    }

    public function __invoke($id_rayon)
    {
        if ($id_rayon > 0)
        {
            return $this->articlesRepository->findBy(['rayon' => $id_rayon]);
        }

        return [];
    }
}