<?php
// api/src/DataProvider/BlogPostItemDataProvider.php

namespace App\DataProvider\Note;

use App\Entity\Note;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\User;
use App\Repository\NoteRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\RequestStack;

final class GetNoteByUserCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private $currentRequest;
    private $noteRepository;
    private $userRepository;

    public function __construct(
        RequestStack $requestStack,
        NoteRepository $noteRepository,
        UserRepository $userRepository
    ) {
        $this->currentRequest = $requestStack->getCurrentRequest();
        $this->noteRepository = $noteRepository;
        $this->userRepository = $userRepository;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Note::class === $resourceClass && $operationName === 'get_by_user';
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        // Incomming attributes from request
        $attributes = $this->currentRequest->attributes;

        // User
        $parameters = $attributes->all();
        $userId = isset($parameters['id']) && 
                    is_numeric($parameters['id']) &&
                    $parameters['id'] > 0 ?
                    $parameters['id'] :
                    0;
        $user = $this->userRepository->findOneBy(['id' => $userId]);

        // Notes
        if ($user instanceof User) {
            $notes = $this->noteRepository->findBy(['user' => $user]);
            return $notes;
        }

        return [];
    }
}