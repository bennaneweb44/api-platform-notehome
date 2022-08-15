<?php
// api/src/DataProvider/BlogPostItemDataProvider.php

namespace App\DataProvider\Note;

use App\Entity\Note;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\NoteRepository;
use Symfony\Component\HttpFoundation\RequestStack;

final class GetNoteByCategoryCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private $currentRequest;
    private $noteRepository;
    private $categoryRepository;

    public function __construct(
        RequestStack $requestStack,
        NoteRepository $noteRepository,
        CategoryRepository $categoryRepository
    ) {
        $this->currentRequest = $requestStack->getCurrentRequest();
        $this->noteRepository = $noteRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Note::class === $resourceClass && $operationName === 'get_by_category';
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        // Incomming attributes from request
        $attributes = $this->currentRequest->attributes;

        // Category
        $parameters = $attributes->all();
        $categoryId = isset($parameters['id']) && 
                    is_numeric($parameters['id']) &&
                    $parameters['id'] > 0 ?
                    $parameters['id'] :
                    0;
        $category = $this->categoryRepository->findOneBy(['id' => $categoryId]);

        // Notes
        if ($category instanceof Category) {
            $notes = $this->noteRepository->findBy(['category' => $category]);
            return $notes;
        }

        return [];
    }
}