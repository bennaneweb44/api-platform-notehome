<?php
// api/src/DataProvider/BlogPostItemDataProvider.php

namespace App\DataProvider\Note;

use App\Entity\Note;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Repository\NoteRepository;
use App\Tools\Constants;
use Symfony\Component\HttpFoundation\RequestStack;

final class GetNoteByTypeCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private $currentRequest;
    private $noteRepository;

    public function __construct(
        RequestStack $requestStack,
        NoteRepository $noteRepository,
    ) {
        $this->currentRequest = $requestStack->getCurrentRequest();
        $this->noteRepository = $noteRepository;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Note::class === $resourceClass && $operationName === 'get_by_type';
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        // Incomming attributes from request
        $attributes = $this->currentRequest->attributes;

        // Type
        $parameters = $attributes->all();
        $type = isset($parameters['type']) && 
                    is_numeric($parameters['type']) &&
                    in_array($parameters['type'], array_keys(Constants::NOTES_TYPES)) ?
                    $parameters['type'] :
                    0;

        // Notes        
        $notes = $this->noteRepository->findBy(['type' => $type]);
        return $notes;
    }
}