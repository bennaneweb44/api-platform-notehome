<?php

namespace App\Controller;

use App\Repository\ArticlesNotesRepository;
use App\Repository\ArticlesRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Get Articles by Rayon
 */
class ArticleNoteDeleteByArticle
{
    private $articlesNotesRepository;    
    private $articlesRepository;    
    
    private $entityManager;

    public function __construct(ArticlesNotesRepository $articlesNotesRepository, 
                                ArticlesRepository $articleRepository,
                                EntityManagerInterface $entityManager)
    {
        $this->articlesNotesRepository = $articlesNotesRepository;
        $this->articlesRepository = $articleRepository;

        $this->entityManager = $entityManager;
    }

    public function __invoke($id_article)
    {
        if ($id_article > 0)
        {
            $article = $this->articlesRepository->find($id_article);

            if ($article) {
                $articleNote = $this->articlesNotesRepository->findBy(['article' => $article]);

                // Array given from repository
                foreach($articleNote as $item) {
                    $this->entityManager->remove($item);
                    $this->entityManager->flush();
                }

                // Delete article
                $this->entityManager->remove($article);
                $this->entityManager->flush(); 
            }
        }

        return [];
    }
}