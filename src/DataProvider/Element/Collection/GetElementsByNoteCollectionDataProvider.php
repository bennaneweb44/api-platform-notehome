<?php

namespace App\DataProvider\Element\Collection;

use App\Entity\Element;
use App\Entity\Note;
use App\Repository\NoteRepository;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Repository\ElementRepository;
use Symfony\Component\HttpFoundation\RequestStack;

final class GetElementsByNoteCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private $currentRequest;
    private $noteRepository;
    private $elementRepository;

    public function __construct(
        RequestStack $requestStack,
        NoteRepository $noteRepository,
        ElementRepository $elementRepository
    ) {
        $this->currentRequest = $requestStack->getCurrentRequest();
        $this->noteRepository = $noteRepository;
        $this->elementRepository = $elementRepository;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Element::class === $resourceClass && $operationName === 'get_by_note';
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        // Incomming attributes from request
        $attributes = $this->currentRequest->attributes;

        // Note
        $parameters = $attributes->all();
        $noteId = isset($parameters['id']) && 
                    is_numeric($parameters['id']) &&
                    $parameters['id'] > 0 ?
                    $parameters['id'] :
                    0;
        $note = $this->noteRepository->findOneBy(['id' => $noteId]);        

        // Elements
        if ($note instanceof Note) {
            $elements = $this->elementRepository->findBy(
                ['note' => $note],
                [
                    'rayon' => 'ASC',
                    'barre' => 'ASC'
                ]
            );

            return $elements;
        }

        return [];
    }
}