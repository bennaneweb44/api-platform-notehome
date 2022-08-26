<?php

namespace App\DataProvider\Element\Collection;

use App\Entity\Element;
use App\Entity\Note;
use App\Repository\NoteRepository;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Repository\ElementRepository;
use Symfony\Component\HttpFoundation\RequestStack;

final class GetElementsByStartNameCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
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
        return Element::class === $resourceClass && $operationName === 'get_by_name_ac';
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        $output = [];

        // Incomming attributes from request
        $attributes = $this->currentRequest->attributes;

        // Start
        $parameters = $attributes->all();
        $start = isset($parameters['start']) && 
                    is_string($parameters['start']) &&
                    $parameters['start'] !== '' ?
                    $parameters['start'] :
                    '';

        // Elements
        if ($start !== '') {
            $output = $this->elementRepository->autocomplete($start);
        }

        return $output;
    }
}