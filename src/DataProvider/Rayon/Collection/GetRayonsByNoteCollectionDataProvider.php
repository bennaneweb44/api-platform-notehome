<?php

namespace App\DataProvider\Rayon\Collection;

use App\Entity\Rayon;
use App\Entity\Note;
use App\Repository\NoteRepository;
use App\Repository\RayonRepository;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use Symfony\Component\HttpFoundation\RequestStack;

final class GetRayonsByNoteCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private $currentRequest;
    private $noteRepository;
    private $rayonRepository;

    public function __construct(
        RequestStack $requestStack,
        NoteRepository $noteRepository,
        RayonRepository $rayonRepository
    ) {
        $this->currentRequest = $requestStack->getCurrentRequest();
        $this->noteRepository = $noteRepository;
        $this->rayonRepository = $rayonRepository;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Rayon::class === $resourceClass && $operationName === 'get_by_note';
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

        // Rayons
        if ($note instanceof Note) {
            $rayons = $this->rayonRepository->findBy([
                'note' => $note
            ]);

            return $rayons;
        }

        return [];
    }
}